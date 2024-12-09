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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        background-color: white;
        padding: 10px 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 0;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #000;
    }

    .navbar-brand .highlight {
        color: #4B553D;
    }

    .navbar-nav .nav-link {
        color: #333;
        margin-right: 20px;
    }

    .banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f7f0;
        padding: 80px 100px;
        margin: 0;
        width: 100%;
        height: 400px;
    }

    .banner h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #243a56;
    }

    .btn-custom {
        background-color: #4B553D;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 1rem;
        border: none;
    }

    .btn-custom:hover {
        background-color: #578154;
    }

    .navbar-icons {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .navbar-icons a {
        margin-left: 20px;
        color: #000;
        font-size: 1.2rem;
    }

    .filter-section {
        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 4px 9px rgba(0, 0, 0, 0.5);
        margin: 10px 0;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 20px;
    }

    .product-card {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 30%;
        padding: 20px;
        text-align: center;
        transition: transform 0.3s;
    }

    .product-card img {
        max-width: 100%;
        height: auto;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .product-card:hover {
        transform: scale(1.05);
    }

    .btn-add-to-cart {
        background-color: #4B553D;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-add-to-cart:hover {
        background-color: #578154;
    }

    #myLinks {
        position: absolute;
        top: 60px;
        right: 0;
        background-color: #333;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
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

    .img-fluid {
        max-width: 50%;
        margin: 0 auto;
        border-radius: 10px;
        /* Center secara horizontal */
    }

    /* display: block;
    /* Diperlukan untuk margin bekerja pada elemen inline seperti gambar */
    /* } */

    */ .carousel-inner img {
        width: 100%;
        /* Menyesuaikan lebar gambar dengan container */
        height: auto;
        /* Memastikan tinggi tetap proporsional */
        object-fit: cover;
        /* Menangani kasus jika gambar memiliki rasio aspek berbeda */
    }

    .col-md-9 {
        border-radius: 5px;
        padding: 10px;
        /* background-color: #f5f7f0; */
    }

    .col-md-3 {
        border-radius: 5px;
        padding: 10px;
        /* background-color: #f5f7f0; */
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 75%;
    }


    .modal-header {
        color: #4B553D;
        padding: 10px 25px;
        border-radius: 5px;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand"
            href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}"><span>Tanam</span><span
                class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{ route('cart') }}" class="nav-link">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    @if (Auth::guard('pelanggan')->check() && Auth::guard('pelanggan')->user()->gambarCust)
                    <!-- Jika pengguna memiliki gambar profil -->
                    <img src="{{ asset('storage/' . Auth::guard('pelanggan')->user()->gambarCust) }}"
                        alt="User Profile" class="rounded-circle" width="30" height="30">
                    @else
                    <!-- Jika tidak ada gambar profil, tampilkan ikon default -->
                    <i class="fa fa-user"></i>
                    @endif
                </a>
                <div id="myLinks" style="display: none;">
                    @if (Auth::guard('pelanggan')->check())
                    <a href="{{ route('pelanggan.profile') }}" class="nav-link">
                        {{ Auth::guard('pelanggan')->user()->usernameCust }}
                    </a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                    @else
                    <a href="{{ route('login.login') }}" class="nav-link">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>
    {{-- <div class="container"> --}}
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/Img/1bg.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Img/2bg.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Img/3bg.png" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
    {{-- </div> --}}

    {{-- <div class="container"> --}}
    <div class="row filter-section">
        <div class="col-md-3">
            <div class="filter-price">
                <p><strong>Price</strong></p>
                <form action="{{ route('tanaman.show') }}" method="GET">
                    <div class="d-flex" style="width: 210px; font-size: 14px;">
                        <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min"
                            value="{{ request('min_price') }}">
                        <strong class="mx-2">-</strong>
                        <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max"
                            value="{{ request('max_price') }}">
                    </div>
                    <button type="submit" class="btn btn-custom mt-3">Apply Filter</button>
                </form>
            </div>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5><strong>Tanaman</strong></h5>
                <form method="GET" action="{{ route('tanaman.show') }}">
                    <select class="form-select" style="width: 110px; font-size: 14px;" aria-label="Sort by"
                        name="sort" onchange="this.form.submit()">
                        <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default
                        </option>
                        <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>
                            Price: Low to High</option>
                        <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>
                            Price: High to Low</option>
                    </select>
                </form>
            </div>
            <div class="product-grid">
                @foreach ($tanaman as $tanaman)
                <div class="product-card">
                    <img src="{{ $tanaman->gambar ? asset('images/' . $tanaman->gambar) : asset('default-image.png') }}"
                        alt="{{ $tanaman->namaTanaman }}">
                    <h5>{{ $tanaman->namaTanaman }}</h5>
                    <p>Rp{{ number_format($tanaman->hargaTanaman, 0, ',', '.') }}</p>
                    <button class="btn btn-primary btn-add-to-cart"
                        data-product='@json($tanaman)'>View Details</button>
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.querySelectorAll('.btn-add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const product = JSON.parse(this.getAttribute('data-product'));
                showProductModal(product);
            });
        });

        function showProductModal(product) {
            const existingModal = document.getElementById('productModal');
            if (existingModal) existingModal.remove();

            const modalContent = `
            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel"; style="font-weight: bold">
                    ${product.namaTanaman}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                <!-- Gambar -->
                <div class="d-flex justify-content-center mb-3">
                    <img src="${product.gambar ? '/images/' + product.gambar : '/default-image.png'}" class="img-fluid" alt="${product.namaTanaman}">
                </div>

                <!-- Detail Produk -->
                <div class="product-details">
                    <!-- Harga -->
                    <div class="product-info border-top border-bottom pb-2 pt-2 mb-3">
                        <span>Harga : </span>
                        <span>Rp${product.hargaTanaman.toLocaleString()}</span>
                    </div>
                    <!-- Deskripsi -->
                    <div class="product-info border-bottom pb-2 mb-3">
                        <span>Deskripsi : </span>
                        <span>${product.deskripsi || "Deskripsi tidak tersedia"}</span>
                    </div>
                    <!-- Jumlah -->
                    <div class="product-info d-flex align-items-center">
                        <span class="me-2">Jumlah : </span>
                        <input type="number" id="jumlah" class="form-control" value="1" min="1" max="100" style="width: 80px;">
                    </div>
                    <!-- Stok Tersedia -->
                    <div class="product-info border-bottom pb-2 mb-3">
                        <span>Stok Tersedia : </span>
                        <span>${product.jmlTanaman} item</span>
                    </div>

                    
                </div>
            </div>
            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addToCart(${product.idTanaman})" ; style="background-color:#4B553D">Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
</div>

            </div>`;


            document.body.insertAdjacentHTML('beforeend', modalContent);
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }

        // function addToCart(productId) {
        //     fetch(`/cart/add/${productId}`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify({
        //                 productId: productId
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             alert(data.message || "Produk berhasil ditambahkan ke keranjang!");
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // }
        function addToCart(productId) {
            // Ambil jumlah dari input yang ada di modal
            const jumlah = document.getElementById('jumlah').value;

            // Pastikan jumlah adalah angka yang valid
            if (jumlah < 1) {
                alert('Jumlah tidak valid');
                return;
            }

            fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productId: productId,
                        jumlah: jumlah // Kirimkan jumlah yang dimasukkan pengguna
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || "Produk berhasil ditambahkan ke keranjang!",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    })
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function sortProducts() {
            const sortBy = document.querySelector('.sort-by').value;

            // Mengarahkan ke URL dengan query string untuk pengurutan
            window.location.href = `?sortBy=${sortBy}`;
        }

        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }

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