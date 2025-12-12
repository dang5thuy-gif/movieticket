@extends('layout')

@section('title', 'Danh sách phim')

@section('content')

<div class="container py-4">

    <h2 class="mb-4 text-white fw-bold"> Danh sách phim</h2>

    {{-- Tabs lọc --}}
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'dang-chieu' ? 'active' : '' }}" 
               href="{{ route('phim.index', ['tab' => 'dang-chieu']) }}">Đang chiếu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'sap-chieu' ? 'active' : '' }}" 
               href="{{ route('phim.index', ['tab' => 'sap-chieu']) }}">Sắp chiếu</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $tab == 'tat-ca' ? 'active' : '' }}" 
               href="{{ route('phim.index', ['tab' => 'tat-ca']) }}">Tất cả</a>
        </li>
    </ul>

    <div class="row">
        @foreach ($phims as $phim)
            <div class="col-md-3 mb-4">
                @include('movie', ['phim' => $phim])
            </div>
        @endforeach
    </div>

</div>

@endsection
