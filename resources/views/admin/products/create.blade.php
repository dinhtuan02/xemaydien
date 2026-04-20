@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')
@section('page-title', 'Thêm sản phẩm')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thương hiệu</label>
                    <select name="brand_id" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', 0) }}">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Màu sắc</label>
                    <input type="text" name="color" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Tốc độ tối đa</label>
                    <input type="number" name="max_speed" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Quãng đường</label>
                    <input type="number" name="range_per_charge" class="form-control">
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Thời gian sạc</label>
                    <input type="number" name="charging_time" class="form-control">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" name="thumbnail" class="form-control image-input" data-preview="#thumbPreview">
                    <img id="thumbPreview" class="mt-2 rounded d-none" width="120">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="short_description" rows="3" class="form-control"></textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea name="description" rows="5" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thông số 1: Động cơ</label>
                    <input type="text" name="specifications[Động cơ]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thông số 2: Pin/Ắc quy</label>
                    <input type="text" name="specifications[Pin/Ắc quy]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thông số 3: Tốc độ tối đa</label>
                    <input type="text" name="specifications[Tốc độ tối đa]" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thông số 4: Quãng đường</label>
                    <input type="text" name="specifications[Quãng đường]" class="form-control">
                </div>

                <div class="col-12 mb-3 d-flex gap-3 flex-wrap">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_featured" value="1">
                        <label class="form-check-label">Nổi bật</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_new" value="1">
                        <label class="form-check-label">Mới</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_sale" value="1">
                        <label class="form-check-label">Khuyến mãi</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                        <label class="form-check-label">Hiển thị</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">Lưu sản phẩm</button>
        </form>
    </div>
</div>
@endsection