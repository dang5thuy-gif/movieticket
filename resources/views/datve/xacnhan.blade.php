@extends('layout')

@section('content')
<h3 class="mb-3 text-warning fw-bold">Xác nhận đặt vé</h3>

<div class="card bg-dark text-light p-4 mb-4 shadow">

    <h4 class="fw-bold">{{ $suat->phim->ten_phim }}</h4>
    <p class="small text-muted">
        Suất: {{ $suat->gio_bat_dau->format('H:i d/m/Y') }}
    </p>

    <p class="mt-3 fw-bold"> Ghế bạn chọn:</p>
    <ul class="mb-3">
        @foreach($ghe as $g)
            <li>{{ $g }}</li>
        @endforeach
    </ul>

    {{--  FORM NHẬP MÃ KHUYẾN MÃI --}}
    <form method="POST" action="{{ route('datve.xacnhan') }}" class="mb-3">
        @csrf

        <input type="hidden" name="suat_chieu_id" value="{{ $suat->id }}">

        @foreach($ghe as $g)
            <input type="hidden" name="ghe[]" value="{{ $g }}">
        @endforeach

        <label class="form-label text-warning fw-bold"> Mã khuyến mãi</label>

        <div class="input-group">
            <input type="text"
                name="ma_khuyen_mai"
                class="form-control bg-dark text-light border-secondary"
                placeholder="Nhập mã giảm giá..."
                value="{{ old('ma_khuyen_mai', $maNhap) }}">

            <button class="btn btn-outline-warning">
                Áp dụng
            </button>
        </div>

        {{-- HIỂN THỊ LỖI MÃ KM --}}
        @if(!empty($kmError))
            <div class="alert alert-danger mt-2 p-2">
                {{ $kmError }}
            </div>
        @endif
    </form>



    {{--  HIỂN THỊ GIÁ TIỀN --}}
    <div class="mt-3">
        <p class="text-light">
             <strong>Tổng tiền gốc:</strong>
            {{ number_format($tongTienGoc) }} đ
        </p>

        @if($giamGia > 0)
            <p class="text-success">
                 Giảm giá ({{ $maKM->phan_tram_giam }}%):
                <strong>-{{ number_format($giamGia) }} đ</strong>
                <br>
                <span class="small">Áp dụng mã: <b>{{ $maKM->ma }}</b></span>
            </p>
        @endif

        <h4 class="text-warning fw-bold">
            Tổng thanh toán: {{ number_format($tongTienSauGiam) }} đ
        </h4>
    </div>

    {{--  FORM THANH TOÁN --}}
    <form method="POST" action="{{ route('datve.thanh-toan') }}" class="mt-4">
        @csrf

        <input type="hidden" name="suat_chieu_id" value="{{ $suat->id }}">
        <input type="hidden" name="ma_khuyen_mai" value="{{ $maNhap }}">

        @foreach($ghe as $g)
            <input type="hidden" name="ghe[]" value="{{ $g }}">
        @endforeach

        <div class="mb-3">
            <label class="form-label fw-bold">Chọn phương thức thanh toán</label>
            <select name="hinh_thuc" class="form-select bg-dark text-light border-secondary" required>
                <option value="">-- Chọn phương thức --</option>
                <option value="MOMO">MOMO</option>
                <option value="VNPAY">VNPAY</option>
                <option value="ZALOPAY">ZaloPay</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100 fw-bold">Thanh toán & Lưu vé</button>
        <a href="{{ url()->previous() }}" class="btn btn-outline-light w-100 mt-2">Quay lại</a>
    </form>

</div>
@endsection
