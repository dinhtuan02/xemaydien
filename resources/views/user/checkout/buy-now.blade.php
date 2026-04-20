@extends('layouts.app')

@section('title', 'Mua ngay')

@section('content')
<h3 class="mb-4">Thanh toán ngay</h3>

<div class="row">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('checkout.process-buy-now', $product->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="quantity" value="{{ $quantity }}">

                    <div class="mb-3">
                        <label class="form-label">Họ tên người nhận</label>
                        <input type="text" name="customer_name" class="form-control"
                               value="{{ old('customer_name', auth()->user()->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="customer_phone" class="form-control"
                               value="{{ old('customer_phone', auth()->user()->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ nhận hàng</label>
                        <textarea name="customer_address" rows="3" class="form-control">{{ old('customer_address', auth()->user()->address) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ghi chú</label>
                        <textarea name="note" rows="3" class="form-control">{{ old('note') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phương thức thanh toán</label>
                        <select name="payment_method" class="form-select">
                            <option value="cod">Thanh toán khi nhận hàng</option>
                            <option value="bank_transfer">Thanh toán online qua VNPay</option>
                        </select>
                    </div>

                    <button class="btn btn-danger">Xác nhận mua ngay</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Sản phẩm đang mua</h5>

                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="{{ $product->thumbnail_url }}" width="80" class="rounded" alt="{{ $product->name }}">
                    <div>
                        <strong>{{ $product->name }}</strong>
                        <div class="text-muted">Số lượng: {{ $quantity }}</div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-between">
                    <span>Đơn giá</span>
                    <strong>{{ number_format($product->final_price) }}đ</strong>
                </div>

                <div class="d-flex justify-content-between mt-2">
                    <span>Số lượng</span>
                    <strong>{{ $quantity }}</strong>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <strong>Tổng thanh toán</strong>
                    <strong class="text-danger">{{ number_format($product->final_price * $quantity) }}đ</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection