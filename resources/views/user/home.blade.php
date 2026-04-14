@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
    @if($banners->count())
        <div id="homeBanner" class="carousel slide carousel-fade mb-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach($banners as $key => $banner)
                    <button
                        type="button"
                        data-bs-target="#homeBanner"
                        data-bs-slide-to="{{ $key }}"
                        class="{{ $key === 0 ? 'active' : '' }}"
                        aria-current="{{ $key === 0 ? 'true' : 'false' }}"
                        aria-label="Slide {{ $key + 1 }}">
                    </button>
                @endforeach
            </div>

            <div class="carousel-inner rounded-4 shadow-sm overflow-hidden">
                @foreach($banners as $key => $banner)
                    @php
                        $bannerImage = $banner->image
                            ? (str_starts_with($banner->image, 'assets/')
                                ? asset($banner->image)
                                : asset('storage/' . $banner->image))
                            : asset('assets/images/no-image.png');

                        $bannerLink = $banner->link ?: route('products.index');
                    @endphp

                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <a href="{{ $bannerLink }}" class="banner-link d-block">
                            <img
                                src="{{ $bannerImage }}"
                                class="d-block w-100 banner-img"
                                alt="{{ $banner->title }}"
                            >

                            <div class="banner-overlay"></div>

                            {{-- <div class="carousel-caption text-start">
                                <div class="banner-content">
                                    <span class="banner-badge">Xe máy điện nổi bật</span>
                                    <h2 class="fw-bold mb-2">{{ $banner->title }}</h2>
                                    <p class="mb-3">Khám phá mẫu xe phù hợp cho nhu cầu di chuyển hiện đại, tiết kiệm và tiện lợi.</p>
                                    <span class="btn btn-light btn-sm px-3">Xem ngay</span>
                                </div>
                            </div> --}}
                        </a>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#homeBanner" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#homeBanner" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    @endif

    <section class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Sản phẩm nổi bật</h3>
            <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">Xem tất cả</a>
        </div>
        <div class="row">
            @foreach($featuredProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="mb-5">
        <h3 class="mb-3">Sản phẩm mới</h3>
        <div class="row">
            @foreach($newProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section>
        <h3 class="mb-3">Khuyến mãi hấp dẫn</h3>
        <div class="row">
            @foreach($saleProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>
@endsection