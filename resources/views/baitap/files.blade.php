<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Danh Sách File</title>
</head>
<body>

<h2>Index of /{{ $group }}/{{ $lab }}</h2>

<ul>
    <li><a href="{{ url("baitap/group/$group") }}">← Quay lại danh sách LAB</a></li>

    @foreach ($files as $file)
        <li>
            <a href="{{ url("$group/$lab/$file") }}">
                {{ $file }}
            </a>
        </li>
    @endforeach
</ul>

</body>
</html>
