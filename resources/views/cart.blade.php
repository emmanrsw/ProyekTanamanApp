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

        @if (session('cart'))
        <div class="row">
            <div class="col-md-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Pilih</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (session('cart') as $id => $details)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_items[]" value="{{ $id }}">
                            </td>
                            <td>
                                <img src="{{ asset('images/' . $details['gambar']) }}" width="50" height="50" alt="Tanaman">
                                <strong>{{ $details['namaTanaman'] }}</strong>
                            </td>

                            <td>Rp{{ number_format($details['hargaTanaman'], 0, ',', '.') }}</td>
                            <td>
                                <div class="input-group" style="width: 150px;">
                                    <button type="button" class="btn btn-outline-secondary" onclick="decreaseQuantity('{{ $id }}')">-</button>
                                    <input type="text" class="form-control text-center" id="quantity-{{ $id }}" value="{{ $details['quantity'] }}" readonly>
                                    <button type="button" class="btn btn-outline-secondary" onclick="increaseQuantity('{{ $id }}')">+</button>
                                </div>
                            </td>

                            <td>Rp{{ number_format($details['hargaTanaman'] * $details['quantity'], 0, ',', '.') }}
                            </td>
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger" style="padding: 0; border: none; background: none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <div class="cart-summary">
                    <h3>Jumlah Keranjang</h3>
                    <p><strong>Subtotal:</strong> ${{ array_sum(array_column(session('cart'), 'price')) }}</p>
                    <p><strong>Diskon:</strong> — </p>
                    <p><strong>Total:</strong>
                        {{-- ${{ array_sum(
                                array_map(function ($details) {
                                    return $details['harga'] * $details['quantity'];
                                }, session('cart')),
                            ) }} --}}
                        {{-- </p> --}}
                        <a href="#" class="btn btn-primary btn-block">Lanjutkan ke Pembayaran</a>
                </div>
            </div>
        </div>
        @else
        <p>Keranjang belanja kosong</p>
        @endif
        {{-- </div>
    <div class="container">
        <div class="row">
            @foreach ($tanaman as $tanaman)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ $tanaman->gambar }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $tanaman->nama }}</h5>
            <p class="card-text">${{ $tanaman->hargaTanaman }}</p>
            <a href="{{ route('cart.add', ['id' => $tanaman->id]) }}" class="btn btn-primary">Add to
                Cart</a>
            </form>
        </div>
    </div>
    </div>
    @endforeach
    </div> --}}
    </div>
    <script>
        function decreaseQuantity(id) {
            var quantityInput = document.getElementById("quantity-" + id);
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) { // Minimal 1 item
                quantityInput.value = currentQuantity - 1;
                // Anda bisa menambahkan kode di sini untuk memperbarui kuantitas di server
            }
        }

        function increaseQuantity(id) {
            var quantityInput = document.getElementById("quantity-" + id);
            var currentQuantity = parseInt(quantityInput.value);
            quantityInput.value = currentQuantity + 1;
            // Anda bisa menambahkan kode di sini untuk memperbarui kuantitas di server
        }
    </script>

</body>

</html>