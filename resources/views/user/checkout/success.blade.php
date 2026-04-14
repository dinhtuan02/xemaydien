@extends('layouts.app')

@section('title', 'Đặt hàng thành công')

@section('content')
<div class="text-center py-5">
    <h1 class="text-success mb-3">Đặt hàng thành công</h1>
    <p>Cảm ơn bạn đã mua hàng tại ElectricMotorbikeShop.</p>
    <p>Mã đơn hàng: <strong>{{ $order->order_code }}</strong></p>

    <div class="mt-4">
        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">Xem đơn hàng</a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection