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
                <a class="nav-link" href="homeKywn">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orderlist">Order List</a>
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
        <div class="action-buttons mb-3">
            <button class="btn btn-sm btn-outline-secondary action-btn" id="view-button" disabled>
                <i class="fas fa-eye"></i> Lihat
            </button>
            <button class="btn btn-sm btn-outline-secondary action-btn" id="edit-button" disabled>
                <i class="fas fa-pen"></i> Edit
            </button>
            <button class="btn btn-sm btn-outline-danger action-btn" id="delete-button" disabled data-toggle="modal" data-target="#deleteModal">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>#</th>
                    <th>Tanaman</th>
                    <th>Penjualan</th>
                    <th>Stok</th>
                    <th>Ditambahkan</th>
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
                    <td>{{ $item->idTanaman }}</td>
                    <td><input type="checkbox" class="plant-checkbox" data-item-id="{{ $item->idTanaman }}"></td>
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
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        <!-- Formulir tersembunyi untuk menghapus tanaman -->
        <form id="delete-form" action="{{ route('deleteTanaman') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="ids" id="delete-ids">
        </form>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus tanaman yang dipilih?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const checkboxes = document.querySelectorAll('.plant-checkbox');
            const viewButton = document.getElementById('view-button');
            const editButton = document.getElementById('edit-button');
            const deleteButton = document.getElementById('delete-button');

            viewButton.addEventListener('click', function() {
                const selectedCheckbox = Array.from(checkboxes).find(cb => cb.checked);
                if (selectedCheckbox) {
                    const itemId = selectedCheckbox.getAttribute('data-item-id');
                    window.location.href = `/viewT/${itemId}`;
                }
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;

                    deleteButton.disabled = checkedCount === 0;
                    viewButton.disabled = !(checkedCount === 1);
                    editButton.disabled = !(checkedCount === 1);
                });
            });

            editButton.addEventListener('click', function() {
                const selectedCheckbox = Array.from(checkboxes).find(cb => cb.checked);
                if (selectedCheckbox) {
                    const itemId = selectedCheckbox.getAttribute('data-item-id');
                    window.location.href = `/editTanaman/${itemId}`;
                }
            });

            deleteButton.addEventListener('click', function() {
                const selectedIds = Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.getAttribute('data-item-id'));

                if (selectedIds.length > 0) {
                    // Set the selected IDs to the hidden input
                    document.getElementById('delete-ids').value = selectedIds.join(',');
                }
            });

            document.getElementById('confirm-delete').addEventListener('click', function() {
                document.getElementById('delete-form').submit();
            });
        </script>

        <!-- Include jQuery and Bootstrap JS for modal functionality -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>