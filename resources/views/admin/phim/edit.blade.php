@extends('layout')

@section('content')

<div class="container py-4">

    {{-- TIÊU ĐỀ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-warning"> Chỉnh Sửa Phim</h2>

        <a href="{{ route('admin.phim.index') }}" class="btn btn-secondary fw-bold px-4 shadow">
            ⬅ Quay lại
        </a>
    </div>

    {{-- CARD FORM --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden"
         style="background: #f0f0f0; color:#222;"> 

        {{-- HEADER --}}
        <div class="card-header py-3 border-0"
             style="background: linear-gradient(90deg, #8b33ff, #c08bff); color:white;">
            <h5 class="mb-0 fw-bold">Thông Tin Chi Tiết Phim</h5>
        </div>

        {{-- BODY --}}
        <div class="card-body p-4">

            <form action="{{ route('admin.phim.update', $phim->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- TÊN PHIM --}}
                <label class="fw-semibold mt-2">Tên phim</label>
                <input type="text" name="ten_phim"
                       class="form-control border-secondary bg-white mb-3"
                       value="{{ $phim->ten_phim }}" required>

                {{-- MÔ TẢ --}}
                <label class="fw-semibold">Mô tả</label>
                <textarea name="mo_ta" rows="3"
                          class="form-control border-secondary bg-white mb-3">{{ $phim->mo_ta }}</textarea>

                {{-- NỘI DUNG --}}
                <label class="fw-semibold">Nội dung phim</label>
                <textarea name="noi_dung_phim" rows="5"
                          class="form-control border-secondary bg-white mb-3">{{ $phim->noi_dung_phim }}</textarea>

                {{-- THỜI LƯỢNG --}}
                <label class="fw-semibold">Thời lượng (phút)</label>
                <input type="number" name="thoi_luong"
                       class="form-control border-secondary bg-white mb-3"
                       value="{{ $phim->thoi_luong }}">

                {{-- ĐÁNH GIÁ --}}
                <label class="fw-semibold">Đánh giá</label>
                <input type="text" name="danh_gia"
                       class="form-control border-secondary bg-white mb-3"
                       value="{{ $phim->danh_gia }}">

                {{-- NGÔN NGỮ --}}
                <label class="fw-semibold">Ngôn ngữ</label>
                <input type="text" name="ngon_ngu"
                       class="form-control border-secondary bg-white mb-3"
                       value="{{ $phim->ngon_ngu }}">

                {{-- THỂ LOẠI --}}
                <label class="fw-semibold">Thể loại</label>
                <input type="text" name="the_loai"
                       class="form-control border-secondary bg-white mb-3"
                       value="{{ $phim->the_loai }}">

                {{-- NGÀY CÔNG CHIẾU --}}
                <label class="fw-semibold">Ngày công chiếu</label>
                <input type="date" name="ngay_cong_chieu"
                       class="form-control border-secondary bg-white mb-4"
                       value="{{ $phim->ngay_cong_chieu->format('Y-m-d') }}">

                {{-- ẢNH HIỆN TẠI --}}
                <label class="fw-semibold">Ảnh hiện tại</label>
                <div class="mb-3">
                    <img src="{{ asset('images/' . $phim->anh_bia) }}"
                         width="140" height="180"
                         class="rounded shadow border border-secondary"
                         style="object-fit: cover;">
                </div>

                {{-- ẢNH MỚI --}}
                <label class="fw-semibold">Ảnh bìa mới (tuỳ chọn)</label>
                <input type="file" name="anh_bia"
                       class="form-control border-secondary bg-white mb-3">

                {{-- TRAILER --}}
                <label class="fw-semibold">Trailer</label>
                <input type="text" name="trailer"
                       class="form-control border-secondary bg-white mb-4"
                       value="{{ $phim->trailer }}">

                {{-- BUTTON --}}
                <div class="text-end">
                    <a href="{{ route('admin.phim.index') }}"
                       class="btn btn-secondary px-4 me-2 fw-bold">Hủy</a>

                    <button class="btn btn-success px-4 fw-bold"> Lưu thay đổi</button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection
