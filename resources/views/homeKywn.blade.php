<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - Tanam.in</title>
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
        .add-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h4 class="text-center">Tanam.in</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Order List</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Daftar Tanaman</h1>

            <!-- Tombol untuk menambah tanaman -->
            <a href="{{ route('tambahTanaman') }}" class="btn btn-primary add-btn">
                <i class="fas fa-plus"></i> Add Tanaman
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanaman</th>
                    <th>Penjualan</th>
                    <th>Stok</th>
                    <th>Ditambahkan</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @if($plants->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center">Belum ada tanaman yang ditambahkan.</td>
                    </tr>
                @else
                    @foreach($plants as $item)
                        <tr>
                            <td><input type="checkbox" disabled></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('images/'.$item->gambar) }}" alt="{{ $item->namaTanaman }}" class="img-thumbnail" width="40">
                                    <div class="ml-3">
                                        <strong>{{ $item->namaTanaman }}</strong>
                                        <p class="text-muted">{{ $item->deskripsi }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ number_format($item->penjualan, 0, ',', '.') }}</td>
                            <td>{{ number_format($item->jmlTanaman, 0, ',', '.') }}</td>
                            <td>
                                @if($item->added_date)
                                    {{ $item->added_date->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary" disabled>
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary" disabled>
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
