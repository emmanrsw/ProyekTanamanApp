<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
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

    .navbar-brand .highlight {
        color: #6c9969;
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

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 16px;
        text-align: center;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 10px rgba(0, 0, 0, 0.2);
        /* Shadow saat hover */
    }

    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .product-card h5 {
        font-size: 18px;
        /* Ukuran font heading */
        font-weight: bold;
        margin-bottom: 5px;
    }

    .product-card p {
        font-size: 16px;
        /* Ukuran font untuk teks lainnya */
        margin-bottom: 10px;
    }

    .btn-primary {
        font-size: 16px;
        padding: 10px 15px;
        /* Padding untuk tombol */
        background-color: #4B553D;
        border: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #3a422f;
    }

    .modal-dialog {
        max-width: 500px;
        /* Atur ukuran maksimum modal */
        margin: 30px auto;
        /* Tambahkan margin untuk estetika */
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
        border-radius: 5px
    }

    .modal-footer {
        padding: 10px;
        /* Padding untuk header dan footer */
    }

    .modal-body {
        padding: 10px;
        /* Padding untuk isi modal */
    }

    .modal-body img {
        max-width: 50%;
        /* Gambar responsif di dalam modal */
        height: auto;
        border-radius: 5px;
    }

    .modal-body h4 {
        font-size: 18px;
        /* Ukuran heading dalam modal */
        font-weight: bold;
        margin-bottom: 10px;
    }

    .modal-body p {
        font-size: 14px;
        /* Ukuran font deskripsi */
        margin-bottom: 10px;
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
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Tanaman Saya</a></li>
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
            <!-- User icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    <a href="#" class="nav-link">
                        {{ session('usernameCust') }}
                    </a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                </div>
            </div>
        </div>
    </nav>
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

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Pencarian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('searchTanaman') }}" method="GET">
                        <input type="text" name="query" class="form-control" placeholder="Cari tanaman..."
                            required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <strong class="modal-title" id="cartModalLabel">Keranjang Belanja</strong>
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

        {{-- <h3>Hasil Pencarian : {{ $query }}</h3> --}}

        @if (isset($message))
            <div class="alert alert-warning">
                {{ $message }}
            </div>
        @else
            <div class="product-grid">
                @foreach ($tanamans as $tanaman)
                    <div class="product-card">
                        <img src="{{ $tanaman->gambar ? asset('images/' . $tanaman->gambar) : asset('default-image.png') }}"
                            alt="{{ $tanaman->namaTanaman }}">
                        <h5>{{ $tanaman->namaTanaman }}</h5>
                        <p>Rp{{ number_format($tanaman->hargaTanaman, 0, ',', '.') }}</p>
                        <button class="btn btn-primary btn-add-to-cart"
                            data-product='@json($tanaman)'>View Details</button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.querySelectorAll('.btn-add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                const product = JSON.parse(this.dataset.product);
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
                    <div class="product-info border-bottom pb-2 mb-3 d-flex align-items-center">
                        <span class="me-2">Jumlah : </span>
                        <input type="number" id="jumlah" class="form-control" value="1" min="1" max="100" style="width: 80px;">
                    </div>
                    <!-- Stok Tersedia -->
                    <div class="product-info border-botton pb-2 mb-3">
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
        `;

            document.body.insertAdjacentHTML('beforeend', modalContent);
            new bootstrap.Modal(document.getElementById('productModal')).show();
        }

        function addToCart(productId) {
            const jumlah = document.getElementById('jumlah').value;

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
                        jumlah
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || "Produk berhasil ditambahkan ke keranjang!",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>
