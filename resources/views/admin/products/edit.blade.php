@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')
@section('page-title', 'Sửa sản phẩm')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Danh mục</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected($product->category_id == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Thương hiệu</label>
                    <select name="brand_id" class="form-select">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Giá khuyến mãi</label>
                    <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price', $product->sale_price) }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Số lượng</label>
                    <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}">
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Ảnh đại diện</label>
                    <input type="file" name="thumbnail" class="form-control image-input" data-preview="#thumbPreview">
                    <img
                        id="thumbPreview"
                        src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : '' }}"
                        class="mt-2 rounded {{ $product->thumbnail ? '' : 'd-none' }}"
                        width="120"
                        alt="Thumbnail preview"
                    >
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả ngắn</label>
                    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="col-12 mb-3">
                    <label class="form-label">Mô tả chi tiết</label>
                    <textarea name="description" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="col-12 mb-3 d-flex gap-3 flex-wrap">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }}>
                        <label class="form-check-label">Nổi bật</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_new" value="1" {{ $product->is_new ? 'checked' : '' }}>
                        <label class="form-check-label">Mới</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_sale" value="1" {{ $product->is_sale ? 'checked' : '' }}>
                        <label class="form-check-label">Khuyến mãi</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                        <label class="form-check-label">Hiển thị</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary">Cập nhật sản phẩm</button>
        </form>
    </div>
</div>
@endsection