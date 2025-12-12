<div class="movie-card bg-dark text-white rounded shadow overflow-hidden">

    <a href="{{ route('phim.show', $phim->id) }}">
        <img src="{{ asset('images/' . ($phim->anh_bia ?? 'default.jpg')) }}" 
             class="w-100" style="height: 350px; object-fit: cover">
    </a>

    <div class="p-3">

        <h5 class="fw-bold mb-1 text-warning">{{ $phim->ten_phim }}</h5>

        <small class="text-secondary">
             {{ $phim->danh_gia ?? 'Chưa có đánh giá' }}
        </small>

        <p class="mt-2 mb-3" style="font-size: 14px;">
            {{ Str::limit($phim->mo_ta, 60) }}
        </p>

        <a href="{{ route('phim.show', $phim->id) }}" 
           class="btn btn-warning w-100 fw-bold">
           Xem chi tiết
        </a>
    </div>

</div>

<style>
.movie-card:hover img {
    transform: scale(1.05);
    transition: 0.3s;
}
</style>
