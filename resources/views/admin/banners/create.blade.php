@extends('layouts.admin')

@section('title', 'Thêm banner')
@section('page-title', 'Thêm banner')

@section('content')
<form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Link (nếu có)</label>
            <input type="text" name="link" class="form-control" value="{{ old('link') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Thứ tự hiển thị</label>
            <input type="number" name="position" class="form-control" value="{{ old('position', 0) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ảnh banner</label>
            <input type="file"
                   name="image"
                   class="form-control image-input"
                   data-preview="#previewImage"
                   required>

            <img id="previewImage" class="mt-3 rounded d-none" width="200">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_active" class="form-check-input" checked>
            <label class="form-check-label">Hiển thị</label>
        </div>

    </div>

    <div class="card-footer d-flex justify-content-between">
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Quay lại</a>
        <button class="btn btn-primary">Lưu banner</button>
    </div>
</div>

</form>
@endsection