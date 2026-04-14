@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="mb-3">Bộ lọc</h5>

                <form method="GET" action="{{ route('products.index') }}">
                    <div class="mb-3">
                        <label class="form-label">Từ khóa</label>
                        <input type="text" name="q" class="form-control" value="{{ request('q') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select name="category" class="form-select">
                            <option value="">-- Tất cả --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brand" class="form-select">
                            <option value="">-- Tất cả --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" @selected(request('brand') == $brand->id)>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá từ</label>
                        <input type="number" name="min_price" class="form-control" value="{{ request('min_price') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giá đến</label>
                        <input type="number" name="max_price" class="form-control" value="{{ request('max_price') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Màu sắc</label>
                        <input type="text" name="color" class="form-control" value="{{ request('color') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tốc độ tối thiểu (km/h)</label>
                        <input type="number" name="max_speed" class="form-control" value="{{ request('max_speed') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quãng đường tối thiểu (km)</label>
                        <input type="number" name="range_per_charge" class="form-control" value="{{ request('range_per_charge') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sắp xếp</label>
                        <select name="sort" class="form-select">
                            <option value="">-- Chọn --</option>
                            <option value="price_asc" @selected(request('sort')=='price_asc')>Giá tăng dần</option>
                            <option value="price_desc" @selected(request('sort')=='price_desc')>Giá giảm dần</option>
                            <option value="newest" @selected(request('sort')=='newest')>Mới nhất</option>
                            <option value="best_seller" @selected(request('sort')=='best_seller')>Bán chạy</option>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">Lọc sản phẩm</button>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Đặt lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="m-0">Danh sách xe máy điện</h3>
            <span class="text-muted">{{ $products->total() }} sản phẩm</span>
        </div>

        <div class="row">
            @forelse($products as $product)
                @include('components.product-card', ['product' => $product])
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Không có sản phẩm phù hợp.</div>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection