@extends('layouts.app')

@section('title', 'Sản phẩm yêu thích')

@section('content')
<h3 class="mb-4">Danh sách yêu thích</h3>

<div class="row">
    @forelse($wishlists as $wishlist)
        @include('components.product-card', ['product' => $wishlist->product])
    @empty
        <div class="alert alert-info">Chưa có sản phẩm yêu thích nào.</div>
    @endforelse
</div>
@endsection