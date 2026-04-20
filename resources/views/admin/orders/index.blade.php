@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Mã đơn, tên khách, số điện thoại">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending" @selected(request('status')==='pending')>Chờ xác nhận</option>
                    <option value="confirmed" @selected(request('status')==='confirmed')>Đã xác nhận</option>
                    <option value="shipping" @selected(request('status')==='shipping')>Đang giao</option>
                    <option value="completed" @selected(request('status')==='completed')>Hoàn thành</option>
                    <option value="cancelled" @selected(request('status')==='cancelled')>Đã hủy</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">Lọc</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table mb-0 align-middle">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách hàng</th>
                        <th>SĐT</th>
                        <th>Tổng tiền</th>
                        <th>Thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_code }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ number_format($order->total_amount) }}đ</td>
                            <td>
                                @if($order->payment)
                                    <span class="badge bg-{{ $order->payment->payment_status === 'paid' ? 'success' : ($order->payment->payment_status === 'failed' ? 'danger' : 'warning text-dark') }}">
                                        {{ $order->payment->payment_status }}
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Chưa có</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->status_badge_class }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td>{{ optional($order->ordered_at)->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-primary">Chi tiết</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có đơn hàng.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection