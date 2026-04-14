@extends('layouts.admin')

@section('title', 'Cập nhật banner')
@section('page-title', 'Cập nhật banner')

@section('content')
<form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $banner->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Link</label>
            <input type="text" name="link" class="form-control"
                   value="{{ old('link', $banner->link) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="position" class="form-control"
                   value="{{ old('position', $banner->position) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh hiện tại</label><br>

            <img
                src="{{ $banner->image ? asset('storage/' . $banner->image) : asset('assets/images/no-image.png') }}"
                width="200"
                class="rounded mb-2"
                id="previewImage"
            >
        </div>

        <div class="mb-3">
            <label class="form-label">Chọn ảnh mới (nếu muốn thay)</label>
            <input type="file"
                   name="image"
                   class="form-control image-input"
                   data-preview="#previewImage">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_active"
                   class="form-check-input"
                   {{ $banner->is_active ? 'checked' : '' }}>
            <label class="form-check-label">Hiển thị</label>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
        <button class="btn btn-primary">Cập nhật</button>
    </div>
</div>

</form>
@endsection