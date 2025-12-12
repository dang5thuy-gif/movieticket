<footer class="bg-black text-light pt-5 pb-3 mt-5">
    <div class="container">

        <div class="row">

            <!-- Logo + mô tả -->
            <div class="col-md-3 mb-4">
                <h4 class="fw-bold"> CINEMA ONLINE</h4>
                <p class="text-secondary">
                    Đặt vé xem phim trực tuyến — nhanh chóng, tiện lợi và bảo mật.
                    Cập nhật phim mới mỗi ngày, trải nghiệm chuẩn rạp chiếu hiện đại.
                </p>
            </div>


            <!-- Liên kết nhanh -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Liên kết nhanh</h5>
                <ul class="list-unstyled">

                    <li>
                        <a href="{{ route('home') }}" class="text-secondary text-decoration-none">
                            Trang chủ
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('phim.index', ['tab' => 'dang-chieu']) }}" 
                        class="text-secondary text-decoration-none">
                            Phim đang chiếu
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('phim.index', ['tab' => 'sap-chieu']) }}" 
                        class="text-secondary text-decoration-none">
                            Phim sắp chiếu
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('khuyenmai.indexkhuyenmai') }}" 
                        class="text-secondary text-decoration-none">
                            Khuyến mãi
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('phim.index') }}" 
                        class="text-secondary text-decoration-none">
                            Lịch chiếu
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Danh sách rạp -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Hệ thống rạp</h5>
                <ul class="list-unstyled">
                    <li class="text-secondary mb-1"> CGV Nguyễn Trãi – HCM</li>
                    <li class="text-secondary mb-1"> CGV Vincom – Hà Nội</li>
                    <li class="text-secondary mb-1"> Lotte Cinema Gò Vấp – HCM</li>
                    <li class="text-secondary mb-1"> Galaxy Tân Bình – HCM</li>
                    <li class="text-secondary mb-1"> Beta Thanh Xuân – Hà Nội</li>
                    <li class="text-secondary mb-1"> Cinestar Quốc Thanh – HCM</li>
                </ul>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Liên hệ</h5>
                <p class="text-secondary mb-1"> 123 Cinema Street, TP.HCM</p>
                <p class="text-secondary mb-1"> 0123 456 789</p>
                <p class="text-secondary mb-3"> support@cinema.com</p>

                <div class="d-flex gap-3 fs-4">
                    <a href="#" class="text-secondary"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-youtube"></i></a>
                </div>
            </div>

        </div>

        <hr class="border-secondary">
        <div class="text-center text-secondary mt-3">
            <h5 class="fw-bold text-light mb-2">Sinh viên thực hiện đồ án</h5>

            <p class="mb-1">
                <span class="fw-bold text-light">1. Nguyễn Thị Thanh Tuyền </span> — MSSV: DH52201742 — Lớp: D22-TH04
            </p>

            <p class="mb-0">
                <span class="fw-bold text-light">2. Đặng Thị Thùy </span> — MSSV: DH52201546 — Lớp: D22-TH12
            </p>
        </div>

        <hr class="border-secondary">

        <div class="text-center text-secondary">
            © 2025 Cinema Online — All Rights Reserved
        </div>

    </div>
</footer>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
