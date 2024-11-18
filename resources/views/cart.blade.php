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
            color: #4B553D;
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
            padding: 10px;
            margin-bottom: 30px;
        }

        .cart-items {
            width: 75%;
            border-radius: 15px;
            flex-direction: column;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background-color: #4B553D;
            color: white;
            padding: 10px;
            text-align: center;
            font-size: 1rem;
        }

        .table thead tr:first-child th:first-child {
            border-top-left-radius: 10px;
        }

        .table thead tr:first-child th:last-child {
            border-top-right-radius: 10px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            text-align: center;
            font-size: 0.95rem;
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
            background-color: #4B553D;
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
            background-color: #4B553D;
            color: white;
            border: none;
            border-radius: 5px;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ Auth::guard('pelanggan')->check() ? route('homePage') : route('register') }}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ Auth::guard('pelanggan')->check() ? route('homePage') : route('register') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>

            <!-- Shopping Cart Icon -->
            <a href="{{ route('cart') }}" class="nav-link">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <!-- User Icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    @if(Auth::guard('pelanggans')->check())
                    <a href="{{ route('pelanggan.profile') }}" class="nav-link">
                        {{ Auth::guard('pelanggans')->user()->usernameCust }}
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

                    <form action="/transaksi" method="GET">
                        @csrf
                        <button class="btn">BAYAR SEKARANG</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="container">

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="cart-container">
            <!-- Bagian Keranjang Belanja -->
            <div class="cart-items">
                @if ($cartItems->isEmpty())
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
                        @foreach ($cartItems as $item)
                        <tr>
                            <td><input type="checkbox" class="plant-checkbox"
                                    data-item-id="{{ $item->idTanaman }}" data-price="{{ $item->harga_satuan }}"
                                    data-total="{{ $item->total_harga }}" onclick="updateSubtotal()"></td>
                            <td>
                                <!-- Menampilkan Gambar dan Nama Tanaman di Samping -->
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <img src="{{ asset('images/' . $item->gambar) }}"
                                        alt="{{ $item->namaTanaman }}"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                    <span>{{ $item->namaTanaman }}</span>
                                </div>
                            </td>
                            <td class="harga_satuan">{{ number_format($item->harga_satuan) }}</td>
                            <td>
                                <div class="quantity-wrapper">
                                    <form method="POST"
                                        action="{{ route('cart.decreaseqty', ['rowId' => $item->idKeranjang]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn-minus"
                                            onclick="this.closest('form').submit()">-</button>
                                    </form>

                                    <input type="text" class="jumlah-input" value="{{ $item->jumlah }}"
                                        data-id="{{ $item->idKeranjang }}" readonly>

                                    <form method="POST"
                                        action="{{ route('cart.increaseqty', ['rowId' => $item->idKeranjang]) }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn-plus"
                                            onclick="this.closest('form').submit()">+</button>
                                    </form>
                                </div>
                            </td>

                            <td id="total-{{ $item->idTanaman }}">{{ number_format($item->total_harga) }}
                            </td>
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
                <h5>Ringkasan Keranjang</h5>
                <table>
                    <tr>
                        <td>SUBTOTAL</td>
                        <td class="subtotal">Rp0</td>
                    </tr>
                    <tr>
                        <td>PAJAK (10%)</td>
                        <td id="tax">Rp0</td>
                    </tr>
                    <tr class="total">
                        <td>TOTAL</td>
                        <td>Rp0</td>
                    </tr>
                </table>

                <form action="{{ route('transaksi') }}" method="GET">
                    @csrf
                    <button class="checkout-btn">Lanjutkan Ke Pembayaran</button>
                </form>
            </div>

        </div>
    </div>
    <script>
        $(function() {
            $(".btn-plus").on("click", function() {
                $(this).closest('form').submit();

                // Tunggu hingga server merespons, lalu perbarui subtotal
                setTimeout(updateSubtotal, 500);
            });

            $(".btn-minus").on("click", function() {
                $(this).closest('form').submit();

                // Tunggu hingga server merespons, lalu perbarui subtotal
                setTimeout(updateSubtotal, 500);
            });
        });
    </script>
    <script>
        // Fungsi untuk memperbarui ringkasan keranjang
        function updateSummary() {
            const checkboxes = document.querySelectorAll('.plant-checkbox:checked'); // Pilih checkbox yang dicentang
            let subtotal = 0;

            // Hitung subtotal dari checkbox yang dicentang
            checkboxes.forEach(checkbox => {
                subtotal += parseFloat(checkbox.dataset.total); // Ambil nilai `data-total` dari produk
            });

            const taxRate = 0.1; // Pajak 10%
            const tax = subtotal * taxRate;
            const total = subtotal + tax;

            // Update nilai di DOM
            document.getElementById('subtotal').textContent = `Rp${subtotal.toLocaleString()}`;
            document.getElementById('tax').textContent = `Rp${tax.toLocaleString()}`;
            document.getElementById('total').textContent = `Rp${total.toLocaleString()}`;

            // Aktifkan tombol checkout jika subtotal lebih dari 0
            const checkoutButton = document.getElementById('checkoutButton');
            if (subtotal > 0) {
                checkoutButton.classList.add('enabled');
                checkoutButton.disabled = false;
            } else {
                checkoutButton.classList.remove('enabled');
                checkoutButton.disabled = true;
            }
        }

        // Event listener untuk setiap checkbox
        document.querySelectorAll('.plant-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });

        // Panggil fungsi saat halaman pertama kali dimuat
        updateSummary();

        function updateCheckoutButtonState() {
            const checkboxes = document.querySelectorAll('.plant-checkbox');
            const checkoutButton = document.getElementById('checkoutButton');

            // Periksa jika ada checkbox yang dicentang
            const isAnyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if (isAnyChecked) {
                checkoutButton.classList.add('enabled');
                checkoutButton.classList.remove('disabled');
            } else {
                checkoutButton.classList.remove('enabled');
                checkoutButton.classList.add('disabled');
            }
        }

        // Tambahkan event listener untuk semua checkbox
        document.querySelectorAll('.plant-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateCheckoutButtonState);
        });

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
            updateCheckoutButtonState();
        };

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