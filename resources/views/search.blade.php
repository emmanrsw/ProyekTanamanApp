@extends('layout.navbar')

<style>
    /* Styling for the product grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        /* Responsive grid layout */
        gap: 20px;
        padding: 20px;
    }

    /* Styling for individual product cards */
    .product-card {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        padding: 15px;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
        /* Subtle hover effect */
    }

    /* Image styling inside product card */
    .product-card img {
        width: 100%;
        height: auto;
        border-radius: 8px;
        object-fit: cover;
    }

    /* Styling for product info section (title and price) */
    .product-info {
        margin: 10px 0;
    }

    .product-info h5 {
        font-size: 18px;
        margin: 10px 0;
        color: #333;
    }

    .product-info p {
        font-size: 16px;
        color: #777;
    }

    /* Button styling */
    .btn-add-to-cart {
        background-color: #4B553D;
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-add-to-cart:hover {
        background-color: #3a422f;
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

    /* card */
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

    <div class="container">
        @if (isset($message))
            <div class="alert alert-danger mt-4">
                {{ $message }}
        </div> @else
            <!-- Display search query -->
            @if(isset($query))
                <h3 style="margin-top: 10px; font-weight: 650;font-size: 20px;">Hasil Pencarian: {{ $query }}</h3>
            @endif
            <div class="product-grid mb-4">
                @foreach ($tanamans as $tanaman)
                    <div class="product-card">
                        <img src="{{ $tanaman->gambar ? asset('images/' . $tanaman->gambar) : asset('default-image.png') }}"
                            alt="{{ $tanaman->namaTanaman }}">
                        <div class="product-info">
                            <h5>{{ $tanaman->namaTanaman }}</h5>
                            <p>Rp{{ number_format($tanaman->hargaTanaman, 0, ',', '.') }}</p>
                        </div>
                        <button class="btn btn-primary btn-add-to-cart" data-product='@json($tanaman)'>View Details</button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
<script>
    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function () {
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
@endsection