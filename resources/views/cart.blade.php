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
            margin-top: 20px;
            justify-content: space-between;
            align-items: flex-start;
            /* Pastikan elemen sejajar dari atas */
            gap: 20px;
            padding: 10px;
            /* Tambahkan jarak antar elemen */
            margin-bottom: 100px;
            /* Tambahkan margin bawah untuk ruang ekstra */
        }

        .cart-items {
            flex: 3;
            border-radius: 15px;
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
            padding: 20px;
            vertical-align: middle;
            text-align: center;
            font-size: 0.95rem;
        }

        .cart-summary {
            flex: 1;
            position: sticky;
            top: 10px;
            /* Tetap di atas saat scroll */
            right: 0;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
            padding: 10px 10px;
            text-align: center;
        }

        .cart-summary .total {
            font-weight: bold;
            font-size: 1rem;
            text-align: center;
            padding-right: 10px;
        }

        .checkout-btn {
            font-size: 0.9rem;
            padding: 15px;
            width: 300px;
            /* Tambahkan satuan px */
            margin-inline-start: 10px;
            margin-block-start: 10px;
            background-color: #999;
            /* Default disabled state */
            color: #fff;
            border-radius: 10px;
            text-align: center;
            pointer-events: none;
            /* Prevent click */
            cursor: not-allowed;
        }

        .checkout-btn.enabled {
            background-color: black;
            /* Active state */
            cursor: pointer;
            pointer-events: auto;
            /* Enable click */
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

        .swal-wide {
            width: 400px !important;
            height: 200px;
            /* Sesuaikan lebar */
            font-size: 80%;
            /* Ukuran teks */
        }

        footer {
            margin-top: 30px;
            padding: 20px 0;
            background-color: #fff;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.4);
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        footer .footer-links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        footer .footer-links div {
            width: 30%;
        }

        footer .footer-links h4 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        footer .footer-links a {
            display: block;
            color: #666;
            text-decoration: none;
            margin-bottom: 5px;
        }
    </style>
</head>

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
                <li class="nav-item"><a class="nav-link"
                        href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak">Kontak</a></li>
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

    <!-- Cart Modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartModalLabel">Keranjang Belanja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Contoh daftar item di keranjang -->
                    <ul class="list-group">
                        @forelse ($cartItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item['name'] }} ({{ $item['quantity'] }})
                                <span
                                    class="badge bg-primary rounded-pill">Rp{{ number_format($item['price'], 0, ',', '.') }}</span>
                            </li>
                        @empty
                            <p>Keranjang Anda kosong.</p>
                        @endforelse
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container"> --}}
    @if (session('success'))
        <script>
            Swal.fire({
                position: "center", // Muncul di tengah
                icon: "success", // Ikon sukses
                title: "{{ session('success') }}", // Pesan sukses
                showConfirmButton: false, // Tidak ada tombol konfirmasi
                timer: 1000, // Waktu tampil 3 detik
                customClass: {
                    popup: 'swal-wide' // Tambahkan kelas kustom untuk lebar popup
                }
            });
        </script>
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
                                <td><input type="checkbox" class="plant-checkbox" data-item-id="{{ $item->idTanaman }}"
                                        data-price="{{ $item->harga_satuan }}" data-total="{{ $item->total_harga }}"
                                        onclick="updateSubtotal()"></td>
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
                    <td>PAJAK (5%)</td>
                    <td id="tax">Rp0</td>
                </tr>
                <tr class="total">
                    <td>TOTAL</td>
                    <td>Rp0</td>
                </tr>
            </table>

            <form action="{{ route('transaksi') }}" method="POST" id="checkoutForm">
                @csrf
                <!-- Elemen hidden input untuk mengirim data checkbox -->
                <input type="hidden" name="selectedItems" id="selectedItems">
                <button type="submit" class="checkout-btn" id="checkoutButton" disabled>Lanjutkan Ke
                    Pembayaran</button>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
            <script>
                // Misalkan ada array 'selectedItems' yang berisi ID tanaman yang dipilih
                var selectedItems = [1, 2, 3]; // Contoh ID tanaman yang dipilih
                document.getElementById('selectedItems').value = JSON.stringify(selectedItems); // Mengisi hidden input
                document.getElementById('checkoutButton').disabled = false; // Aktifkan tombol submit
            </script>
        </div>

    </div>
    <footer>
        <div class="footer-links">
            <div>
                <h4>INFORMASI PERUSAHAAN</h4>
                <a href="tentangKami">Tentang Kami</a>
                <a href="home">Dashboard</a>
                <a href="kontak">Hubungi Kami</a>
            </div>
            <div>
                <h4>LINK BANTUAN</h4>
                <a href="pesanan">Pelacakan</a>
                <a href="pesanan">Status Pesanan</a>
                <a href="pesanan">Pengiriman</a>
                <a href="pesanan">Info Pengiriman</a>
            </div>
            <div>
                <h4>MEDIA SOSIAL</h4>
                <a href="https://www.facebook.com" target="_blank">Facebook</a>
                <a href="https://www.instagram.com" target="_blank">Instagram</a>
                <a href="https://www.twitter.com" target="_blank">Twitter</a>
                <a href="https://www.linkedin.com" target="_blank">LinkedIn</a>
            </div>
        </div>
        <p>
            © 2020 Tanam.in eCommerce<br />
            Privacy Policy | Terms & Conditions
        </p>
    </footer>

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
        function updateCheckoutButtonState() {
            const checkboxes = document.querySelectorAll('.plant-checkbox');
            const checkoutButton = document.getElementById('checkoutButton');
            const selectedItemsInput = document.getElementById('selectedItems');

            let selectedItems = [];

            // Iterasi checkbox untuk memeriksa mana yang dicentang
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedItems.push(checkbox.dataset.itemId); // Simpan ID item yang dicentang
                }
            });

            // Update nilai input hidden dengan ID item yang dipilih
            selectedItemsInput.value = JSON.stringify(selectedItems);

            // Aktifkan atau nonaktifkan tombol berdasarkan apakah ada checkbox yang dicentang
            if (selectedItems.length > 0) {
                checkoutButton.classList.add('enabled');
                checkoutButton.removeAttribute('disabled'); // Aktifkan tombol
            } else {
                checkoutButton.classList.remove('enabled');
                checkoutButton.setAttribute('disabled', true); // Nonaktifkan tombol
            }
        }

        // Tambahkan event listener untuk setiap checkbox
        document.querySelectorAll('.plant-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateCheckoutButtonState);
        });

        function updateSubtotal() {
            let subtotal = 0;

            // Iterasi semua checkbox
            document.querySelectorAll('.plant-checkbox').forEach(checkbox => {
                if (checkbox.checked) {
                    // Tambahkan total harga item yang dicentang ke subtotal
                    subtotal += parseFloat(checkbox.dataset.total);
                }
            });

            // Format subtotal dengan separator ribuan (Rp xxx.xxx)
            const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);

            // Update tampilan subtotal
            document.querySelector('.subtotal').textContent = "Rp " + formattedSubtotal;

            // Hitung pajak (10% dari subtotal)
            const tax = subtotal * 0.05;

            // Format pajak dengan separator ribuan
            const formattedTax = new Intl.NumberFormat('id-ID').format(tax);

            // Update tampilan pajak
            document.querySelector('#tax').textContent = "Rp " + formattedTax;

            // Hitung total (subtotal + pajak)
            const total = subtotal + tax;

            // Format total dengan separator ribuan
            const formattedTotal = new Intl.NumberFormat('id-ID').format(total);

            // Update tampilan total
            document.querySelector('.total td:last-child').textContent = "Rp " + formattedTotal;
        }

        // Inisialisasi subtotal, pajak, dan total ketika halaman dimuat
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
