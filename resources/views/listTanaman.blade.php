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

    .navbar {
        background-color: white;
        padding: 20px 80px;
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

    .banner p {
        font-size: 1.2rem;
        margin-top: 15px;
        margin-bottom: 30px;
        color: #555;
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

    .filter-section {
        margin: 30px 0;
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
        background-color: #6c9969;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .btn-add-to-cart:hover {
        background-color: #578154;
    }

    #myLinks {
        display: none;
    }

    #myLinks.show {
        display: block;
    }

    #myLinks a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
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
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{ route('cart') }}" class="nav-link">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="toggleUserMenu()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks">
                    <a href="{{ route('profile') }}" class="nav-link">{{ session('usernameCust') }}</a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="jumbotron">
            <img src="Img/jumbotron.png" alt="jumbotron" style="height: 50%; width: 100%;">
        </div>

        <div class="container">
            <div class="row filter-section">
                <div class="col-md-3">
                    <div class="filter-price">
                        <p><strong>Price</strong></p>
                        <form action="{{ route('tanaman.show') }}" method="GET">
                            <div class="d-flex">
                                <input type="number" name="min_price" class="form-control form-control-sm" placeholder="Min" value="{{ request('min_price') }}">
                                <span class="mx-2">-</span>
                                <input type="number" name="max_price" class="form-control form-control-sm" placeholder="Max" value="{{ request('max_price') }}">
                            </div>
                            <button type="submit" class="btn btn-custom mt-3">Apply Filter</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Tanaman</h3>
                        <form method="GET" action="{{ route('tanaman.show') }}">
                            <select class="form-select" aria-label="Sort by" name="sort" onchange="this.form.submit()">
                                <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="price_low_high" {{ request('sort') == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_high_low" {{ request('sort') == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
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
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel">${product.namaTanaman}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img src="${product.gambar ? '/images/' + product.gambar : '/default-image.png'}" class="img-fluid" alt="${product.namaTanaman}">
                            <p>Harga: Rp${product.hargaTanaman.toLocaleString()}</p>
                            <p>Deskripsi: ${product.deskripsi || "Deskripsi tidak tersedia"}</p>
                            <!-- Input untuk jumlah -->
                            <div class="mt-3">
                                <label for="jumlah">Jumlah:</label>
                                <input type="number" id="jumlah" class="form-control" value="1" min="1" max="100">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="addToCart(${product.idTanaman})">Tambah ke Keranjang</button>
                        </div>
                    </div>
                </div>
            </div>`;

            document.body.insertAdjacentHTML('beforeend', modalContent);
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }

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
                    alert(data.message || "Produk berhasil ditambahkan ke keranjang!");
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
    </script>
</body>

</html>