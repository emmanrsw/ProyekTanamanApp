<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tanaman - Tanam.in</title>
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
        .form-group img-placeholder {
            border: 2px dashed #ced4da;
            padding: 40px;
            text-align: center;
            color: #6c757d;
            cursor: pointer;
        }
        .btn-black {
            background-color: black;
            color: white;
        }
        .btn-black:hover {
            background-color: #333;
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
        <h1 class="mb-4">Tambah Tanaman</h1>
        <form method="POST" action="{{ route('simpanTanaman') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="namaTanaman" name="namaTanaman" placeholder="namaTanaman" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" class="form-control" id="jmlTanaman" name="jmlTanaman" placeholder="jmlTanaman" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="hargaTanaman" name="hargaTanaman" placeholder="hargaTanaman" required>
            </div>
            <div class="form-group">
                <label for="image">Galeri Produk</label>
                <div class="img-placeholder" onclick="document.getElementById('gambar').click();">
                    <i class="fas fa-image"></i> Drop your image here, or browse <br> Jpeg, png are allowed
                </div>
                <input type="file" class="form-control-file" id="gambar" name="gambar" style="display:none;" accept="image/*" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-black">Tambahkan</button>
                <a href="{{ route('batalTambah') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Menambahkan event listener untuk mengganti placeholder gambar saat file dipilih
        document.getElementById('gambar').addEventListener('change', function() {
            const imgPlaceholder = document.querySelector('.img-placeholder');
            const file = this.files[0];
            if (file) {
                imgPlaceholder.innerHTML = `<strong>${file.name}</strong>`;
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
