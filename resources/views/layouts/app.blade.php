<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ElectricMotorbikeShop')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <header class="border-bottom bg-white sticky-top">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-3">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <h3 class="m-0 text-primary fw-bold">MotorbikeShop</h3>
                </a>

                <form action="{{ route('products.search') }}" method="GET" class="d-flex w-50">
                    <input type="text" name="q" class="form-control me-2" placeholder="Tìm xe máy điện...">
                    <button class="btn btn-primary">Tìm</button>
                </form>

                <!-- Right menu -->
                <div class="d-flex align-items-center gap-3 ">

                    <!-- Giỏ hàng -->
                    <a href="{{ route('cart.index') }}" 
                    class="position-relative text-dark d-flex align-items-center justify-content-center">
                    
                        <i class="bi bi-cart3 fs-5"></i>

                        <!-- Badge số lượng -->
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>

                    @auth
                        <!-- Đơn hàng -->
                        <a href="{{ route('orders.index') }}" 
                        class="text-dark d-flex align-items-center">
                            <i class="bi bi-receipt me-1"></i> Đơn hàng
                        </a>

                        <!-- Avatar + Dropdown -->
                        <div class="dropdown">
                            <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown">
                                
                                <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}"
                                    class="rounded-circle me-2"
                                    width="32" height="32">

                                {{ auth()->user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        👤 Hồ sơ
                                    </a>
                                </li>

                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            ⚙️ Admin
                                        </a>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            🚪 Đăng xuất
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @else
                        <!-- Chưa đăng nhập -->
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                            Đăng nhập
                        </a>

                        <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                            Đăng ký
                        </a>
                    @endauth
                </div>
            </div>

            <nav class="pb-3">
                <ul class="nav gap-4">
                    <li class="nav-item"><a class="nav-link px-0" href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link px-0" href="{{ route('products.index') }}">Sản phẩm</a></li>

                    @auth
                        <li class="nav-item"><a class="nav-link px-0" href="{{ route('wishlist.index') }}">Yêu thích</a></li>
                        <li class="nav-item"><a class="nav-link px-0" href="{{ route('profile.index') }}">Tài khoản</a></li>
                    @endauth
                </ul>
            </nav>
            
        </div>
    </header>

    <main class="py-4">
        <div class="container">
            @include('components.alert')
            @yield('content')
        </div>
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>MotorbikeShop</h5>
                    <p>Website bán xe máy điện hiện đại</p>
                </div>
                <div class="col-md-4">
                    <h6>Liên hệ</h6>
                    <p>Email: support@electricshop.com</p>
                    <p>Hotline: 0900 000 000</p>
                </div>
                <div class="col-md-4">
                    <h6>Hỗ trợ</h6>
                    <p>Mua hàng - Thanh toán - Bảo hành</p>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('scripts')
</body>
</html>