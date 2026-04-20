@extends('layouts.admin')

@section('title', 'Quản lý đánh giá')
@section('page-title', 'Quản lý đánh giá')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tìm theo tên sản phẩm">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Tìm</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.reviews.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Người dùng</th>
                        <th>Số sao</th>
                        <th>Bình luận</th>
                        <th>Trạng thái</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reviews as $review)
                        <tr>
                            <td>{{ $review->product->name ?? '' }}</td>
                            <td>{{ $review->user->name ?? '' }}</td>
                            <td>{{ $review->rating }}/5</td>
                            <td>{{ $review->comment }}</td>
                            <td>
                                <span class="badge bg-{{ $review->is_approved ? 'success' : 'secondary' }}">
                                    {{ $review->is_approved ? 'Đã duyệt' : 'Đang ẩn' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form action="{{ route('admin.reviews.approve', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-success">
                                        {{ $review->is_approved ? 'Ẩn' : 'Duyệt' }}
                                    </button>
                                </form>

                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" data-confirm="Xóa đánh giá này?">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có đánh giá nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $reviews->links() }}
        </div>

    </div>
</div>
@endsection