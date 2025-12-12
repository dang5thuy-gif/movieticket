@extends('layout')

@section('content')

<div class="container mt-5">

    <div class="mx-auto rounded-4 shadow-lg p-4 p-md-5" 
         style="max-width: 800px; background: #525050;">

        <h2 class="text-center fw-bold mb-4 text-warning">
             Lịch sử đặt vé
        </h2>

        @if($history->isEmpty())
            <p class="text-center text-light fs-5">Bạn chưa đặt vé nào.</p>
        @else

            <div class="space-y-4">

                @foreach($history as $ve)
                    <div class="p-4 rounded-4 shadow bg-dark border border-secondary">

                        <!-- Tên phim -->
                        <h3 class="fw-bold text-light mb-3 fs-4">
                             {{ $ve->suatChieu->phim->ten_phim ?? 'Phim đã bị xoá' }}
                        </h3>

                        <!-- Ghế -->
                        <p>
                             <strong>Ghế:</strong>
                            @forelse($ve->gheDat as $ct)
                                {{ $ct->ghe->nhan_ghe }}@if(!$loop->last), @endif
                            @empty
                                Không có
                            @endforelse
                        </p>

                        <!-- Ngày chiếu -->
                        <p class="text-light mb-1">
                             <strong>Ngày chiếu:</strong> 
                            {{ \Carbon\Carbon::parse($ve->suatChieu->gio_bat_dau)->format('d/m/Y') }}
                        </p>

                        <!-- Suất chiếu -->
                        <p class="text-light mb-1">
                             <strong>Giờ chiếu:</strong> 
                            {{ \Carbon\Carbon::parse($ve->suatChieu->gio_bat_dau)->format('H:i') }}
                        </p>

                        <!-- Tổng tiền -->
                        <p class="text-light mb-1">
                             <strong>Tổng tiền:</strong>
                            {{ number_format($ve->tong_tien) }} VNĐ
                        </p>

                        <!-- Mã vé -->
                        <p class="text-light mb-3">
                             <strong>Mã vé:</strong> {{ $ve->id }}
                        </p>

                        <!-- Link xem phim -->
                        @if(isset($ve->suatChieu->phim->id))
                            <a href="{{ route('phim.show', $ve->suatChieu->phim->id) }}"
                               class="btn btn-primary btn-sm px-3">
                                Xem chi tiết phim
                            </a>
                        @endif

                    </div>
                @endforeach

            </div>

        @endif

    </div>

</div>

@endsection
