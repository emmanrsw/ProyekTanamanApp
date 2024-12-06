<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tanaman - Tanam.in</title>
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

        .img-placeholder {
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
                <a class="nav-link" href="#">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">All Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Order List</a>
            </li>
        </ul>
    </div>



    <div class="container">
        <h1>Edit Tanaman</h1>

        <form action="{{ route('tanaman.update', ['id' => $tanaman->idTanaman]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="namaTanaman">Nama Tanaman</label>
                <input type="text" class="form-control" id="namaTanaman" name="namaTanaman" value="{{ old('namaTanaman', $tanaman->namaTanaman) }}" required>
                @error('namaTanaman')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                @error('deskripsi')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="jmlTanaman">Jumlah Tanaman</label>
                <input type="number" class="form-control" id="jmlTanaman" name="jmlTanaman" value="{{ old('jmlTanaman', $tanaman->jmlTanaman) }}" required>
                @error('jmlTanaman')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hargaTanaman">Harga</label>
                <input type="number" class="form-control" id="hargaTanaman" name="hargaTanaman" value="{{ old('hargaTanaman', $tanaman->hargaTanaman) }}" required>
                @error('hargaTanaman')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gambar">Galeri Produk</label>
                <div class="img-placeholder" onclick="document.getElementById('gambar').click();">
                    <i class="fas fa-image"></i> Drop your image here, or browse <br> Jpeg, png are allowed
                </div>
                <input type="file" class="form-control-file" id="gambar" name="gambar" style="display:none;" accept="image/*">
                @error('gambar')
                <div class="text-danger">{{ $message }}</div>
                @enderror


                <!-- Tempat untuk gambar baru yang diupload -->
                <div id="new-image" class="mt-3" style="display: none;">
                    <label>Gambar Baru:</label><br>
                    <img id="uploaded-image" src="" alt="Gambar Tanaman Baru" class="img-fluid" style="max-height: 200px;">
                </div>

                @if($tanaman->gambar)
                <div class="mt-3">
                    <label>Gambar Sebelumnya:</label><br>
                    <p>Nama Gambar: {{ $tanaman->gambar }}</p> <!-- Tambahkan ini untuk debugging -->
                    <img src="{{ asset('images/' . $tanaman->gambar) }}" alt="Gambar Tanaman" class="img-fluid" style="max-height: 200px;">
                </div>
                @else
                <p>Tidak ada gambar yang tersedia.</p>
                @endif

            </div>

            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-black">Perbarui</button>
                <a href="{{ route('homeKywn') }}" class="btn btn-outline-secondary">Cancel</a>
            </div>


            <script>
                // Event listener untuk menampilkan gambar baru sebelum form dikirim
                document.getElementById('gambar').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('uploaded-image').src = e.target.result; // Menampilkan gambar baru
                            document.getElementById('new-image').style.display = 'block'; // Menampilkan div gambar baru
                        }
                        reader.readAsDataURL(file);
                    }
                });
            </script>

        </form>
    </div>