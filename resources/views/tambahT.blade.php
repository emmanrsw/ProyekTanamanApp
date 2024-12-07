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
            margin-bottom: 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 900;
            color: #000;
        }

        .navbar-brand .highlight {
            color: #4B553D;
        }

        .navbar-icons {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .layout {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 220px;
            background-color: #f8f9fa;
            height: 100vh;
            padding-top: 0px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            box-shadow: 1px 3px 10px 1px #000000;
        }

        .btn-black {
            background-color: blueviolet;
            color: white;
        }

        .btn-black:hover {
            background-color: #333;
        }

        .nav-link.active {
            background-color: #333;
            color: white;
        }

        .nav-link:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="layout">
        <div class="sidebar">
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
                    <input type="text" class="form-control" id="namaTanaman" name="namaTanaman"
                        placeholder="namaTanaman" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" class="form-control" id="jmlTanaman" name="jmlTanaman"
                        placeholder="jmlTanaman" required>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="hargaTanaman" name="hargaTanaman"
                        placeholder="hargaTanaman" required>
                </div>
                <div class="form-group">
                    <label for="image">Galeri Produk</label>
                    <div class="img-placeholder" onclick="document.getElementById('gambar').click();">
                        <i class="fas fa-image"></i> Drop your image here, or browse <br> Jpeg, png are allowed
                    </div>
                    <input type="file" class="form-control-file" id="gambar" name="gambar" style="display:none;"
                        accept="image/*" required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-black">Tambahkan</button>
                    <a href="{{ route('batalTambah') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>

        <script>
            document.getElementById('gambar').addEventListener('change', function() {
                const file = this.files[0];
                const imgPlaceholder = document.querySelector('.img-placeholder');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imgPlaceholder.innerHTML =
                            `<img src="${e.target.result}" alt="Preview Gambar" style="width: 20%; height: auto;"/>`;
                    };
                    reader.readAsDataURL(file);
                }
            });
            document.querySelector('form').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form terkirim langsung

                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    // Jika user klik 'Save'
                    if (result.isConfirmed) {
                        Swal.fire("Saved!", "", "success").then(() => {
                            // Setelah konfirmasi, kirim form
                            document.querySelector('form').submit(); // Kirim form setelah Swal menutup
                        });
                    }
                    // Jika user klik 'Don't save'
                    else if (result.isDenied) {
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
