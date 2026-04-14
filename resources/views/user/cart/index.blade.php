@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('content')
<h3 class="mb-4">Giỏ hàng của bạn</h3>

@if($cart && $cart->items->count())
    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th width="140">Số lượng</th>
                    <th>Tạm tính</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart->items as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img src="{{ $item->product->thumbnail_url }}" width="70" class="rounded" alt="{{ $item->product->name }}">
                                <div>
                                    <strong>{{ $item->product->name }}</strong>
                                </div>
                            </div>
                        </td>
                        <td>{{ number_format($item->price) }}đ</td>
                        <td>
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                @csrf
                                @method('PUT')
                                <input type="number" min="1" name="quantity" value="{{ $item->quantity }}" class="form-control me-2 cart-qty-input">
                                <button class="btn btn-sm btn-primary">Cập nhật</button>
                            </form>
                        </td>
                        <td>{{ number_format($item->subtotal) }}đ</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row justify-content-end">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5>Tổng cộng</h5>
                    <h3 class="text-danger">{{ number_format($cart->total_amount) }}đ</h3>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('checkout.index') }}" class="btn btn-success">Tiến hành thanh toán</a>

                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Xóa toàn bộ giỏ hàng?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger w-100">Xóa toàn bộ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-info">
        Giỏ hàng đang trống. <a href="{{ route('products.index') }}">Mua sắm ngay</a>.
    </div>
@endif
@endsection