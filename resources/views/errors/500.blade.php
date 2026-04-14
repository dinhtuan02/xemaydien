@extends('layouts.app')

@section('title', '500')

@section('content')
<div class="text-center py-5">
    <h1>500</h1>
    <p>Đã có lỗi hệ thống xảy ra.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
</div>
@endsection