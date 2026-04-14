@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<h3 class="mb-4">Chi tiết đơn hàng</h3>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <p><strong>Mã đơn:</strong> {{ $order->order_code }}</p>
        <p><strong>Người nhận:</strong> {{ $order->customer_name }}</p>
        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
        <p><strong>Trạng thái:</strong> <span class="badge bg-primary">{{ $order->status }}</span></p>
        <p><strong>Thanh toán:</strong> {{ $order->payment_method }}</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $detail)
                    <tr>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ number_format($detail->price) }}đ</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ number_format($detail->total) }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 text-end">
    <h4>Tổng thanh toán: <span class="text-danger">{{ number_format($order->total_amount) }}đ</span></h4>
</div>

@if($order->status === 'pending')
    <div class="mt-3">
        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
            @csrf
            <button class="btn btn-danger">Hủy đơn hàng</button>
        </form>
    </div>
@endif
@endsection