<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins';
            /* background-color: #f5f5f5; */
        }

        .container {
            display: flex;
            max-width: 1300px;
            /* margin: 20px auto; */
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            width: 190px;
            background-color: #fff;
            border-right: 1px solid #ddd;
            padding: 20px;
        }

        /* Wrapper untuk gambar dan info profil */
        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .sidebar h2 {
            font-size: 16px;
            margin: 0 10px;
            /* Jarak antara gambar dan tulisan */
        }

        .sidebar a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 10px 0;
            font-size: 14px;
        }

        .edit-profile {
            margin-left: auto;
            /* Posisi ikon edit ke paling kanan */
            font-size: 14px;
            cursor: pointer;
            color: #5B6B3A;
        }

        .sidebar a.active {
            color: #5B6B3A;
            font-weight: bold;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .content p {
            color: #666;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #5B6B3A;
            /* Button color */
            color: white;
            /* Text color */
            padding: 10px 20px;
            /* Padding */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded corners */
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Font size */
            transition: background-color 0.3s;
            /* Smooth background color transition */
            text-align: center;
            /* Centered text */
            width: 170px;
            /* Full width */
            margin-top: 5px;
        }

        .btn-primary:hover {
            background-color: #4B553D;
            /* Button hover color */
        }

        /* Navbar */
        .navbar {
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 0;
            /* Ensure there is no margin at the bottom */
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
        }

        /* untuk tulisan .in */
        .navbar-brand .highlight {
            color: #4B553D;
        }

        .navbar-nav .nav-link {
            color: #333;
            margin-right: 20px;
        }

        /* Navbar Icons */
        .navbar-icons {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .navbar-icons a {
            margin-left: 20px;
            color: #333;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('home') }}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman Saya</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon -->
            <a href="#" class="nav-link">
                <i class="fa fa-search"></i>
            </a>

            <!-- Shopping Cart Icon -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <!-- User Icon -->
            <a href="{{ route('pelanggan.profile') }}" class="nav-link">
                <i class="fa fa-user"></i>
            </a>
        </div>
    </nav>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-info">
                @if ($customer->gambarCust)
                    <!-- Jika ada gambar profil -->
                    <img src="{{ asset('uploads/' . $customer->gambarCust) }}" alt="Profile Picture"
                        class="rounded-circle" width="150">
                @else
                    <!-- Jika belum ada gambar profil -->
                    <i class="fas fa-user-circle" style="font-size: 100px; color: #ddd;"></i>
                @endif
            </div>

            <a class="active" href="#"><i class="fas fa-user"></i> Akun Saya</a>
            <a href="#"><i class="fas fa-box"></i> Pesanan Saya</a>
            <a href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>

        <!-- Konten -->
        <div class="content">
            <h1>Profil Saya</h1>
            <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>

            <!-- Form Profil Page -->
            <form action="{{ route('pelanggan.edit') }}" method="GET">
                @csrf <!-- Token CSRF untuk keamanan -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="usernameCust" name="usernameCust" value="{{ $customer->usernameCust }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="namaCust" name="namaCust" value="{{ $customer->namaCust }}" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="emailCust" name="emailCust" value="{{ $customer->emailCust }}" readonly>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" id="notlpCust" name="notlpCust" value="{{ $customer->notlpCust }}" readonly>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" id="alamatCust" name="alamatCust" value="{{ $customer->alamatCust }}"
                        readonly>
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
                <!-- Tombol Hapus Gambar Profil (Hanya jika ada gambar yang diunggah) -->
                @if ($customer->gambarCust)
                    <button type="submit" name="delete_image" value="1" class="btn btn-primary">Hapus
                        Gambar</button>
                @endif
            </form>
        </div>

        {{-- <script>
            // Update preview image after file selection
            document.getElementById('profileImage').addEventListener('change', function(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('profileImagePreview').src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
            });
        </script> --}}

</body>

</html>
