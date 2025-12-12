@extends('layout')

@section('content')
<div class="container py-5">

    <a href="{{ route('khuyenmai.indexkhuyenmai') }}" class="text-warning">&larr; Quay lại</a>

    <div class="card bg-dark text-light border-warning p-4 mt-3">

        <h2 class="fw-bold text-warning"> {{ $km->ma }}</h2>

        <p class="mt-3 fs-5">Giảm giá: <b>{{ $km->phan_tram_giam }}%</b></p>
        <p>Thời gian áp dụng:</p>
        <ul>
            <li>Từ: {{ date('d/m/Y', strtotime($km->ngay_bat_dau)) }}</li>
            <li>Đến: {{ date('d/m/Y', strtotime($km->ngay_ket_thuc)) }}</li>
        </ul>

        @if($km->conHan())
            <span class="badge bg-success fs-6">Mã còn hiệu lực</span>
        @else
            <span class="badge bg-secondary fs-6">Mã đã hết hạn</span>
        @endif

        <div class="mt-4">
            @if($km->conHan())
                <a href="{{ route('datve.chon-phim', ['ma_km' => $km->ma]) }}"
                   class="btn btn-warning px-4 py-2 fw-bold">
                    Dùng mã này & Đặt vé ngay →
                </a>
            @else
                <p class="text-muted fst-italic">Không thể áp dụng mã đã hết hạn.</p>
            @endif
        </div>

    </div>
</div>
@endsection
