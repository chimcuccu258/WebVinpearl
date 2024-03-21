<?php

namespace App\Http\Controllers;

use App\Models\BillDetails;
use App\Models\Bills;
use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;
// use Mail;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }
    public function addToCart(Request $request)
    {
        $serviceId = $request->input('serviceId');
        $ticketType = $request->input('ticketType');
        $services = DB::table('services')
            ->join('tickets', 'services.serviceId', '=', 'tickets.serviceId')
            ->where('services.serviceId', $serviceId)
            ->where('tickets.ticketType', $ticketType)
            ->first();
        if (!$services) {
            abort(404);
        }
        // Kiểm tra xem giỏ hàng đã tồn tại chưa, nếu chưa thì tạo mới
        $ticketId = $services->ticketId;
        if (!Session::has('cart')) {
            Session::put('cart', []);
        }
        $cart = Session::get('cart');
        if (isset($cart[$ticketId])) {
            $cart[$ticketId]['quantity']++;
            if ($cart[$ticketId]['quantity'] < 1) {
                $cart[$ticketId]['quantity'] = 1;
            }
        } else {
            $cart[$ticketId] = [
                'serviceId' => $services->serviceId,
                'serviceName' => $services->serviceName,
                'ticketType' => $services->ticketType,
                'image' => $services->image,
                'price' => $services->price,
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
        $ticketId = $request->input('ticketId');
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
        if (isset($cart[$ticketId])) {
            // Tăng số lượng khi click vào icon +
            $cart[$ticketId]['quantity']++;
        }
        Session::put('cart', $cart);
        return redirect()->route('cartIndex');
    }
    public function decreaseQuantity(Request $request)
    {
        $cart = Session::get('cart');
        $ticketId = $request->input('ticketId');
        // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không và số lượng lớn hơn 1 mới giảm
        if (isset($cart[$ticketId]) && $cart[$ticketId]['quantity'] > 1) {
            // Giảm số lượng khi click vào icon -
            $cart[$ticketId]['quantity']--;
        }
        Session::put('cart', $cart);
        return redirect()->route('cartIndex');
    }
    public function removeItemFromCart(Request $request)
    {
        $cart = Session::get('cart');
        $ticketId = $request->input('ticketId');
        if (isset($cart[$ticketId])) {
            unset($cart[$ticketId]);
            session()->put('cart', $cart);
        }
        if (empty($cart)) {
            session()->forget('cart');
        }
        return redirect()->route('cartIndex');
    }

    public function handlePaymentCallback(Request $request)
    {
        $vnp_ResponseCode = $request->input('vnp_ResponseCode');
        if ($vnp_ResponseCode === '00') {
            $email = Session::get('email');
            $customer = Customers::query()->where('email', $email)->first();
            $generatedCode = Bills::generateBillId();
            $cart = Session::get('cart');
            $newBill = new Bills();
            $newBill->billId = $generatedCode;
            $newBill->customerId = $customer->customerId;
            $newBill->paymentDate = Carbon::now();
            $newBill->phoneNumber = $customer->phoneNumber;
            $newBill->email = $email;
            $newBill->save();

            foreach ($cart as $ticketId => $each) {
                $newBillDetail = new BillDetails();
                $newBillDetail->ticketId = $ticketId;
                $newBillDetail->billId = $generatedCode;
                $newBillDetail->quantity = $each['quantity'];
                $price = $each['quantity'] * $each['price'];
                $newBillDetail->price = $price;
                $newBillDetail->save();
            }

            // Send email
            $email_user = $customer->email;
            $name_user = $customer->tenKH;
            Mail::send('emails.checkout', compact('newBill', 'customer', 'newBillDetail', 'cart'), function ($email) use ($email_user, $name_user) {
                $email->subject('Vinpearl Booking Tour - Hóa đơn');
                $email->to($email_user, $name_user);
            });

            Session::forget('cart');


            return view('cart.success');
        } else {
            return view('cart.failure');
        }
    }
}