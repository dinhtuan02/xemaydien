@extends('layouts.admin')

@section('title', 'Cập nhật thương hiệu')
@section('page-title', 'Cập nhật thương hiệu')

@section('content')
<form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card border-0 shadow-sm">
        <div class="card-body">

            <div class="mb-3">
                <label class="form-label">Tên thương hiệu</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $brand->name) }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input
                    type="text"
                    name="slug"
                    class="form-control"
                    value="{{ old('slug', $brand->slug) }}"
                >
                <small class="text-muted">Có thể để trống để hệ thống tự tạo.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Mô tả</label>
                <textarea
                    name="description"
                    class="form-control"
                    rows="4"
                >{{ old('description', $brand->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Logo hiện tại</label><br>

                @php
                    $logoUrl = $brand->logo
                        ? (str_starts_with($brand->logo, 'assets/')
                            ? asset($brand->logo)
                            : asset('storage/' . $brand->logo))
                        : asset('assets/images/no-image.png');
                @endphp

                <img
                    id="logoPreview"
                    src="{{ $logoUrl }}"
                    alt="{{ $brand->name }}"
                    class="rounded border"
                    width="120"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Chọn logo mới</label>
                <input
                    type="file"
                    name="logo"
                    class="form-control image-input"
                    data-preview="#logoPreview"
                >
                <small class="text-muted">Không chọn nếu muốn giữ logo cũ.</small>
            </div>

            <div class="form-check">
                <input
                    type="checkbox"
                    name="is_active"
                    value="1"
                    class="form-check-input"
                    {{ old('is_active', $brand->is_active) ? 'checked' : '' }}
                >
                <label class="form-check-label">Hiển thị</label>
            </div>

        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Quay lại</a>
            <button class="btn btn-primary">Cập nhật thương hiệu</button>
        </div>
    </div>
</form>
@endsection