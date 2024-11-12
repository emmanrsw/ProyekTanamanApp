<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    body {
        font-family: 'Poppins';
    }

    /* Navbar */
    .navbar {
        background-color: white;
        padding: 20px 80px;
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

    /* Banner Section */
    .banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f7f0;
        padding: 80px 100px;
        margin: 0;
        width: 100%;
        /* Mengatur lebar banner 100% dari elemen induknya */
        height: 400px;
        /* Menentukan tinggi spesifik */
    }

    .banner h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #243a56;
    }

    .banner p {
        font-size: 1.2rem;
        margin-top: 15px;
        margin-bottom: 30px;
        color: #555;
    }

    .banner img {
        max-width: 250px;
        height: auto;
    }

    .btn-custom {
        background-color: #4B553D;
        color: white;
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 1rem;
        border: none;
    }

    .btn-custom:hover {
        background-color: gray;
    }

    /* Plant Gallery */
    .plant-gallery {
        display: flex;
        overflow-x: scroll;
        scroll-behavior: smooth;
        padding: 10px;
        white-space: nowrap;
    }

    .plant-card {
        display: inline-block;
        margin-right: 15px;
        border: 1px solid #ccc;
        /* Menambahkan border di sekeliling kotak */
        border-radius: 10px;
        /* Membuat sudut sedikit membulat */
        padding: 10px;
        /* Memberikan ruang antara gambar dan tepi kotak */
        background-color: #fff;
        /* Warna latar belakang kotak */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Opsional: bayangan untuk efek 3D */
    }

    .plant-card img {
        width: 100%;
        /* Membuat gambar responsif dan sesuai ukuran asli */
        height: auto;
        /* Menjaga rasio gambar */
        max-width: 150px;
        /* Membatasi ukuran maksimum gambar */
        border-radius: 10px;
        /* Opsional: membuat gambar sedikit membulat */
    }

    .plant-card h3 {
        font-size: 14px;
        /* Ukuran teks lebih kecil */
        margin-top: 10px;
        font-weight: normal;
        color: #333;
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

    .topnav {
        position: relative;
    }

    #myLinks {
        position: absolute;
        top: 60px;
        /* Sesuaikan dengan tinggi navbar Anda */
        right: 0;
        /* Memposisikan menu di sisi kanan */
        background-color: #333;
        border-radius: 5px;
        /* Menambahkan sudut membulat */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Menambahkan bayangan */
        z-index: 1000;
        /* Pastikan menu berada di atas elemen lain */
        font-size: 14px;
    }

    #myLinks a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    #myLinks a:hover {
        background-color: #ddd;
        color: black;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
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
            <a href="{{ route('cart') }}" class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fa fa-shopping-cart"></i> 
            </a>
            <!-- User Icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i> 
                </a>
                <div id="myLinks" style="display: none;">
                    <a href="{{ route('profile') }}" class="nav-link">
                        <i class="fa fa-user"></i> {{ session('usernameCust') }}
                    </a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Session Message -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Pencarian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Cari tanaman...">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Cari</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Keranjang Anda kosong.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-text">
            <h1>Bonsai</h1>
            <p>Temukan semua yang perlu Anda ketahui tentang tanaman Anda, perlakukan mereka dengan baik dan mereka akan
                menjaga Anda.</p>
            <a href="{{ route('listTanaman') }}" class="btn-custom">Jelajahi Lebih Lanjut</a>
        </div>
        <div class="banner-image">
            <img src="Img/bonsai.png" alt="Bonsai" />
        </div>
    </section>

    <!-- Plant Gallery -->
    <section class="plant-gallery">
        <div class="plant-card">
            <img src="Img/birds.png" alt="birds">
            <h3>Sansevieria Trifasciata</h3>
        </div>
        <div class="plant-card">
            <img src="Img/pilee.png" alt="pilea">
            <h3>Pilea Peperoimedes</h3>
        </div>
        <div class="plant-card">
            <img src="Img/plant1.png" alt="aglo">
            <h3>Aglonema KomKom</h3>
        </div>
        <div class="plant-card">
            <img src="Img/pink.png" alt="Anthu">
            <h3>Anthurium Andra</h3>
        </div>
        <div class="plant-card">
            <img src="Img/sily.png" alt="cala">
            <h3>Pink Calla Lily</h3>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
</body>

</html>