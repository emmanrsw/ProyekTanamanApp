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
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            height: 100vh;
            padding-top: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .nav-link.active {
            background-color: #007bff;
            color: white;
        }

        .nav-link:hover {
            background-color: #e9ecef;
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
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Tanam.in</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('homeKywn') }}">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('orderlist') }}">Order List</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Daftar Transaksi</h1>
        </div>

        <!-- Tabel Daftar Transaksi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>ID Pelanggan</th>
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
                    <td>{{ $order->idCust }}</td>
                    <td>{{ $order->tglTJual }}</td>
                    <td>{{ $order->waktuTJual }}</td>
                    <td>{{ $order->metodeByr }}</td>
                    <td>{{ $order->alamat_kirim }}</td>
                    <td>
                        <ul>
                            @foreach($order->details as $detail)
                            <li>
                                {{ $detail->nama_tanaman }} - {{ $detail->jumlah }} x
                                {{ number_format($detail->harga_satuan, 0, ',', '.') }} IDR
                                (Total: {{ number_format($detail->total_harga, 0, ',', '.') }} IDR)
                            </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ number_format($order->total_harga, 0, ',', '.') }} IDR</td>
                    <td>
                        <span class="order-status @if($order->statusTJual == 'Sedang Dikemas') pending @elseif($order->statusTJual == 'Dikirim') completed @else cancelled @endif">
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
                                <option value="Dikirim" {{ $order->statusTJual == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Selesai" {{ $order->statusTJual == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
