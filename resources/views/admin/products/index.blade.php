@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')
@section('page-title', 'Quản lý sản phẩm')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h5>Danh sách sản phẩm</h5>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm sản phẩm</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table mb-0 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Thương hiệu</th>
                    <th>Giá</th>
                    <th>SL</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ $product->thumbnail_url }}" width="60" class="rounded border" alt="{{ $product->name }}"></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '' }}</td>
                        <td>{{ $product->brand->name ?? '' }}</td>
                        <td>{{ number_format($product->final_price) }}đ</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            <span class="badge bg-{{ $product->is_active ? 'success' : 'secondary' }}">
                                {{ $product->is_active ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa sản phẩm này?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $products->links() }}
</div>
@endsection