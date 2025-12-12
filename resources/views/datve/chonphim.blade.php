@extends('layout')

@section('content')
<h3 class="mb-4">Chọn phim</h3>

<div class="row g-3">
  @foreach($phim as $p)
  <div class="col-md-4">
    <div class="card card-simple p-3 h-100">
      <h5 class="mb-1">{{ $p->ten_phim }}</h5>
      <p class="small text-muted mb-2">{{ \Illuminate\Support\Str::limit($p->mo_ta, 120) }}</p>
      <div class="d-flex justify-content-between align-items-center">
        <small class="text-muted">Ngày: {{ optional($p->ngay_cong_chieu)->format('d/m/Y') ?? '—' }}</small>
        <a href="{{ route('datve.chon-rap', $p->id) }}" class="btn btn-sm btn-primary">Chọn rạp</a>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
