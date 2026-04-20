@extends('layouts.admin')

@section('title', 'Quản lý khách hàng')
@section('page-title', 'Quản lý khách hàng')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form class="row g-2 mb-3">
            <div class="col-md-4">
                <input name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Tên, email, số điện thoại">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Tìm</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100">Đặt lại</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th class="text-end"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                                    {{ $user->is_active ? 'Hoạt động' : 'Đã khóa' }}
                                </span>
                            </td>
                            <td class="text-end">
                                <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-warning">
                                        {{ $user->is_active ? 'Khóa' : 'Mở khóa' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có khách hàng.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $users->links() }}
        </div>

    </div>
</div>
@endsection