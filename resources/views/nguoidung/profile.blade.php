@extends('layout')

@section('content')

<div class="container mt-5">

    <div class="mx-auto p-4 p-md-5 rounded-4 shadow-lg" 
         style="max-width: 600px; background: #3e3e3e;">

        <h2 class="text-center fw-bold mb-4 text-warning">
             Thông tin người dùng
        </h2>

        <div class="text-light fs-5">
            <p><strong>Họ tên:</strong> {{ $user->ho_ten }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $user->so_dien_thoai ?? 'Chưa cập nhật' }}</p>

            <p><strong>Ngày tạo tài khoản:</strong>
                {{ $user->ngay_tao 
                    ? \Carbon\Carbon::parse($user->ngay_tao)->format('d/m/Y') 
                    : 'Chưa cập nhật' 
                }}
            </p>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('nguoidung.history') }}" 
               class="btn btn-primary px-4 py-2 rounded-3 fw-bold">
                 Xem lịch sử đặt vé
            </a>
        </div>

    </div>
</div>

@endsection
