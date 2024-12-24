<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tanaman - Tanam.in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            background-color: white;
            padding: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 900;
            color: #000;
        }

        .navbar-brand .highlight {
            color: #4B553D;
        }

        .layout {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background: #4B553D;
            padding-top: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .form-group .img-placeholder {
            border: 2px dashed #ced4da;
            padding: 20px;
            text-align: center;
            color: #6c757d;
            cursor: pointer;
            box-shadow: 1px 3px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-black {
            background-color: blueviolet;
            color: white;
        }

        .btn-black:hover {
            background-color: #4B553D;
        }

        .nav-link {
            color: white;
            font-size: 16px;
            padding: 10px 15px;
        }

        .nav-link:hover {
            background-color: #B1D690;
            color: black;
        }

        .nav-link.active {
            background-color: #B1D690;
            color: black;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .img-preview img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="layout">
        <div class="sidebar">
            <div class="navbar navbar-light bg-custom text-center">
                <a class="navbar-brand">
                    Tanam<span class="highlight">.in</span>
                </a>
            </div>
            <ul>
                <li><a class="nav-link active" href="homeKywn">All Products</a></li>
                <li><a class="nav-link" href="orderlist">Order List</a></li>
            </ul>
        </div>

        <div class="main-content container">
            <h1 class="mb-4">Tambah Tanaman</h1>
            <form method="POST" action="{{ route('simpanTanaman') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="namaTanaman">Nama Produk</label>
                    <input type="text" class="form-control" id="namaTanaman" name="namaTanaman" placeholder="Nama Tanaman" required>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi Tanaman" required></textarea>
                </div>
                <div class="form-group">
                    <label for="jmlTanaman">Stok</label>
                    <input type="number" class="form-control" id="jmlTanaman" name="jmlTanaman" placeholder="Jumlah Stok" required>
                </div>
                <div class="form-group">
                    <label for="hargaTanaman">Harga</label>
                    <input type="number" class="form-control" id="hargaTanaman" name="hargaTanaman" placeholder="Harga" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Galeri Produk</label>
                    <div class="img-placeholder" onclick="document.getElementById('gambar').click();">
                        <i class="fas fa-image"></i> Drop your image here, or browse <br> Jpeg, png are allowed
                    </div>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" style="display:none;" accept="image/*" required>
                    <div class="img-preview mt-3"></div>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-black">Tambahkan</button>
                    <a href="{{ route('batalTambah') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('gambar').addEventListener('change', function () {
            const file = this.files[0];
            const preview = document.querySelector('.img-preview');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview Gambar"/>`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
