@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')
@section('page-title', 'Chi tiết đơn hàng')

@section('content')
<div class="row g-4">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Thông tin đơn hàng</h5>

                <p><strong>Mã đơn:</strong> {{ $order->order_code }}</p>
                <p><strong>Khách hàng:</strong> {{ $order->customer_name }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                <p><strong>Ghi chú:</strong> {{ $order->note ?: 'Không có' }}</p>
                <p>
                    <strong>Trạng thái:</strong>
                    <span class="badge bg-{{ $order->status_badge_class }}">{{ $order->status_label }}</span>
                </p>
                {{-- <p><strong>Thanh toán:</strong> {{ $order->payment_method }}</p> --}}
                <p>
                    <strong>Thanh toán:</strong>
                    @if($order->payment)
                        <span class="badge bg-{{ $order->payment->payment_status === 'paid' ? 'success' : ($order->payment->payment_status === 'failed' ? 'danger' : 'warning text-dark') }}">
                            {{ $order->payment->payment_status }}
                        </span>
                    @else
                        <span class="badge bg-secondary">Chưa có</span>
                    @endif
                </p>
                <p><strong>Tổng tiền:</strong> <span class="text-danger fw-bold">{{ number_format($order->total_amount) }}đ</span></p>

                <hr>

                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="row g-2">
                    @csrf
                    @method('PUT')

                    <div class="col-md-8">
                        <select name="status" class="form-select">
                            <option value="pending" @selected($order->status==='pending')>Chờ xác nhận</option>
                            <option value="confirmed" @selected($order->status==='confirmed')>Đã xác nhận</option>
                            <option value="shipping" @selected($order->status==='shipping')>Đang giao</option>
                            <option value="completed" @selected($order->status==='completed')>Hoàn thành</option>
                            <option value="cancelled" @selected($order->status==='cancelled')>Đã hủy</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-primary w-100">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Sản phẩm trong đơn</h5>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
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
        </div>
    </div>
</div>
@endsection