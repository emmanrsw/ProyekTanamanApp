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

    .navbar-brand .highlight {
        color: #6c9969;
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
        background-color: #6c9969;
        color: white;
        padding: 15px 30px;
        border-radius: 5px;
        font-size: 1rem;
        border: none;
    }

    .btn-custom:hover {
        background-color: #578154;
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

    /* Filter and Product Section */
    .filter-section {
        margin: 30px 0;
    }

    .filter-header {
        font-weight: bold;
        font-size: 1.2rem;
        margin-bottom: 10px;
    }


    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .product-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 23%;
        margin-bottom: 30px;
        padding: 20px;
        text-align: center;
    }


    .product-card img {
        max-width: 100%;
        height: auto;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .product-card h5 {
        font-weight: bold;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .product-card p {
        color: #6c9969;
        font-weight: bold;
    }

    .sort-by {
        margin-left: auto;
    }

    .filter-price {
        padding: 10px;
    }

    .filter-price input {
        width: 100px;
        margin-right: 10px;
    }

    .modal-img {
        max-width: 50%;
        /* Gambar tidak lebih dari lebar modal */
        height: auto;
        /* Menjaga rasio aspek gambar */
        margin: 0 auto;
        /* Mengatur gambar ke tengah */
        display: block;
        /* Memastikan gambar ditampilkan sebagai block element */
    }

    .product img {
        max-width: 35%;
        /* Gambar tidak lebih dari lebar modal */
        height: auto;
        /* Menjaga rasio aspek gambar */
        margin: 0 auto;
        /* Mengatur gambar ke tengah */
        display: block;
        /* 
     */
    
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
        <a class="navbar-brand" href="{{ route('home') }}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Tanaman Saya</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>

            <!-- Shopping Cart Icon -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal">
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

    <div class="container">
        <div class="jumbotron">
            <img src="Img/jumbotron.png" alt="jumbotron" style="height: 50%; width: 100%;">
        </div>

        <!-- Filter & Product Section -->
        <div class="container">
            <div class="row filter-section">
                <div class="col-md-3">
                    <div class="filter-header">Filter</div>
                    <div class="filter-price">
                        <p>Price</p>
                        <input type="text" placeholder="Min"> - <input type="text" placeholder="Max">
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Tanaman</h3>
                        <select class="form-select sort-by" aria-label="Sort by" style="width: 150px; height: 30px; font-size: 12px;">
                            <option selected>Sort by: Popular</option>
                            <option value="1">Price: Low to High</option>
                            <option value="2">Price: High to Low</option>
                        </select>
                    </div>
                    <!-- Product Grid -->
                    <div class="product-grid">
                        @foreach($tanaman as $tanaman)
                        <div class="product">
                            @if($tanaman->gambar)
                            <img src="{{ asset('images/' . $tanaman->gambar) }}" alt="Product Image">
                            @else
                            <img src="{{ asset('default-image.png') }}" alt="No Image Available">
                            @endif <h3>{{ $tanaman->namaTanaman }}</h3>
                            <p>{{ $tanaman->deskripsi }}</p>
                            <p>Rp{{ number_format($tanaman->hargaTanaman, 0, ',', '.') }}</p>
                            <button class="btn btn-primary btn-add-to-cart" data-product='@json($tanaman)'>Add to Cart</button>
                        </div>
                        @endforeach
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="productModal${product.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">${product.name}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="${product.image}" alt="${product.name}" style="width: 50%; height:auto;">
                                    <p>${product.description}</p>
                                    <p><strong>Harga:</strong> ${product.price}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- `; -->
                    <!-- }); -->
                    <!-- </script> -->
                </div>
            </div>