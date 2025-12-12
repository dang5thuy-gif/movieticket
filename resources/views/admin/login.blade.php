@extends('layout')

@section('content')

{{-- Hiển thị lỗi và thông báo trên console --}}
<script>
    @if ($errors->any())
        console.log(" Đăng nhập thất bại: {{ $errors->first() }}");
    @endif

    @if (session('success'))
        console.log("{{ session('success') }}");
    @endif
</script>

{{-- LINK CSS ĐĂNG NHẬP ADMIN --}}
<link rel="stylesheet" href="{{ asset('css/adminlogin.css') }}">

<div class="login-wrapper d-flex justify-content-center align-items-center">
    
    <div class="login-card text-light">

        {{-- TITLE --}}
        <h3 class="text-center mb-4 fw-bold login-title">
            <i class="bi bi-shield-lock-fill me-2"></i>Admin Login
        </h3>

        {{-- FORM LOGIN --}}
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control login-input"
                       placeholder="Nhập email..." required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Mật khẩu</label>
                <input type="password" name="password" class="form-control login-input"
                       placeholder="Nhập mật khẩu..." required>
            </div>

            <button type="submit" class="btn login-btn w-100 fw-bold mt-3">
                ĐĂNG NHẬP
            </button>
        </form>

    </div>

</div>

@endsection
