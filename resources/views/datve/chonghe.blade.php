@extends('layout')

@section('content')
<div class="container mt-4">
    <h3 class="text-center fw-bold">
        Chọn ghế – {{ $suat->phim->ten_phim }}
    </h3>

    <p class="text-center text-secondary">
        Phòng: {{ $suat->phong->ten_phong }} | Giờ chiếu: {{ $suat->gio_bat_dau }}
    </p>

    <form action="{{ route('datve.xacnhan') }}" method="POST">
        @csrf
        <input type="hidden" name="suat_chieu_id" value="{{ $suat->id }}">

        <div class="seat-area text-center">

            @foreach($gheTheohang as $hang => $dsGhe)
                <div class="seat-row mb-2">

                    <div class="fw-bold text-warning mb-1">{{ $hang }}</div>

                    @foreach($dsGhe as $g)
                        @php
                            $isBooked = in_array($g->id, $gheDaDat);
                        @endphp

                        <label class="seat {{ $isBooked ? 'booked' : '' }}">
                            <input type="checkbox"
                                   name="ghe[]"
                                   value="{{ $g->id }}"
                                   {{ $isBooked ? 'disabled' : '' }}>

                            <span>{{ $g->nhan_ghe }}</span>
                        </label>
                    @endforeach

                </div>
            @endforeach

        </div>

        <div class="text-center mt-4">
            <button class="btn btn-warning px-4 fw-bold">XÁC NHẬN GHẾ</button>
        </div>
    </form>
</div>

<style>
.seat {
    display: inline-block;
    width: 45px;
    height: 45px;
    margin: 4px;
    border-radius: 8px;
    background: #222;
    border: 2px solid #666;
    cursor: pointer;
    transition: 0.2s;
}
.seat span {
    color: white;
    line-height: 42px;
    font-size: 14px;
    display: block;
}
.seat input {
    display: none;
}
.seat:hover {
    border-color: #f1c40f;
}
.seat input:checked + span {
    background: #f1c40f;
    color: black;
    font-weight: bold;
}
.seat.booked {
    background: #444 !important;
    border-color: #888;
    cursor: not-allowed;
}
.seat.booked span {
    color: #bbb !important;
}
</style>
@endsection
