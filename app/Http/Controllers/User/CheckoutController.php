<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        return view('user.checkout.index', compact('cart'));
    }

    public function store(CheckoutRequest $request)
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return back()->with('error', 'Giỏ hàng trống.');
        }

        foreach ($cart->items as $item) {
            if (!$item->product || !$item->product->is_active) {
                return back()->with('error', 'Có sản phẩm không còn khả dụng.');
            }

            if ($item->quantity > $item->product->quantity) {
                return back()->with('error', 'Có sản phẩm vượt quá số lượng tồn kho.');
            }
        }

        DB::beginTransaction();

        try {
            $subtotal = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            $shippingFee = 0;
            $discountAmount = 0;
            $totalAmount = $subtotal + $shippingFee - $discountAmount;

            $order = Order::create([
                'order_code' => 'ORD-' . strtoupper(Str::random(8)),
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'status' => Order::STATUS_PENDING,
                'subtotal' => $subtotal,
                'shipping_fee' => $shippingFee,
                'discount_amount' => $discountAmount,
                'total_amount' => $totalAmount,
                'ordered_at' => now(),
            ]);

            foreach ($cart->items as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'product_thumbnail' => $item->product->thumbnail,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'total' => $item->price * $item->quantity,
                ]);

                $item->product->decrement('quantity', $item->quantity);
                $item->product->increment('sold_count', $item->quantity);
            }

            Payment::create([
                'order_id' => $order->id,
                'transaction_code' => null,
                'payment_method' => $request->payment_method,
                'payment_status' => $request->payment_method === 'cod' ? 'unpaid' : 'unpaid',
                'amount' => $totalAmount,
                'paid_at' => null,
                'payment_note' => null,
            ]);

            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            return back()->with('error', 'Không thể tạo đơn hàng. Vui lòng thử lại.');
        }
    }

    public function success(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        return view('user.checkout.success', compact('order'));
    }
}
