<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CTHD;
use App\Models\Invoice;

class PaymentController extends Controller
{
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = rand(00, 9999);
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        // $vnp_Returnurl = "http://localhost:8000/cart/success.php";
        $vnp_Returnurl = url('/paymentSuccess');
        $vnp_TmnCode = "RA96GQBV"; //Mã website tại VNPAY
        $vnp_HashSecret = "9BVHS6SK1QLJZ4VBM32TN5SLNLMYAEIS"; //Chuỗi bí mật

        $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'Thanh Toan Ve';
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $data["total_vnpay"] * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = '';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
    public function handlePaymentSuccess(Request $request)
    {
        // Extract necessary parameters from the request
        $vnp_SecureHash = $request->get('vnp_SecureHash');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        
        // Verify the payment status and secure hash here (omitted for brevity)

        if ($vnp_ResponseCode == '00') {
            // Payment was successful
            // return view('paymentSuccess');
            return view('cart.paymentSuccess');
        } else {
            // Payment failed
            return view('payment_failure');
        }
    }
}
