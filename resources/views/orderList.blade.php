<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List - Tanam.in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            display: flex;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 150px;
            height: 200vh;
            background: #4B553D;
            padding-top: 20px;
        }

        .bg-custom {
            background-color: #f5f7f0;
        }

        .navbar {
            text-align: center;
            height: 50px;
            font-weight: bold;
        }

        .navbar-brand {
            text-align: center;
            font-size: 25px;
        }

        .highlight {
            color: #4B553D;
            /* Contoh warna hijau, sesuaikan sesuai kebutuhan */
            font-weight: bold;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }


        .d-flex.justify-content-center {
            justify-content: center;
            /* Rata tengah horizontal */
        }

        .nav-link.active {
            background-color: #B1D690;
            color: black;
        }

        .nav-link:hover {
            background-color: #f5f7f0;
        }

        .nav-link {
            color: white;
            font-size: 20px;
            font-weight: 5px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        td form {
            display: inline-block;
        }

        select {
            padding: 5px;
        }

        .action-btn {
            margin-bottom: 20px;
        }

        .order-status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .order-status.completed {
            color: green;
        }

        .order-status.pending {
            color: orange;
        }

        .order-status.cancelled {
            color: red;
        }

        .table thead th,
        .table tbody td {
            text-align: center;
            /* Teks di tengah */
            vertical-align: middle;
            /* Vertikal di tengah */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <nav class="navbar navbar-expand-lg navbar-light bg-custom justify-content-center">
            <a class="navbar-brand">
                <span class="text-background">Tanam</span><span class="highlight">.in</span>
            </a>
        </nav>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homeKywn') }}">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('orderlist') }}">Order List</a>
            </li>
        </ul>
    </div>

    <div class="main-content" style="font-family: 'Poppins', sans-serif;">
        <div class="d-flex justify-content-center mb-4">
            <h1 class="mb-0" style="font-weight: bold; font-size: 35px; color: #243a56;">Daftar Transaksi</h1>
        </div>


        <!-- Tabel Daftar Transaksi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Metode Pembayaran</th>
                    <th>Alamat Pengiriman</th>
                    <th>Detail Barang</th>
                    <th>Total Harga</th>
                    <th>Status Saat Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->idTJual }}</td>
                    <td>{{ $order->pelanggan->namaCust }}</td>
                    <td>{{ $order->tglTJual }}</td>
                    <td>{{ $order->waktuTJual }}</td>
                    <td>{{ $order->metodeByr }}</td>
                    <td>{{ $order->pelanggan->alamatCust }}</td>
                    <td>
                        <ul>
                            @foreach($order->details as $detail)
                            <li>
                                {{ $detail->tanaman->namaTanaman }} - {{ $detail->jumlah }} x
                                {{ number_format($detail->harga_satuan, 0, ',', '.') }} IDR
                                (Total: {{ number_format($detail->harga_satuan * $detail->jumlah, 0, ',', '.') }} IDR)
                                z
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($order->harga_total, 0, ',', '.') }} IDR</td>
                    <td>
                        <span
                            class="order-status @if($order->statusTJual == 'Dikirim') pending @elseif($order->statusTJual == '') completed @else cancelled @endif">
                            {{ $order->statusTJual }}
                        </span>
                    </td>
                    <td>
                        <!-- Form untuk mengubah status transaksi -->
                        <form action="{{ route('updateStatus', $order->idTJual) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="statusTJual" onchange="this.form.submit()">
                                <option value="Sedang Dikemas" {{ $order->statusTJual == 'Sedang Dikemas' ? 'selected' : '' }}>Sedang Dikemas</option>
                                <option value="Dikirim" {{ $order->statusTJual == 'Dikirim' ? 'selected' : '' }}>Dikirim
                                </option>
                                <option value="Selesai" {{ $order->statusTJual == 'Selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include jQuery and Bootstrap JS for modal functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>