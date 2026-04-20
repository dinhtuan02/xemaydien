<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function createVNPayPayment(\App\Models\Order $order)
{
    abort_if($order->user_id !== auth()->id(), 403);

    if ($order->payment_method !== 'bank_transfer') {
        return back()->with('error', 'Đơn hàng này không dùng phương thức thanh toán online.');
    }

    if ($order->payment && $order->payment->payment_status === 'paid') {
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đơn hàng đã được thanh toán.');
    }

    // Nếu chưa có cấu hình sandbox thật thì mô phỏng luôn
    if (!config('vnpay.tmn_code') || !config('vnpay.hash_secret')) {
        return redirect()->route('payment.vnpay-demo', $order->id);
    }

    $vnp_TmnCode = config('vnpay.tmn_code');
    $vnp_HashSecret = config('vnpay.hash_secret');
    $vnp_Url = config('vnpay.url');
    $vnp_Returnurl = config('vnpay.return_url');

    $vnp_TxnRef = $order->order_code;
    $vnp_OrderInfo = 'Thanh toan don hang ' . $order->order_code;
    $vnp_OrderType = 'billpayment';
    $vnp_Amount = (int) $order->total_amount * 100;
    $vnp_Locale = 'vn';
    $vnp_BankCode = 'NCB';
    $vnp_IpAddr = request()->ip();

    $inputData = [
        "vnp_Version" => "2.1.0",
        "vnp_TmnCode" => $vnp_TmnCode,
        "vnp_Amount" => $vnp_Amount,
        "vnp_Command" => "pay",
        "vnp_CreateDate" => now()->format('YmdHis'),
        "vnp_CurrCode" => "VND",
        "vnp_IpAddr" => $vnp_IpAddr,
        "vnp_Locale" => $vnp_Locale,
        "vnp_OrderInfo" => $vnp_OrderInfo,
        "vnp_OrderType" => $vnp_OrderType,
        "vnp_ReturnUrl" => $vnp_Returnurl,
        "vnp_TxnRef" => $vnp_TxnRef,
    ];

    if (!empty($vnp_BankCode)) {
        $inputData['vnp_BankCode'] = $vnp_BankCode;
    }

    ksort($inputData);

    $query = "";
    $hashdata = "";

    foreach ($inputData as $key => $value) {
        $hashdata .= urlencode($key) . "=" . urlencode($value) . '&';
        $query .= urlencode($key) . "=" . urlencode($value) . '&';
    }

    $hashdata = rtrim($hashdata, '&');
    $query = rtrim($query, '&');

    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $paymentUrl = $vnp_Url . "?" . $query . '&vnp_SecureHash=' . $vnpSecureHash;

    return redirect($paymentUrl);
}

    public function vnpayReturn(Request $request)
    {
        $vnp_HashSecret = config('vnpay.hash_secret');
        $inputData = $request->all();

        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? null;
        unset($inputData['vnp_SecureHash'], $inputData['vnp_SecureHashType']);

        ksort($inputData);

        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

        if ($secureHash !== $vnp_SecureHash) {
            return redirect()->route('orders.index')->with('error', 'Chữ ký thanh toán không hợp lệ.');
        }

        $orderCode = $request->vnp_TxnRef;
        $responseCode = $request->vnp_ResponseCode;

        $order = Order::where('order_code', $orderCode)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Không tìm thấy đơn hàng.');
        }

        $payment = Payment::firstOrCreate(
            ['order_id' => $order->id],
            [
                'payment_method' => 'bank_transfer',
                'payment_status' => 'unpaid',
                'amount' => $order->total_amount,
            ]
        );

        if ($responseCode === '00') {
            $payment->update([
                'transaction_code' => $request->vnp_TransactionNo,
                'payment_status' => 'paid',
                'paid_at' => now(),
                'payment_note' => 'Thanh toán VNPay thành công',
            ]);

            if ($order->status === 'pending') {
                $order->update([
                    'status' => 'confirmed',
                ]);
            }

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Thanh toán online thành công.');
        }

        $payment->update([
            'transaction_code' => $request->vnp_TransactionNo,
            'payment_status' => 'failed',
            'payment_note' => 'Thanh toán VNPay thất bại. Mã: ' . $responseCode,
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('error', 'Thanh toán online thất bại.');
    }

    public function redirectToVNPay(\App\Models\Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        return $this->createVNPayPayment($order);
    }
}