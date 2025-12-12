@extends('layout')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card bg-dark border-0 shadow-lg p-4 text-light" style="width: 450px; border-radius: 12px;">

        <ul class="nav nav-tabs mb-3">
            <li class="nav-item">
                <a class="nav-link fw-bold" href="{{ route('login') }}">Đăng Nhập</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active fw-bold" href="{{ route('register') }}">Đăng Ký</a>
            </li>
        </ul>

        <h3 class="text-center mb-3 fw-bold text-success"> Đăng Ký Tài Khoản</h3>

        <form action="{{ route('register.post') }}" method="POST">
            @csrf

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

        <!-- Họ tên -->
        <div class="mb-3 form-box">
            <label>Họ tên</label>
            <input type="text" name="ho_ten" class="form-control custom-input" required>
        </div>

        <!-- Email -->
        <div class="mb-3 form-box">
            <label>Email</label>
            <input type="email" name="email" class="form-control custom-input" required>
        </div>

        <!-- Số điện thoại (THÊM MỚI) -->
        <div class="mb-3 form-box">
            <label>Số điện thoại</label>
            <input type="text" name="so_dien_thoai" class="form-control custom-input" required>
        </div>

        <!-- Mật khẩu -->
        <div class="mb-3 form-box">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control custom-input" required>
        </div>

        <!-- Xác nhận mật khẩu -->
        <div class="mb-3 form-box">
            <label>Xác nhận mật khẩu</label>
            <input type="password" name="password_confirmation" class="form-control custom-input" required>
        </div>

        <button class="btn btn-success btn-custom w-100">Đăng Ký</button>

    </div>
</div>
@endsection
