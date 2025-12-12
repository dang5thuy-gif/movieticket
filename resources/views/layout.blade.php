<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đặt Vé Xem Phim Trực Tuyến</title>

    <!-- CSS BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- CSS DROPDOWN -->
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">

    <!-- SWEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-dark text-light">

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-black shadow-sm">
        <div class="container">

            <a class="navbar-brand fw-bold fs-4" href="/"> CINEMA ONLINE </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            @php
                $user = session('nguoi_dung');
                $admin = session('admin');
            @endphp

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('/') ? 'text-warning' : '' }}" href="/">
                            Trang Chủ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->routeIs('phim.*') ? 'text-warning' : '' }}"
                           href="{{ route('phim.index') }}">
                           Phim
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#">
                            Lịch Chiếu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->routeIs('khuyenmai.*') ? 'text-warning' : '' }}"
                           href="{{ route('khuyenmai.indexkhuyenmai') }}">
                           Khuyến Mãi
                        </a>
                    </li>

                   <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->is('baitap*') ? 'text-warning' : '' }}"
                        href="{{ url('/baitap') }}">
                        Bài Tập
                        </a>
                    </li>


                    {{-- ADMIN --}}
                    @if($admin)
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-warning">
                                Admin: {{ is_array($admin) ? $admin['ho_ten'] : $admin->ho_ten }}
                            </a>
                        </li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.phim.index') }}">Quản Lý Phim</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.logout') }}">Đăng Xuất</a></li>

                    {{-- USER --}}
                    @elseif($user)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold text-warning" href="#" id="userMenu"
                               role="button" data-bs-toggle="dropdown">
                                {{ $user->ho_ten }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark shadow rounded-3">
                                <li><a class="dropdown-item text-light" href="{{ route('nguoidung.profile') }}"><i class="bi bi-person-circle me-2"></i>Thông tin người dùng</a></li>

                                <li><a class="dropdown-item text-light" href="{{ route('nguoidung.history') }}"><i class="bi bi-ticket-detailed me-2"></i>Lịch sử đặt vé</a></li>

                                <li><hr class="dropdown-divider border-secondary"></li>

                                <li><a class="dropdown-item text-danger fw-bold" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                            </ul>
                        </li>

                    {{-- GUEST --}}
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'text-warning fw-bold' : '' }}"
                               href="{{ route('login') }}">
                                Đăng Nhập
                            </a>
                        </li>

                        <li class="nav-item ms-2">
                            <a href="{{ route('admin.login') }}"
                               class="btn fw-bold {{ request()->routeIs('admin.login') ? 'btn-warning text-black' : 'btn-danger' }}">
                               Admin
                            </a>
                        </li>
                    @endif

                </ul>
            </div>

        </div>
    </nav>

    {{-- CAROUSEL ĐƯỢC ĐƯA TRỰC TIẾP VÀO LAYOUT --}}
    <div class="container my-4"> 
    <div id="mainPosterCarousel" class="carousel slide shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#mainPosterCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#mainPosterCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#mainPosterCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/main_poster_1.jpg" class="d-block w-100" alt="Poster Phim Mới 1" style="height: 550px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                    <h5> Bom Tấn Tháng Này: Tựa Phim Hấp Dẫn</h5>
                    <p>Đặt vé ngay để nhận ưu đãi đặc biệt và trải nghiệm điện ảnh đỉnh cao!</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="/images/main_poster_2.jpg" class="d-block w-100" alt="Poster Phim Mới 2" style="height: 550px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                    <h5> Sắp Chiếu: Đừng Bỏ Lỡ</h5>
                    <p>Khám phá trailer và lịch chiếu mới nhất!</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="/images/main_poster_3.jpg" class="d-block w-100" alt="Poster Phim Mới 3" style="height: 550px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 p-3 rounded-3">
                    <h5> Khuyến Mãi Hàng Tuần</h5>
                    <p>Giảm giá vé cho nhóm và học sinh, sinh viên!</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#mainPosterCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainPosterCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

    {{-- PAGE CONTENT --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    @include('footer')

    <!-- JS BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS DROPDOWN -->
    <script src="{{ asset('js/dropdown.js') }}"></script>

    {{-- SCRIPT CỦA TỪNG TRANG --}}
    @yield('scripts')

</body>
</html>
