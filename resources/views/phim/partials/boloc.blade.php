<div class="container text-center mt-4 mb-5">

    {{-- TIÊU ĐỀ --}}
    <h2 class="fw-bold text-warning mb-4">LỊCH CHIẾU</h2>

    {{-- KIỂM TRA nếu không có ngày chiếu --}}
    @if ($dsNgay->count() == 0)
        <div class="p-4 rounded-4 mx-auto"
             style="max-width:450px; background:rgba(255,255,255,0.08);
                    border:2px dashed #ffdd33; color:#ffdd33;">
            <h4 class="fw-bold mb-2">HIỆN TẠI CHƯA CÓ LỊCH CHIẾU</h4>
            <p class="mb-0" style="font-size:15px; opacity:0.85;">
                Phim sẽ được cập nhật lịch chiếu ngay khi nhà rạp công bố.
            </p>
        </div>
    @else

        {{-- DANH SÁCH NGÀY CHIẾU --}}
        <div class="d-flex justify-content-center gap-3 mb-4">
            @foreach ($dsNgay as $n)

                @php $active = $ngay == $n->ngay; @endphp

                <a href="?ngay={{ $n->ngay }}&city={{ $city }}"
                   class="text-center p-3 rounded-3 fw-bold"
                   style="
                        width:120px;
                        border:2px solid #ffdd33;
                        color:{{ $active ? '#4b0082' : '#ffdd33' }};
                        background:{{ $active ? '#ffdd33' : 'transparent' }};
                        text-decoration:none;
                   ">
                    <div style="font-size:22px; line-height:1;">
                        {{ \Carbon\Carbon::parse($n->ngay)->format('d/m') }}
                    </div>
                    <div style="font-size:13px; line-height:1.2;">
                        {{ \Carbon\Carbon::parse($n->ngay)->translatedFormat('l') }}
                    </div>
                </a>

            @endforeach
        </div>

    @endif

</div>
