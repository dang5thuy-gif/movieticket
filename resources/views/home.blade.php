@extends('layout')
@section('content')

<div class="card bg-light p-2 mb-4 shadow-sm border-0" style="border-radius: 6px; max-width: 1000px; margin: 0 auto;">
    <form class="row align-items-center g-2 justify-content-center text-center" onsubmit="return false;">
        <div class="col-auto">
            <h6 class="fw-bold mb-0 text-dark px-2">ĐẶT VÉ NHANH</h6>
        </div>

        <div class="col-auto">
            <select class="form-select form-select-sm fw-semibold text-center"
                    style="width: 140px; height: 38px; border: 1.5px solid #6f42c1; color: #6f42c1; border-radius: 6px;">
                <option selected>1. Chọn Rạp</option>
                <option>CGV - HCM</option>
                <option>Lotte - HN</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="form-select form-select-sm fw-semibold text-center"
                    style="width: 150px; height: 38px; border: 1.5px solid #6f42c1; color: #6f42c1; border-radius: 6px;">
                <option selected>2. Chọn Phim</option>
                <option>Dune 2</option>
                <option>Black Adam</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="form-select form-select-sm fw-semibold text-center"
                    style="width: 145px; height: 38px; border: 1.5px solid #6f42c1; color: #6f42c1; border-radius: 6px;">
                <option selected>3. Chọn Ngày</option>
                <option>28/10</option>
                <option>29/10</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="form-select form-select-sm fw-semibold text-center"
                    style="width: 150px; height: 38px; border: 1.5px solid #6f42c1; color: #6f42c1; border-radius: 6px;">
                <option selected>4. Chọn Suất</option>
                <option>10:00 AM</option>
                <option>13:30 PM</option>
            </select>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn fw-bold text-light px-4"
                    style="background-color: #6f42c1; height: 38px; border-radius: 6px;">
                ĐẶT NGAY
            </button>
        </div>
    </form>
</div>

<section class="text-center py-5">
    <h2 class="fw-bold mb-4 text-uppercase text-warning"> Phim Đang Chiếu</h2>

    <div class="container">
        <div class="row justify-content-center g-4">

            @foreach($phimDangChieu as $phim)
            <div class="col-6 col-md-3">

                <div class="card bg-transparent border-0 text-center h-100">

                    <div class="position-relative overflow-hidden rounded-3 shadow-sm">

                        {{--  CLICK ẢNH → XEM CHI TIẾT --}}
                        <a href="{{ route('phim.show', $phim->id) }}">
                            <img src="{{ asset('images/' . ($phim->anh_bia ?? 'default.jpg')) }}" 
                                 alt="{{ $phim->ten_phim }}" 
                                 class="img-fluid rounded-3"
                                 style="height: 400px; object-fit: cover;">
                        </a>

                        {{-- Trailer --}}
                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 py-2">
                            <a href="{{ $phim->trailer }}" 
                               target="_blank" 
                               class="btn btn-outline-warning btn-sm fw-bold">
                                🎞 Xem Trailer
                            </a>
                        </div>

                    </div>

                    {{--  CLICK TÊN → XEM CHI TIẾT --}}
                    <h6 class="mt-3 fw-bold text-uppercase text-light text-truncate">
                        <a href="{{ route('phim.show', $phim->id) }}" 
                           class="text-warning text-decoration-none">
                            {{ $phim->ten_phim }}
                        </a>
                    </h6>

                </div>
            </div>
            @endforeach

        </div>
    </div>

    {{-- PHIM SẮP CHIẾU --}}
    <h2 class="fw-bold mb-4 mt-5 text-uppercase text-warning"> Phim Sắp Chiếu</h2>

    <div class="container">
        <div class="row justify-content-center g-4">

            @foreach($phimSapChieu as $phim)
            <div class="col-6 col-md-3">

                <div class="card bg-transparent border-0 text-center h-100">

                    <div class="position-relative overflow-hidden rounded-3 shadow-sm">

                        {{-- ẢNH --}}
                        <a href="{{ route('phim.show', $phim->id) }}">
                            <img src="{{ asset('images/' . ($phim->anh_bia ?? 'default.jpg')) }}" 
                                 alt="{{ $phim->ten_phim }}" 
                                 class="img-fluid rounded-3"
                                 style="height: 400px; object-fit: cover;">
                        </a>

                        {{-- Trailer --}}
                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-50 py-2">
                            <a href="{{ $phim->trailer }}" 
                               target="_blank" 
                               class="btn btn-outline-warning btn-sm fw-bold">
                               Xem Trailer
                            </a>
                        </div>

                    </div>

                    {{-- TÊN PHIM --}}
                    <h6 class="mt-3 fw-bold text-uppercase text-light text-truncate">
                        <a href="{{ route('phim.show', $phim->id) }}" 
                           class="text-warning text-decoration-none">
                            {{ $phim->ten_phim }}
                        </a>
                    </h6>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
@endsection
