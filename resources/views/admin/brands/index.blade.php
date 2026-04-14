@extends('layouts.admin')

@section('title', 'Quản lý thương hiệu')
@section('page-title', 'Quản lý thương hiệu')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between mb-3">
            <h5>Danh sách thương hiệu</h5>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">Thêm thương hiệu</a>
        </div>

        <table class="table align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th width="150">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{ $brand->id }}</td>
                        <td>
                            <img src="{{ $brand->logo ? asset('storage/'.$brand->logo) : asset('assets/images/no-image.png') }}"
                                 width="50">
                        </td>
                        <td>{{ $brand->name }}</td>
                        <td>
                            <span class="badge bg-{{ $brand->is_active ? 'success' : 'secondary' }}">
                                {{ $brand->is_active ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning btn-sm">Sửa</a>

                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" data-confirm="Xóa thương hiệu này?">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $brands->links() }}

    </div>
</div>
@endsection