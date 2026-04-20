<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->paginate(10);

        return view('user.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load('details', 'payment');

        return view('user.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Chỉ có thể hủy đơn đang chờ xác nhận.');
        }

        DB::beginTransaction();

        try {
            $order->load('details.product');

            foreach ($order->details as $detail) {
                if ($detail->product) {
                    $detail->product->increment('quantity', $detail->quantity);
                    $detail->product->decrement('sold_count', $detail->quantity);
                }
            }

            $order->update([
                'status' => Order::STATUS_CANCELLED,
            ]);

            if ($order->payment) {
                $order->payment->update([
                    'payment_status' => 'failed',
                ]);
            }

            DB::commit();

            return back()->with('success', 'Đã hủy đơn hàng thành công.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Không thể hủy đơn hàng.');
        }
    }
}
