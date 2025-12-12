@extends('layout')

@section('title', $phim->ten_phim)

@section('content')

<div class="container py-5 text-white">

    {{-- THÔNG TIN PHIM --}}
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('images/' . $phim->anh_bia) }}" class="w-100 rounded shadow">
        </div>

        <div class="col-md-8">
            <h2 class="fw-bold text-warning">{{ $phim->ten_phim }}</h2>

            <div class="p-3 rounded-3" style="background:rgba(255,255,255,0.05);">

                {{-- Đánh giá --}}
                <p> <strong>{{ $phim->danh_gia ?? 'Chưa có đánh giá' }}</strong></p>

                {{-- Thời lượng --}}
                <p> Thời lượng: <strong>{{ $phim->thoi_luong }}'</strong></p>

                {{-- Ngày khởi chiếu --}}
                <p> Khởi chiếu: 
                    <strong>{{ $phim->ngay_cong_chieu->format('d/m/Y') }}</strong>
                </p>

                {{-- Ngôn ngữ --}}
                <p> Ngôn ngữ: <strong>{{ $phim->ngon_ngu }}</strong></p>

                {{-- THỂ LOẠI PHIM --}}
                @if($phim->the_loai)
                    <p> Thể loại:
                        @foreach (explode(',', $phim->the_loai) as $loai)
                            <span class="badge bg-warning text-dark me-1">{{ trim($loai) }}</span>
                        @endforeach
                    </p>
                @endif
            </div>
            
            {{-- Mô tả--}}
            <h4 class="fw-bold" 
                style="margin-top: 10px !important; margin-bottom: 4px !important; line-height: 1;">
                MÔ TẢ
            </h4>
            <p class="text-light" 
            style="white-space: pre-line; margin-top: 0px !important; margin-bottom: 12px !important; line-height: 1.35;">
                {{ $phim->mo_ta }}
            </p>


            {{-- Nội dung --}}
            <h4 class="fw-bold"
                style="margin-top: 8px !important; margin-bottom: 4px !important; line-height: 1;">
                NỘI DUNG PHIM
            </h4>
            <p class="text-light"
            style="white-space: pre-line; margin-top: 0px !important; margin-bottom: 0 !important; line-height: 1.35;">
                {{ $phim->noi_dung_phim }}
            </p>


            {{-- Nút trailer + đặt vé --}}
            <div class="mt-3">
                @if($phim->trailer)
                    <a href="{{ $phim->trailer }}" class="btn btn-outline-light me-2" target="_blank">
                        ▶ Trailer
                    </a>
                @endif

                <a href="{{ route('datve.chon-rap', $phim->id) }}" class="btn btn-warning">
                    🎫 Đặt vé ngay
                </a>
            </div>
        </div>
    </div>

    {{-- BỘ LỌC --}}
    @include('phim.partials.boloc')

{{-- DROPDOWN CHỌN THÀNH PHỐ (luôn hiển thị) --}}
<div class="d-flex justify-content-between align-items-center mt-5 mb-3"
    style="max-width:1200px; margin:auto;">

    <h2 class="fw-bold text-warning m-0">DANH SÁCH RẠP</h2>

    @include('phim.partials.dropdown-city', [
        'city' => $city,
        'ngay' => $ngay,
        'cities' => $cities
    ])
</div>


{{-- NẾU CÓ SUẤT CHIẾU --}}
@if(count($suatChieuTheoRap) > 0)

    @foreach ($suatChieuTheoRap as $tenRap => $dsSuat)

        @php
            $randomId = 'rap_' . md5($tenRap);
            $groupPhong = $dsSuat->groupBy('ten_phong');
            $rap = $dsSuat->first();
        @endphp

        <div class="mx-auto mb-4 p-4 rounded-4"
            style="max-width:1200px; background:#6823A3; border-left:7px solid #ffdd33;">

            <div class="d-flex justify-content-between align-items-center"
                onclick="document.getElementById('{{ $randomId }}').classList.toggle('d-none')"
                style="cursor:pointer;">

                <h3 class="fw-bold text-warning">
                    {{ $tenRap }} ({{ $rap->thanh_pho }})
                </h3>

                <i class="bi bi-chevron-down text-warning fs-3"></i>
            </div>

            <p class="opacity-75">{{ $rap->dia_chi }}</p>

            <div id="{{ $randomId }}" class="mt-3 d-none">

                @foreach ($groupPhong as $phong => $list)
                    <h5 class="text-info fw-bold mt-3">Phòng: {{ $phong }}</h5>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($list as $suat)
                            <a href="{{ route('datve.chon-ghe', $suat->id) }}"
                               class="px-3 py-2 rounded text-warning border border-warning"
                               style="background:rgba(255,255,255,0.05);">
                                {{ \Carbon\Carbon::parse($suat->gio_bat_dau)->format('H:i') }}
                            </a>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>

    @endforeach

@else
    {{-- KHÔNG CÓ SUẤT CHIẾU --}}
    <div class="text-center text-secondary mt-5" style="max-width:1200px; margin:auto;">
        <p class="fs-5"> Hiện không có suất chiếu nào cho thành phố.</p>
        <p>Vui lòng chọn thành phố khác.</p>
    </div>
@endif


</div>

@endsection
