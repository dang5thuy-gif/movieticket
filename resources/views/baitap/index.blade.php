<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách LAB – {{ $group }}</title>
</head>
<body>

<h2>Danh sách LAB trong {{ $group }}</h2>

<ul>
    <li><a href="{{ url('/baitap') }}">← Quay lại chọn nhóm</a></li>

    @foreach ($labs as $lab)
        <li>
            <a href="{{ url("baitap/group/$group/$lab") }}">{{ $lab }}/</a>
        </li>
    @endforeach
</ul>

</body>
</html>
