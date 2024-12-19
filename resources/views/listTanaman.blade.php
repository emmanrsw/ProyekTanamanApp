@extends('layout.navbar')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    button.btn-custom {
        background-color: #4B553D;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 1rem;
        border: none;
    }

    button.btn-custom:hover {
        background-color: #578154;
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

    button.btn-add-to-cart {
        background-color: #4B553D;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    button.btn-add-to-cart:hover {
        background-color: #578154;
    }

    .img-fluid {
        max-width: 50% !important;
        margin: 0 auto;
        border-radius: 10px;
        /* Center secara horizontal */
    }

    .carousel-inner img {
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
        width: 75% !important;
        height: 95%;
    }

    .modal-header {
        color: #4B553D;
        padding: 10px 25px;
        border-radius: 5px;
    }

    .product-card h5 {
        text-transform: capitalize;
    }

    /* .modal-footer {
        display: flex;
        flex-shrink: 0;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
    } */
</style>

@section('content')
<div class="container-fluid p-0">
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

    <div class="row filter-section" style="margin: 10px 0;">
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
                    <select class="form-select" style="width: 110px; font-size: 14px;" aria-label="Sort by" name="sort"
                        onchange="this.form.submit()">
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
                            alt="{{ ucwords(strtolower($tanaman->namaTanaman)) }}">
                        <h5>{{ ucwords(strtolower($tanaman->namaTanaman)) }}</h5>
                        <p>Rp{{ number_format($tanaman->hargaTanaman, 0, ',', '.') }}</p>
                        <button class="btn btn-primary btn-add-to-cart" data-product='@json($tanaman)'>View
                            Details</button>
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
            const product = JSON.parse(this.dataset.product);
            showProductModal(product);
        });
    });

    function capitalizeWords(str) {
        return str.replace(/\b\w/g, function (char) {
            return char.toUpperCase();
        });
    }
    function formatRupiah(angka) {
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

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
                    ${capitalizeWords(product.namaTanaman)}
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
                        <span>Rp${formatRupiah(product.hargaTanaman)}</span>
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

    function addToCart(productId) {
        // console.log(`Menambahkan produk dengan ID: ${productId} ke keranjang.`);

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
</script>
@endsection