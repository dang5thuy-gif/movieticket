<!DOCTYPE html>
<html>
<head>
    <title>Bài tập {{ $lab }}</title>
</head>
<body>

<h1>Bài tập trong thư mục: {{ $lab }}</h1>

<ul>
    @foreach($files as $file)
        <li><a href="/baitap/{{ $lab }}/{{ $file }}">{{ $file }}</a></li>
    @endforeach
</ul>

<br>
<a href="/baitap">⬅ Quay lại danh sách</a>

</body>
</html>
