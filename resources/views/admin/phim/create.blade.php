@extends('layout')

@section('content')

<div class="container py-4">

    {{-- TIÊU ĐỀ --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-warning">Thêm Phim Mới</h2>

        <a href="{{ route('admin.phim.index') }}" class="btn btn-secondary fw-bold px-4 shadow">
             Quay lại
        </a>
    </div>

    {{-- FORM --}}
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" 
         style="background: #f0f0f0; color:#222;"> 

        <div class="card-header py-3 border-0"
             style="background: linear-gradient(90deg, #8b33ff, #c08bff); color:white;">
            <h5 class="mb-0 fw-bold">Nhập thông tin phim</h5>
        </div>

        <div class="card-body p-4">

            <form action="{{ route('admin.phim.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    {{-- TÊN PHIM --}}
                    <div class="col-md-6 mb-3">
                        <label class="fw-semibold">Tên phim</label>
                        <input type="text" name="ten_phim" class="form-control border-secondary bg-white" required>
                    </div>

                    {{-- THỜI LƯỢNG --}}
                    <div class="col-md-3 mb-3">
                        <label class="fw-semibold">Thời lượng (phút)</label>
                        <input type="number" name="thoi_luong" class="form-control border-secondary bg-white" required>
                    </div>

                    {{-- ĐÁNH GIÁ --}}
                    <div class="col-md-3 mb-3">
                        <label class="fw-semibold">Đánh giá</label>
                        <input type="text" name="danh_gia" class="form-control border-secondary bg-white">
                    </div>

                    {{-- NGÔN NGỮ --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Ngôn ngữ</label>
                        <input type="text" name="ngon_ngu" class="form-control border-secondary bg-white" required>
                    </div>

                    {{-- THỂ LOẠI --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Thể loại</label>
                        <input type="text" name="the_loai" class="form-control border-secondary bg-white">
                    </div>

                    {{-- NGÀY CÔNG CHIẾU --}}
                    <div class="col-md-4 mb-3">
                        <label class="fw-semibold">Ngày công chiếu</label>
                        <input type="date" name="ngay_cong_chieu" class="form-control border-secondary bg-white" required>
                    </div>

                </div>

                {{-- MÔ TẢ --}}
                <div class="mb-3">
                    <label class="fw-semibold">Mô tả phim</label>
                    <textarea name="mo_ta" rows="3" class="form-control border-secondary bg-white"></textarea>
                </div>

                {{-- NỘI DUNG --}}
                <div class="mb-3">
                    <label class="fw-semibold">Nội dung phim</label>
                    <textarea name="noi_dung_phim" rows="6" class="form-control border-secondary bg-white"></textarea>
                </div>

                {{-- ẢNH --}}
                <div class="mb-3">
                    <label class="fw-semibold">Ảnh bìa</label>
                    <input type="file" name="anh_bia" accept="image/*"
                           class="form-control border-secondary bg-white" required>
                </div>

                {{-- TRAILER --}}
                <div class="mb-3">
                    <label class="fw-semibold">Link Trailer</label>
                    <input type="text" name="trailer" class="form-control border-secondary bg-white">
                </div>

                {{-- BUTTON --}}
                <button class="btn btn-success fw-bold px-4 mt-2">Lưu phim</button>

            </form>

        </div>

    </div>

</div>

@endsection
