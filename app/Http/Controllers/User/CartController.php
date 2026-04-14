<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product');

        return view('user.cart.index', compact('cart'));
    }


     public function add(Request $request, Product $product)
    {
        if (!$product->is_active || $product->quantity < 1) {
            return back()->with('error', 'Sản phẩm hiện không khả dụng.');
        }

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $quantity = max(1, (int) $request->input('quantity', 1));

        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $newQuantity = $item->quantity + $quantity;

            if ($newQuantity > $product->quantity) {
                return back()->with('error', 'Số lượng vượt quá tồn kho.');
            }

            $item->update([
                'quantity' => $newQuantity,
                'price' => $product->final_price,
            ]);
        } else {
            if ($quantity > $product->quantity) {
                return back()->with('error', 'Số lượng vượt quá tồn kho.');
            }

            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->final_price,
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng.');
    }

    public function update(Request $request, CartItem $item)
    {
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($request->quantity > $item->product->quantity) {
            return back()->with('error', 'Số lượng vượt quá tồn kho.');
        }

        $item->update([
            'quantity' => $request->quantity,
            'price' => $item->product->final_price,
        ]);

        return back()->with('success', 'Cập nhật giỏ hàng thành công.');
    }

    public function remove(CartItem $item)
    {
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $item->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }

    public function clear()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->items()->delete();

        return back()->with('success', 'Đã xóa toàn bộ giỏ hàng.');
    }
}
