@extends('layouts.admin')

@section('title', 'Banner')
@section('page-title', 'Quản lý banner')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
            <h5>Danh sách banner</h5>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Thêm banner</a>
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Tiêu đề</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($banners as $banner)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/'.$banner->image) }}" width="120">
                        </td>
                        <td>{{ $banner->title }}</td>
                        <td>{{ $banner->is_active ? 'Hiển thị' : 'Ẩn' }}</td>
                        <td>
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Xóa banner?">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection