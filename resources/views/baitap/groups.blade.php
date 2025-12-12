<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chọn Nhóm LAB</title>
</head>
<body>

<h2>Chọn Bộ Bài LAB</h2>

<ul>
    @foreach ($groups as $name => $url)
        <li>
            <a href="{{ $url }}">{{ $name }}</a>
        </li>
    @endforeach
</ul>

</body>
</html>
