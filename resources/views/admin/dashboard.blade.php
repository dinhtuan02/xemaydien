@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard quản trị')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h6>Tổng sản phẩm</h6>
            <h2>{{ $totalProducts }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h6>Tổng đơn hàng</h6>
            <h2>{{ $totalOrders }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h6>Tổng khách hàng</h6>
            <h2>{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm text-center p-3">
            <h6>Doanh thu</h6>
            <h2>{{ number_format($revenue) }}đ</h2>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="mb-3">Biểu đồ doanh thu / đơn hàng</h5>

        <div style="position: relative; height: 320px;">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>
</div>

<div class="row g-4 mt-2">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Đơn hàng mới nhất</h5>
                @forelse($latestOrders as $order)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $order->order_code }}</span>
                        <strong>{{ number_format($order->total_amount) }}đ</strong>
                    </div>
                @empty
                    <p class="mb-0">Chưa có đơn hàng.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">Sản phẩm sắp hết hàng</h5>
                @forelse($lowStockProducts as $product)
                    <div class="d-flex justify-content-between border-bottom py-2">
                        <span>{{ $product->name }}</span>
                        <strong>{{ $product->quantity }}</strong>
                    </div>
                @empty
                    <p class="mb-0">Không có sản phẩm sắp hết hàng.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartCanvas = document.getElementById('dashboardChart');

    if (chartCanvas) {
        new Chart(chartCanvas, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Số đơn hàng',
                    data: @json($chartData),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    }
</script>
@endpush
