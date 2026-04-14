@extends('layouts.admin')

@section('title', 'Thêm thương hiệu')
@section('page-title', 'Thêm thương hiệu')

@section('content')
<form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="mb-3">
            <label>Tên</label>
            <input name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="logo" class="form-control image-input" data-preview="#logoPreview">
            <img id="logoPreview" class="mt-2 d-none" width="100">
        </div>

        <div class="form-check">
            <input type="checkbox" name="is_active" checked class="form-check-input">
            <label class="form-check-label">Hiển thị</label>
        </div>

    </div>

    <div class="card-footer">
        <button class="btn btn-primary">Lưu</button>
    </div>
</div>

</form>
@endsection