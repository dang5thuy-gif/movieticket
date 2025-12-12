@extends('layout')

@section('content')
<h3 class="mb-4">Rạp chiếu — {{ $phim->ten_phim }}</h3>

@if($raps->isEmpty())
  <div class="alert alert-warning">Chưa có rạp chiếu cho phim này.</div>
@else
  <div class="list-group">
    @foreach($raps as $rap)
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $rap->ten_rap }}</strong>
          <div class="small text-muted">{{ \Illuminate\Support\Str::limit($rap->dia_chi, 80) }}</div>
        </div>
        <a href="{{ route('datve.chon-suat', [$phim->id, $rap->id]) }}" class="btn btn-sm btn-outline-primary">Chọn suất</a>
      </div>
    @endforeach
  </div>
@endif
@endsection
