<!DOCTYPE html>
<html>
<head>
    <title>Data Kehadiran</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Kehadiran</h1>
    <table>
        <thead>
            <tr>
                <th>Nama User</th>
                <th>QR Code</th>
                <th>Tanggal Kehadiran</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
                <tr>
                    <td>{{ $record->user->name }}</td>
                    <td>{{ $record->qrCode->code }}</td>
                    <td>{{ $record->qrCode->valid_date }}</td>
                    <td>{{ $record->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
