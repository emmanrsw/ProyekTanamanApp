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

        /* Flex Layout */
        .cart-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .cart-items {
            width: 75%;
        }

        .cart-summary {
            width: 22%;
            height: auto;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-size: 0.85rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-summary h5 {
            background-color: #6b8e23;
            color: #fff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            margin: -15px -15px 15px -15px;
            font-size: 1.1rem;
            text-align: center;
        }

        .cart-summary table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .cart-summary td {
            padding: 8px 10px;
            text-align: left;
        }

        .cart-summary .total {
            font-weight: bold;
            font-size: 1rem;
            text-align: right;
            padding-right: 10px;
        }

        .cart-summary .checkout-btn {
            font-size: 0.9rem;
            padding: 12px;
            background-color: #000;
            color: #fff;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin-top: 15px;
            text-align: center;
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 5px;
        }

        .btn-minus,
        .btn-plus {
            padding: 5px 10px;
            background-color: #6b8e23;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 38px;
        }

        .jumlah-input {
            width: 50px;
            text-align: center;
            font-size: 1rem;
            padding: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0;
            background-color: #f8f9fa;
            height: 38px;
            box-sizing: border-box;
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

        <div class="cart-container">
            <!-- Bagian Keranjang Belanja -->
            <div class="cart-items">
                @if($cartItems->isEmpty())
                <p>Keranjang Anda kosong.</p>
                @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
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
                            <td><input type="checkbox" class="plant-checkbox" data-item-id="{{ $item->idTanaman }}" data-price="{{ $item->harga_satuan }}" data-total="{{ $item->total_harga }}" onclick="updateSubtotal()"></td>
                            <td>
                                <!-- Menampilkan Gambar dan Nama Tanaman di Samping -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->namaTanaman }}" style="width: 50px; height: 50px; object-fit: cover;">
                                    <span>{{ $item->namaTanaman }}</span>
                                </div>
                            </td>
                            <td class="harga_satuan">{{ number_format($item->harga_satuan) }}</td>
                            <td>
                                <div class="quantity-wrapper">
                                    <form method="POST" action="{{route('cart.decreaseqty',['rowId' => $item->idKeranjang])}}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn-minus" onclick="this.closest('form').submit()">-</button>
                                    </form>

                                    <input type="text" class="jumlah-input" value="{{ $item->jumlah }}" data-id="{{ $item->idKeranjang }}" readonly>

                                    <form method="POST" action="{{route('cart.increaseqty',['rowId' => $item->idKeranjang])}}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn-plus" onclick="this.closest('form').submit()">+</button>
                                    </form>
                                </div>
                            </td>

                            <td id="total-{{ $item->idTanaman }}">{{ number_format($item->total_harga) }}</td>
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

            <!-- Bagian Jumlah Keranjang -->
            <div class="cart-summary">
                <h5>Jumlah Keranjang</h5>
                <table>
                    <tr>
                        <td>SUBTOTAL</td>
                        <td class="subtotal">Rp0</td>
                    </tr>
                    <tr>
                        <td>DISKON</td>
                        <td>---</td>
                    </tr>
                    <tr class="total">
                        <td>TOTAL</td>
                        <td>Rp0</td>
                    </tr>
                </table>
                <a class="checkout-btn" href="#">Lanjutkan Ke Pembayaran</a>
            </div>

        </div>
    </div>
    <script>
        $(function() {
            $(".btn-plus").on("click", function() {
                $(this).closest('form').submit();
            })
        })
        $(function() {
            $(".btn-minus").on("click", function() {
                $(this).closest('form').submit();
            })
        })
    </script>
    <script>
        function updateSubtotal() {
            let subtotal = 0;

            // Iterate over all checkboxes
            document.querySelectorAll('.plant-checkbox').forEach(checkbox => {
                if (checkbox.checked) {
                    // Add the total price of the checked item to subtotal
                    subtotal += parseFloat(checkbox.dataset.total);
                }
            });

            // Format subtotal with thousands separator (Rp xxx.xxx)
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            // Update the subtotal display
            document.querySelector('.subtotal').textContent = "Rp " + formattedSubtotal;

            // Calculate total (apply discount if available)
            let discount = 0; // default: no discount
            let total = subtotal - discount;

            // Format the total with thousands separator (Rp xxx.xxx)
            const formattedTotal = new Intl.NumberFormat('id-ID').format(total);

            // Update the total display
            document.querySelector('.total td:last-child').textContent = "Rp " + formattedTotal;
        }

        // Initialize subtotal and total when page loads
        window.onload = function() {
            updateSubtotal();
        };
    </script>
</body>

</html>