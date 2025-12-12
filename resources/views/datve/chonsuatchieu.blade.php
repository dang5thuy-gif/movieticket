@extends('layout')

@section('content')
<h3 class="mb-4">Suất chiếu — {{ $phim->ten_phim }} / {{ $rap->ten_rap }}</h3>

@if($suatChieu->isEmpty())
  <div class="alert alert-warning">Chưa có suất chiếu.</div>
@else
  <div class="row">
    @foreach($suatChieu as $s)
      <div class="col-md-4">
        <div class="card card-simple p-3 mb-3">
          <div class="d-flex justify-content-between">
            <div>
              <h6 class="mb-1">{{ $s->gio_bat_dau->format('H:i d/m/Y') }}</h6>
              <small class="text-muted">Phòng: {{ $s->phong->ten_phong ?? '—' }}</small>
            </div>
            <div class="align-self-center">
             <a href="{{ route('datve.chon-ghe', ['suatId' => $s->id]) }}" class="btn btn-sm btn-primary"> Chọn ghế </a>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif
@endsection
