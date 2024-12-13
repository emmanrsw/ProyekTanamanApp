<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tanaman - Tanam.in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn-warning {
            margin-top: 20px;
        }

        .back-btn {
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
        }

        .back-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0" style="font-weight: bold; font-size: 35px; color: #243a56">Daftar Tanaman</h1>

        <a href="{{ route('homeKywn') }}" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Kembali
        </a>
    </div>



    <div class="container">
        <h1>Nama Tanaman: {{ $tanaman->namaTanaman }}</h1>
        <h1>Id Tanaman: {{ $tanaman->idTanaman }}</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Stok Awal</th>
                    <th>Tanggal</th>
                    <th>Terjual</th>
                    <th>Stok Masuk</th>
                    <th>Stok Saat Ini</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stokLogs as $log)
                <tr>
                    <td>{{ $log->jumlah_sebelumnya }}</td>
                    <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d-M') }}</td>
                    <td>{{ $log->jumlah_terjual }}</td>
                    <td>{{ $log->jumlah_masuk }}</td>
                    <td>{{ $log->jumlah_baru }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('editTanaman', ['id' => $tanaman->idTanaman]) }}" class="btn btn-warning">Edit Tanaman</a>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>