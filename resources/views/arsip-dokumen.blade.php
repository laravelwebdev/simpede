<!DOCTYPE html>
<html>
<head>
    <title>Arsip Dokumen</title>
</head>
<body>
    <h1>Arsip Dokumen Tahun {{ $tahun }}</h1>
    
       <table border="1">
        <thead>
            <tr>
                <th>KRO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->KRO }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>