@extends('layouts.admin')

@section('title', 'Quản lý banner')
@section('page-title', 'Quản lý banner')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0">Danh sách banner</h5>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Thêm banner</a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Link</th>
                        <th>Vị trí</th>
                        <th>Trạng thái</th>
                        <th class="text-end">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($banners as $banner)
                        <tr>
                            <td><img src="{{ $banner->image_url }}" width="140" class="rounded border"></td>
                            <td>{{ $banner->title }}</td>
                            <td>{{ $banner->link }}</td>
                            <td>{{ $banner->position }}</td>
                            <td>
                                <span class="badge bg-{{ $banner->is_active ? 'success' : 'secondary' }}">
                                    {{ $banner->is_active ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" data-confirm="Xóa banner này?">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có banner nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $banners->links() }}
        </div>

    </div>
</div>
@endsection