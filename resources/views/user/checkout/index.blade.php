@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<h3 class="mb-4">Thông tin thanh toán</h3>

<div class="row">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Họ tên người nhận</label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name', auth()->user()->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone', auth()->user()->phone) }}">
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
                            <option value="bank_transfer">Chuyển khoản</option>
                        </select>
                    </div>

                    <button class="btn btn-primary">Xác nhận đặt hàng</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Đơn hàng của bạn</h5>

                @foreach($cart->items as $item)
                    <div class="d-flex justify-content-between mb-2">
                        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
                        <strong>{{ number_format($item->subtotal) }}đ</strong>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between">
                    <strong>Tổng thanh toán</strong>
                    <strong class="text-danger">{{ number_format($cart->total_amount) }}đ</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection