<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreReviewRequest;
use App\Models\Review;
use App\Models\OrderDetail;

class ReviewController extends Controller
{
     public function store(StoreReviewRequest $request)
    {
        $hasPurchased = OrderDetail::where('product_id', $request->product_id)
            ->whereHas('order', function ($query) {
                $query->where('user_id', auth()->id())
                    ->where('status', 'completed');
            })
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Bạn chỉ có thể đánh giá sản phẩm đã mua và hoàn thành.');
        }

        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => true,
        ]);

        return back()->with('success', 'Đánh giá của bạn đã được gửi.');
    }
}