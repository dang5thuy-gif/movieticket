@php
    $dropdownId = 'dropdown_' . uniqid();
@endphp

<div class="dropdown d-inline-block position-relative">

    <button class="ShadowButton dropdown-btn"
            onclick="toggleDropdown('{{ $dropdownId }}')">

        <i class="bi bi-geo-alt-fill me-2"></i>
        {{ $city }}
        <i class="bi bi-chevron-down ms-2 dropdown-arrow"
           id="{{ $dropdownId }}_arrow"></i>
    </button>

    <ul class="dropdown-menu-custom d-none"
        id="{{ $dropdownId }}"
        style="animation: fadeSlide .25s ease;">

        <li>
            <a class="dropdown-item city-item"
               href="?ngay={{ $ngay }}&city=Tất cả">
               
            </a>
        </li>

        @foreach ($cities as $c)
            <li>
                <a class="dropdown-item city-item"
                    href="?ngay={{ $ngay }}&city={{ $c->thanh_pho }}">
                    {{ $c->thanh_pho }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
