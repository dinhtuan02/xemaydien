<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản trị - ElectricMotorbikeShop')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
</head>
<body>
    <div class="admin-wrapper d-flex">
        <aside class="admin-sidebar bg-dark text-white p-3">
            <h4 class="mb-4">Admin Panel</h4>
            <ul class="nav flex-column gap-2">
                <li><a href="{{ route('admin.dashboard') }}" class="nav-link text-white">Dashboard</a></li>
                <li><a href="{{ route('admin.categories.index') }}" class="nav-link text-white">Danh mục</a></li>
                <li><a href="{{ route('admin.brands.index') }}" class="nav-link text-white">Thương hiệu</a></li>
                <li><a href="{{ route('admin.products.index') }}" class="nav-link text-white">Sản phẩm</a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="nav-link text-white">Đơn hàng</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="nav-link text-white">Khách hàng</a></li>
                <li><a href="{{ route('admin.reviews.index') }}" class="nav-link text-white">Đánh giá</a></li>
                <li><a href="{{ route('admin.banners.index') }}" class="nav-link text-white">Banner</a></li>
                <li><a href="{{ route('home') }}" class="nav-link text-warning">Về website</a></li>
            </ul>
        </aside>

        <div class="admin-content flex-grow-1">
            <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0">@yield('page-title', 'Trang quản trị')</h4>

                <div class="d-flex align-items-center gap-3">
                    <span>{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Đăng xuất</button>
                    </form>
                </div>
            </header>

            <div class="p-4">
                @include('components.alert')
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>