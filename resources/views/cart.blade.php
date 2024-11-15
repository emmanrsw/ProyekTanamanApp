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

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><span>Tanam</span><span class="highlight">.in</span></a>
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
            <!-- User icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    <a href="{{ route('profile') }}" class="nav-link">
                        {{ session('usernameCust') }}
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
        <h1>Keranjang Belanja</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if($cartItems->isEmpty())
        <p>Keranjang Anda kosong.</p>
        @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nama Tanaman</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->namaTanaman }}</td>
                    <td class="harga_satuan">{{ number_format($item->harga_satuan, 2) }}</td>
                    <td>
                        <input type="number" id="quantity-{{ $item->idTanaman }}" class="form-control" value="{{ $item->jumlah }}"
                            onchange="updateQuantity({{ $item->idTanaman }})">
                    </td>
                    <td class="total_harga">{{ number_format($item->total_harga, 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $item->idTanaman) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <script>
        function updateTotal(id, price) {
            var quantity = document.getElementById("quantity-" + id).value;
            var total = quantity * price;
            document.getElementById("total-" + id).innerText = total.toFixed(2);
        }
    </script>
    <script>
        function updateQuantity(idTanaman) {
            var quantityInput = document.getElementById("quantity-" + idTanaman);
            var newQuantity = parseInt(quantityInput.value);
            var row = quantityInput.closest('tr'); // Mendapatkan baris terkait untuk perhitungan total harga

            // Kirim request ke server untuk memperbarui jumlah
            $.ajax({
                url: '{{ route("cart.update") }}', // Route untuk mengupdate jumlah
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    idTanaman: idTanaman,
                    quantity: newQuantity
                },
                success: function(response) {
                    // Update total harga
                    var unitPrice = parseFloat(row.querySelector(".harga_satuan").textContent.replace(/[^0-9.-]+/g, ""));
                    var totalPrice = newQuantity * unitPrice;
                    row.querySelector(".total_harga").textContent = totalPrice.toFixed(2);
                },
                error: function() {
                    alert('Terjadi kesalahan saat memperbarui jumlah.');
                }
            });
        }
    </script>

</body>

</html>