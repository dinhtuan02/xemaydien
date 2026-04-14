@extends('layouts.app')

@section('title', '403')

@section('content')
<div class="text-center py-5">
    <h1>403</h1>
    <p>Bạn không có quyền truy cập trang này.</p>
    <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
</div>
@endsection