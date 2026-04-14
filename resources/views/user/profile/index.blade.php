@extends('layouts.app')

@section('title', 'Hồ sơ cá nhân')

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h4 class="mb-3">Cập nhật thông tin cá nhân</h4>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Họ tên</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ</label>
                        <textarea name="address" class="form-control">{{ old('address', auth()->user()->address) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh đại diện</label>
                        <input type="file" name="avatar" class="form-control image-input" data-preview="#avatarPreview">
                        <img
                            id="avatarPreview"
                            src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : '' }}"
                            class="mt-2 rounded {{ auth()->user()->avatar ? '' : 'd-none' }}"
                            width="120"
                            alt="Avatar preview"
                        >
                    </div>

                    <button class="btn btn-primary">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Đổi mật khẩu</h4>

                <form action="{{ route('profile.change-password') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu hiện tại</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu mới</label>
                        <input type="password" name="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Xác nhận mật khẩu mới</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-warning">Đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection