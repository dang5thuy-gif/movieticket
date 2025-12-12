@extends('layout')

@section('content')
<div class="container py-5">

    <h1 class="fw-bold text-warning text-center mb-4"> Chương trình khuyến mãi</h1>

    <div class="row g-4">

        @foreach($ds as $km)
        <div class="col-md-4">
            <div class="card bg-dark text-light border-warning shadow">

                <div class="card-body">
                    <h4 class="fw-bold text-warning">{{ $km->ma }}</h4>

                    <p class="mb-1">Giảm: <b>{{ $km->phan_tram_giam }}%</b></p>
                    <p class="mb-1">Bắt đầu: {{ date('d/m/Y', strtotime($km->ngay_bat_dau)) }}</p>
                    <p class="mb-2">Kết thúc: {{ date('d/m/Y', strtotime($km->ngay_ket_thuc)) }}</p>

                    @if($km->conHan())
                        <span class="badge bg-success">Còn hiệu lực</span>
                    @else
                        <span class="badge bg-secondary">Hết hạn</span>
                    @endif

                    <div class="mt-3 d-flex justify-content-between">
                        <a href="{{ route('khuyenmai.chitiet', $km->id) }}" class="btn btn-outline-warning btn-sm">
                            Xem chi tiết
                        </a>

                        @if($km->conHan())
                        <a href="{{ route('datve.chon-phim', ['ma_km' => $km->ma]) }}" 
                           class="btn btn-warning btn-sm">
                            Áp dụng →
                        </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach

    </div>

</div>
@endsection
