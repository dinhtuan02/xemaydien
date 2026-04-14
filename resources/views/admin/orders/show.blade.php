@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <p><strong>Mã đơn:</strong> {{ $order->order_code }}</p>
        <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
        <p><strong>Tổng tiền:</strong> {{ number_format($order->total_amount) }}đ</p>

        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="row g-2">
            @csrf
            @method('PUT')
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="pending" @selected($order->status=='pending')>Chờ xác nhận</option>
                    <option value="confirmed" @selected($order->status=='confirmed')>Đã xác nhận</option>
                    <option value="shipping" @selected($order->status=='shipping')>Đang giao</option>
                    <option value="completed" @selected($order->status=='completed')>Hoàn thành</option>
                    <option value="cancelled" @selected($order->status=='cancelled')>Đã hủy</option>
                </select>
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary">Cập nhật trạng thái</button>
            </div>
        </form>
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
@endsection