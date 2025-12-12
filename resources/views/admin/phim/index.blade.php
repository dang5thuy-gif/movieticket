@extends('layout')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-warning">Quản Lý Phim</h2>

        <a href="{{ route('admin.phim.create') }}" class="btn btn-success fw-bold px-4 shadow">
             Thêm Phim
        </a>
    </div>

    {{-- CARD BỌC BẢNG --}}
    <div class="card bg-secondary text-light shadow-lg border border-light rounded-4 overflow-hidden">

        {{-- HEADER --}}
        <div class="card-header py-3 border-0 text-light fw-bold"
             style="background: linear-gradient(90deg, #7b2cbf, #b984f7);">
            Danh sách phim
        </div>

        <div class="table-responsive bg-light">
            <table class="table table-hover mb-0 table-bordered">

                <thead class="text-dark fw-bold" style="background:#e5d9fa;">
                    <tr>
                        <th width="60">ID</th>
                        <th width="240">Tên phim</th>
                        <th width="140">Thể loại</th>
                        <th width="120">Ngôn ngữ</th>
                        <th width="140">Ngày chiếu</th>
                        <th width="130">Ảnh bìa</th>
                        <th width="150" class="text-center">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($phims as $phim)
                        <tr class="bg-white">

                            <td class="fw-bold">{{ $phim->id }}</td>

                            <td class="fw-semibold">{{ $phim->ten_phim }}</td>

                            <td>
                                <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill">
                                    {{ $phim->the_loai }}
                                </span>
                            </td>

                            <td>{{ $phim->ngon_ngu }}</td>

                            <td>{{ $phim->ngay_cong_chieu ? \Carbon\Carbon::parse($phim->ngay_cong_chieu)->format('d/m/Y') : '---' }}</td>

                            <td>
                                <img src="{{ asset('images/' . $phim->anh_bia) }}"
                                     width="75" height="90"
                                     class="rounded shadow-sm border border-secondary"
                                     style="object-fit:cover;">
                            </td>

                            <td class="text-center">

                                {{-- NÚT SỬA --}}
                                <a href="{{ route('admin.phim.edit', $phim->id) }}"
                                   class="btn btn-warning btn-sm me-1 px-3 fw-bold">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- NÚT XÓA --}}
                                <button class="btn btn-danger btn-sm btnDelete px-3 fw-bold"
                                        data-id="{{ $phim->id }}"
                                        data-name="{{ $phim->ten_phim }}">
                                    <i class="bi bi-trash"></i>
                                </button>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-secondary bg-white">
                                Chưa có phim nào.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/adminphimdelete.js') }}"></script>
@endsection
