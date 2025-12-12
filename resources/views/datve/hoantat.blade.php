@extends('layout')

@section('content')

<div class="d-flex justify-content-center mt-4 mb-5">
    <div class="card shadow-lg border-0 p-4" style="max-width: 520px; width: 100%; border-radius: 16px;">

        <!-- ICON CHECK -->
        <div class="text-center mb-3">
            <i class="fas fa-check-circle text-success" style="font-size: 70px;"></i>
        </div>

        <h3 class="text-center fw-bold text-primary mb-2">
            ĐẶT VÉ THÀNH CÔNG!
        </h3>

        <p class="text-center text-muted mb-4">Cảm ơn bạn đã đặt vé tại hệ thống rạp của chúng tôi.</p>

        <hr>

        <!-- THÔNG TIN VÉ -->
        <h5 class="fw-bold mb-3"> Thông tin vé</h5>

        <div class="mb-2">
            <strong> Phim:</strong>  
            <span class="text-dark">{{ $datVe->suatChieu->phim->ten_phim }}</span>
        </div>

        <div class="mb-2">
            <strong> Suất chiếu:</strong> 
            {{ \Carbon\Carbon::parse($datVe->suatChieu->gio_bat_dau)->format('H:i d/m/Y') }}
        </div>

        <div class="mb-2">
            <strong>Mã vé:</strong> 
            <span class="badge bg-primary" style="font-size: 14px;">
                #{{ $datVe->id }}
            </span>
        </div>

        <div class="mb-2">
            <strong>Ghế:</strong><br>

            @foreach($datVe->gheDat as $ct)
                <span class="badge bg-success me-1 mb-1" style="font-size: 14px;">
                    {{ $ct->ghe->nhan_ghe }}
                </span>
            @endforeach
        </div>

        <div class="mb-3">
            <strong> Tổng tiền:</strong> 
            <span class="text-danger fw-bold">
                {{ number_format($datVe->tong_tien, 0, ',', '.') }} đ
            </span>
        </div>

        <hr>

        <!-- QR CODE -->
        @php
            // Nếu thanh toán chưa có mã giao dịch → tự phát sinh mã tạm
            $maGiaoDich = $datVe->thanhToan->ma_giao_dich ?? ('GD' . time() . rand(1000,9999));

            $qrContent = base64_encode(json_encode([
                'ma_giao_dich' => $maGiaoDich,
                'ma_ve'        => $datVe->id,
                'phim'         => $datVe->suatChieu->phim->ten_phim,
                'suat'         => \Carbon\Carbon::parse($datVe->suatChieu->gio_bat_dau)->format('H:i d/m/Y'),
            ], JSON_UNESCAPED_UNICODE));
        @endphp

        <div class="text-center mt-4">
            <h5 class="fw-bold mb-2"> Mã QR Check-in</h5>

            <div class="p-3 border rounded bg-light d-inline-block">
                {!! QrCode::size(170)->generate($qrContent) !!}
            </div>

            <p class="small text-muted mt-2">
                Quét mã QR để kiểm tra vé và xác thực giao dịch.
            </p>
        </div>

        <hr>

        <!-- NÚT -->
        <div class="text-center mt-3">
            <a href="{{ route('phim.index', ['tab' => 'dang-chieu']) }}" 
               class="btn btn-secondary px-4">
                ← Quay về danh sách phim
            </a>
        </div>

    </div>
</div>

@endsection
