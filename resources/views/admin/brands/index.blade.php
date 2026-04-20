@extends('layouts.admin')

@section('title', 'Quản lý thương hiệu')
@section('page-title', 'Quản lý thương hiệu')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Danh sách thương hiệu</h5>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm thương hiệu</a>
        </div>

        <form class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tìm thương hiệu...">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">Tìm kiếm</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Tên</th>
                        <th>Slug</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td><img src="{{ $brand->logo_url }}" width="50" class="rounded border"></td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>
                                <span class="badge bg-{{ $brand->is_active ? 'success' : 'secondary' }}">
                                    {{ $brand->is_active ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" data-confirm="Xóa thương hiệu này?">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có dữ liệu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $brands->links() }}
        </div>

    </div>
</div>
@endsection