<?php

namespace App\Http\Controllers;

use App\Models\Cthd;
use App\Models\DichVu;
use App\Models\HoaDon;
use App\Models\KhachHang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;


class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
    public function addToCart(Request $request)
    {
        $maDV = $request->input('maDV');
        $loaiVe = $request->input('loaiVe');
        $dichVu = DB::table('dich_vus')
            ->join('ves', 'dich_vus.maDV', '=', 'ves.maDV')
            ->where('dich_vus.maDV', $maDV)
            ->where('ves.loaiVe', $loaiVe)
            ->first();
        if (!$dichVu) {
            abort(404);
        }
        // Kiểm tra xem giỏ hàng đã tồn tại chưa, nếu chưa thì tạo mới
        $maVe = $dichVu->maVe;
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
        $cart = Session::get('cart');
        if (isset($cart[$maVe])) {
            $cart[$maVe]['quantity']++;
            if ($cart[$maVe]['quantity'] < 1) {
                $cart[$maVe]['quantity'] = 1;
            }
        } else {
            $cart[$maVe] = [
                'maDV' => $dichVu->maDV,
                'tenDV' => $dichVu->tenDV,
                'loaiVe' => $dichVu->loaiVe,
                'anh' => $dichVu->anh,
                'gia' => $dichVu->giaTien,
                'quantity' => 1,
            ];
        }
        Session::put('cart', $cart);
        //        session()->forget('cart');
        return redirect()->route('cartIndex');
    }
    public function increaseQuantity(Request $request)
    {
        $cart = Session::get('cart');
        $maVe = $request->input('maVe');
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$maVe])) {
            // Tăng số lượng khi click vào icon +
            $cart[$maVe]['quantity']++;
        }
        Session::put('cart', $cart);
        return redirect()->route('cartIndex');
    }
    public function decreaseQuantity(Request $request)
    {
        $cart = Session::get('cart');
        $maVe = $request->input('maVe');
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không và số lượng lớn hơn 1 mới giảm
        if (isset($cart[$maVe]) && $cart[$maVe]['quantity'] > 1) {
            // Giảm số lượng khi click vào icon -
            $cart[$maVe]['quantity']--;
        }
        Session::put('cart', $cart);
        return redirect()->route('cartIndex');
    }
    public function removeItemFromCart(Request $request)
    {
        $cart = Session::get('cart');
        $maVe = $request->input('maVe');
        if (isset($cart[$maVe])) {
            unset($cart[$maVe]);
            session()->put('cart', $cart);
        }
        if (empty($cart)) {
            session()->forget('cart');
        }
        return redirect()->route('cartIndex');
    }

    // public function handlePaymentCallback(Request $request)
    // {
    //     $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    //     if ($vnp_ResponseCode === '00') {
    //         $email = Session::get('email');
    //         $khach_hang = KhachHang::query()->where('email', $email)->first();
    //         $generatedCode = HoaDon::generateMaHD();
    //         $cart = Session::get('cart');
    //         $newHoaDon = new HoaDon();
    //         $newHoaDon->maHD = $generatedCode;
    //         $newHoaDon->maKH = $khach_hang->maKH;
    //         $newHoaDon->ngayThanhToan = Carbon::now();
    //         $newHoaDon->SDT = $khach_hang->sdt;
    //         $newHoaDon->email = $email;
    //         $newHoaDon->save();

    //         foreach ($cart as $maVe => $each) {
    //             $newCTHD = new Cthd();
    //             $newCTHD->maVe = $maVe;
    //             $newCTHD->maHD = $generatedCode;
    //             $newCTHD->soLuong = $each['quantity'];
    //             $gia = $each['quantity'] * $each['gia'];
    //             $newCTHD->giaTien = $gia;
    //             $newCTHD->save();
    //         }

    //         // Send email
    //         $email_user = $khach_hang->email;
    //         $name_user = $khach_hang->tenKH;
    //         Mail::send('emails.checkout', compact('newHoaDon', 'khach_hang', 'newCTHD', 'cart'), function ($email) use ($email_user, $name_user) {
    //             $email->subject('Vinpearl Booking Tour - Hóa đơn');
    //             $email->to($email_user, $name_user);
    //         });

    //         Session::forget('cart');

    //         // return view('cart.paymentSuccess');
    //         return redirect()->route('paymentSuccess');
    //     } else {
    //         return view('cart.failure');
    //     }
    // }
    public function handlePaymentCallback(Request $request)
{
    $vnp_ResponseCode = $request->input('vnp_ResponseCode');
    if ($vnp_ResponseCode === '00') {
        $email = Session::get('email');
        $khach_hang = KhachHang::where('email', $email)->first();
        $generatedCode = HoaDon::generateMaHD();
        $cart = Session::get('cart');

        $newHoaDon = HoaDon::create([
            'maHD' => $generatedCode,
            'maKH' => $khach_hang->maKH,
            'ngayThanhToan' => Carbon::now(),
            'SDT' => $khach_hang->sdt,
            'email' => $email,
        ]);

        foreach ($cart as $maVe => $each) {
            Cthd::create([
                'maVe' => $maVe,
                'maHD' => $generatedCode,
                'soLuong' => $each['quantity'],
                'giaTien' => $each['quantity'] * $each['gia'],
            ]);
        }

        // Send email
        Mail::send('emails.checkout', compact('newHoaDon', 'khach_hang', 'cart'), function ($email) use ($khach_hang) {
            $email->subject('Vinpearl Booking Tour - Hóa đơn');
            $email->to($khach_hang->email, $khach_hang->tenKH);
        });

        // Prepare transaction details
        $transactionDetails = [
            'vnp_Amount' => $request->input('vnp_Amount'),
            'vnp_BankCode' => $request->input('vnp_BankCode'),
            'vnp_BankTranNo' => $request->input('vnp_BankTranNo'),
            'vnp_CardType' => $request->input('vnp_CardType'),
            'vnp_OrderInfo' => $request->input('vnp_OrderInfo'),
            'vnp_PayDate' => $request->input('vnp_PayDate'),
            'vnp_TransactionNo' => $request->input('vnp_TransactionNo'),
        ];

        Session::forget('cart');
        return view('cart.paymentSuccess', ['transactionDetails' => $transactionDetails]);
    } else {
        return view('cart.failure');
    }
}

    public function paymentSuccess()
    {
        return view('cart.paymentSuccess');
    }
}
