@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-3">
            <img src="{{ $product->thumbnail_url }}" class="rounded" alt="{{ $product->name }}">
        </div>

        <div class="d-flex gap-2 flex-wrap">
            @foreach($product->images as $image)
                <img src="{{ asset('storage/' . $image->image) }}"
                     class="border rounded product-gallery-thumb"
                     width="80"
                     height="80"
                     style="object-fit: cover; cursor: pointer;"
                     onclick="document.getElementById('mainProductImage').src=this.src">
            @endforeach
        </div>
    </div>

    <div class="col-md-6">
        <h2>{{ $product->name }}</h2>
        <p class="text-muted">Thương hiệu: {{ $product->brand->name ?? 'N/A' }}</p>

        <div class="mb-3">
            @if($product->sale_price)
                <span class="fs-3 fw-bold text-danger">{{ number_format($product->sale_price) }}đ</span>
                <span class="text-muted text-decoration-line-through ms-2">{{ number_format($product->price) }}đ</span>
            @else
                <span class="fs-3 fw-bold text-danger">{{ number_format($product->price) }}đ</span>
            @endif
        </div>

        <div class="mb-3">
            <span class="badge bg-success">Còn {{ $product->quantity }} sản phẩm</span>
            <span class="badge bg-warning text-dark">★ {{ $product->average_rating }}/5</span>
        </div>

        <p>{{ $product->short_description }}</p>

        <div class="mb-3">
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="qty-wrapper d-flex align-items-center">
                    <button type="button" class="btn btn-outline-secondary qty-minus">-</button>
                    <input type="number" id="productQuantity" value="1" min="1" class="form-control qty-input mx-2" style="width: 80px;">
                    <button type="button" class="btn btn-outline-secondary qty-plus">+</button>
                </div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST" id="addToCartForm" class="m-0">
                    @csrf
                    <input type="hidden" name="quantity" id="addToCartQty" value="1">
                    <button class="btn btn-primary">Thêm vào giỏ hàng</button>
                </form>

                <form action="{{ route('checkout.buy-now', $product->id) }}" method="POST" id="buyNowForm" class="m-0">
                    @csrf
                    <input type="hidden" name="quantity" id="buyNowQty" value="1">
                    <button type="submit" class="btn btn-danger">Mua ngay</button>
                </form>
            </div>
        </div>

        <hr>

        <h5>Thông số kỹ thuật</h5>
        <table class="table table-bordered">
            <tbody>
                @if(is_array($product->specifications))
                    @foreach($product->specifications as $key => $value)
                        <tr>
                            <th width="35%">{{ $key }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="2">Chưa có thông số kỹ thuật.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="mt-5">
    <h4>Mô tả sản phẩm</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>
</div>

<div class="mt-5">
    <h4>Đánh giá sản phẩm</h4>

    @auth
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('reviews.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <label class="form-label">Số sao</label>
                        <select name="rating" class="form-select">
                            <option value="5">5 sao</option>
                            <option value="4">4 sao</option>
                            <option value="3">3 sao</option>
                            <option value="2">2 sao</option>
                            <option value="1">1 sao</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bình luận</label>
                        <textarea name="comment" rows="4" class="form-control"></textarea>
                    </div>

                    <button class="btn btn-primary">Gửi đánh giá</button>
                </form>
            </div>
        </div>
    @endauth

    @forelse($product->reviews as $review)
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <strong>{{ $review->user->name ?? 'Khách hàng' }}</strong>
                    <span class="text-warning">★ {{ $review->rating }}/5</span>
                </div>
                <p class="mb-0 mt-2">{{ $review->comment }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-info">Chưa có đánh giá nào.</div>
    @endforelse
</div>
@endsection