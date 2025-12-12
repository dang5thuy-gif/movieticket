@extends('layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark border-0 shadow-lg p-4 text-light" style="width: 450px; border-radius: 12px;">

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link active fw-bold" href="{{ route('login') }}">Đăng Nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ route('register') }}">Đăng Ký</a>
            </li>
        </ul>

        <h3 class="text-center mb-3 fw-bold text-warning"> Đăng Nhập</h3>

        {{-- Thông báo từ middleware / hệ thống --}}
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mb-3" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger mb-3">{{ $errors->first() }}</div>
            @endif

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control bg-dark text-light border-secondary" required>
            </div>

            <button class="btn btn-primary w-100 fw-bold">Đăng Nhập</button>
        </form>

        {{-- ------- NÚT ĐĂNG NHẬP GOOGLE ------- --}}
        <hr class="text-secondary">

        <a href="{{ route('google.login') }}" 
        class="btn btn-outline-light w-100 mt-2 fw-bold d-flex align-items-center justify-content-center"
        style="gap:10px; border-color:#db4437; color:#db4437;">
            <img src="https://developers.google.com/identity/images/g-logo.png" 
                width="20" height="20" 
                style="background:white; border-radius:50%;">
            Đăng nhập bằng Google
        </a>


    </div>
</div>
@endsection
