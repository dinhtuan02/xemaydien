@extends('layouts.app')

@section('title', '404')

@section('content')
<div class="text-center py-5">
    <h1>404</h1>
    <p>Trang bạn tìm kiếm không tồn tại.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
</div>
@endsection