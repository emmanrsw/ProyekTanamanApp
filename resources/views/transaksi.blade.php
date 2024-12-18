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
    <meta name="csrf-token" content="{{ csrf_token() }}">
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


    .main-content {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        padding: 0 20px;
        /* Menambahkan padding untuk jarak di sisi kanan dan kiri */
    }

    .product-details,
    .summary {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-details {
        width: 58%;
        /* Mengurangi sedikit lebar untuk memberikan ruang antar elemen */
    }

    .summary {
        width: 38%;
        /* Menyesuaikan agar elemen tidak terlalu melebar */
        margin-left: 20px;
        /* Memberikan jarak antara summary dengan product-details */
    }

    .product-details h2,
    .summary h2 {
        font-size: 18px;
        margin-bottom: 20px;
    }

    .product-details table {
        width: 100%;
        border-collapse: collapse;
    }

    .product-details table th,
    .product-details table td {
        padding: 10px;
        text-align: left;
    }

    .product-details table th {
        background-color: #f1f1f1;
    }

    .product-details table td {
        border-bottom: 1px solid #f1f1f1;
    }

    .product-details .total {
        font-size: 24px;
        color: #FF5722;
        text-align: right;
    }

    .payment-methods {
        margin-top: 20px;
    }

    .payment-methods h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .payment-methods label {
        display: block;
        margin-bottom: 10px;
    }

    .payment-methods input {
        margin-right: 10px;
    }

    .payment-methods .note {
        font-size: 12px;
        color: #666;
        margin-top: 10px;
    }

    .payment-methods .btn {
        display: block;
        width: 100%;
        padding: 15px;
        background-color: #4CAF50;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .summary .shipping-info,
    .summary .payment-card {
        margin-bottom: 20px;
    }

    .summary .shipping-info h3,
    .summary .payment-card h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .summary .shipping-info p,
    .summary .payment-card p {
        font-size: 14px;
        color: #666;
    }

    .summary .payment-card img {
        margin-right: 10px;
    }

    .payment-card label {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .payment-card label img {
        margin-left: 10px;
    }

    .payment-card {
        display: flex;
        flex-direction: column;
    }

    footer {
        margin-top: 40px;
        padding: 20px 0;
        background-color: #fff;
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

    .popup-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .popup-content {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 10000;
        text-align: center;
        width: 300px;
    }

    .popup-content h2 {
        margin-bottom: 15px;
    }

    .popup-content .btn-close {
        position: absolute;
        /* Agar tombol posisinya bisa diatur */
        top: 10px;
        /* Jarak dari atas */
        right: 10px;
        /* Jarak dari kanan */
        background-color: #dc3545;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 50%;
        font-size: 20px;
        /* Ukuran font untuk tombol X */
        font-weight: bold;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        /* Menghilangkan garis bawah */

    }

    .popup-content .btn-close:hover {
        background-color: #c82333;
    }


    .action-buttons {
        display: flex;
        /* Menggunakan flexbox untuk menata tombol secara bersebelahan */
        gap: 10px;
        /* Memberikan jarak antara tombol-tombol */
        margin-top: 20px;
        /* Menambahkan margin di atas tombol */
    }

    .action-buttons .btn {
        padding: 10px 20px;
        /* Padding pada tombol */
        border-radius: 5px;
        /* Menambahkan border radius pada tombol */
        text-decoration: none;
        /* Menghilangkan garis bawah pada link */
    }

    .action-buttons .btn-primary {
        background-color: #007bff;
        /* Warna latar belakang tombol */
        color: white;
        /* Warna teks tombol */
        border: none;
        /* Menghapus border tombol */
    }

    .action-buttons .btn-primary:hover {
        opacity: 0.8;
        /* Efek hover: sedikit transparan saat di-hover */
    }
</style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
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
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#cartModal">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <!-- User Icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    <a href="{{ route('pelanggan.profile') }}" class="nav-link">
                        <i class="fa fa-user"></i> {{ session('usernameCust') }}
                    </a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Session Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="main-content">
        <div class="product-details">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Tanaman</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tanamanDipilih as $tanaman)
                        <tr>
                            <td>{{ $tanaman->tanaman->namaTanaman }}</td> <!-- Mengambil nama tanaman dari relasi -->
                            <td>{{ number_format($tanaman->harga_satuan, 0, ',', '.') }}</td> <!-- Format harga satuan -->
                            <td>{{ $tanaman->jumlah }}</td>
                            <td>{{ number_format($tanaman->harga_satuan * $tanaman->jumlah, 0, ',', '.') }}</td>
                            <!-- Total harga -->
                        </tr>
                    @endforeach
                </tbody>
                <!-- Tampilkan subtotal, pajak, dan total -->
                <tr>
                    <td colspan="3"><strong>Subtotal</strong></td>
                    <td>{{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Pajak (5%)</strong></td>
                    <td>{{ number_format($tax, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td>{{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </table>

            <div class="payment-methods">
                <h3>Direct Bank Transfer</h3>
                <label>
                    <input type="radio" name="payment" checked /> Direct Bank Transfer
                </label>
                <p class="note">
                    Silakan lakukan pembayaran langsung ke rekening bank kami. Harap gunakan ID Pesanan Anda sebagai
                    referensi pembayaran. Pesanan Anda tidak akan dikirimkan sampai dana kami terima di rekening.
                </p>

                <form action="{{ route('transaksi.simpan') }}" method="POST" id="formTransaksi">
                    @csrf
                    <!-- Data transaksi -->
                    <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" name="pajak" value="{{ $tax }}">
                    <input type="hidden" name="harga_total" value="{{ $total }}">
                    <input type="hidden" name="alamat_kirim" value="{{ Auth::user()->alamatCust }}">
                    <input type="hidden" name="metode_bayar" value="Direct Bank Transfer">

                    <!-- Data detail transaksi -->
                    @foreach ($tanamanDipilih as $tanaman)
                        <input type="hidden" name="tanaman[{{ $loop->index }}][idTanaman]"
                            value="{{ $tanaman->idTanaman }}">
                        <input type="hidden" name="tanaman[{{ $loop->index }}][namaTanaman]"
                            value="{{ $tanaman->namaTanaman }}">
                        <input type="hidden" name="tanaman[{{ $loop->index }}][jumlah]" value="{{ $tanaman->jumlah }}">
                        <input type="hidden" name="tanaman[{{ $loop->index }}][harga_satuan]"
                            value="{{ $tanaman->harga_satuan }}">
                        <input type="hidden" name="tanaman[{{ $loop->index }}][subtotal]"
                            value="{{ $tanaman->harga_satuan * $tanaman->jumlah }}">
                    @endforeach

                    <button type="submit" class="btn" id="btnBayar">BAYAR SEKARANG</button>
                </form>

                <!-- Tambahkan SweetAlert -->
                <script>
                    document.getElementById('btnBayar').addEventListener('click', function (event) {
                        // Mencegah tombol melakukan submit atau redirect default
                        event.preventDefault();

                        // Menampilkan konfirmasi "Apakah Anda Yakin?"
                        Swal.fire({
                            title: "Apakah Anda Yakin?",
                            text: "Anda akan melakukan pembayaran untuk pesanan ini.",
                            icon: "question",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "YA",
                            cancelButtonText: "TIDAK",
                            allowOutsideClick: false, // Mencegah klik luar menutup alert
                            allowEscapeKey: false    // Mencegah tombol Esc menutup alert
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jika pengguna memilih "YA", tampilkan pesan transaksi berhasil
                                Swal.fire({
                                    title: "Transaksi Berhasil!",
                                    text: "Terima kasih atas pembayaran Anda!",
                                    icon: "success",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Lihat Pesanan",
                                    cancelButtonText: "Tutup",
                                    allowOutsideClick: false, // Mencegah klik luar menutup alert
                                    allowEscapeKey: false    // Mencegah tombol Esc menutup alert
                                }).then((result) => {
                                    // Selalu submit form transaksi
                                    document.getElementById('formTransaksi').submit();

                                    // Setelah form disubmit, lakukan redirect sesuai dengan pilihan pengguna
                                    if (result.isConfirmed) {
                                        // Redirect ke halaman pesanan jika tombol "Lihat Pesanan" diklik
                                        setTimeout(function () {
                                            window.location.href = "{{ route('pesanan') }}"; // Ganti dengan route pesanan Anda
                                        }, 500); // Menunggu sedikit waktu setelah submit form
                                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                                        // Pastikan form disubmit terlebih dahulu sebelum redirect ke halaman home
                                        setTimeout(function () {
                                            document.getElementById('formTransaksi').submit(); // Pastikan form tetap disubmit
                                            window.location.href = "{{ route('home') }}"; // Redirect ke halaman utama setelah data disubmit
                                        }, 500); // Memberikan waktu untuk submit form sebelum redirect
                                    }
                                });
                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                // Jika pengguna memilih "TIDAK", lakukan pengalihan ke halaman home
                                window.location.href = "{{ route('home') }}";
                            }
                        });
                    });
                </script>
            </div>
        </div>
        <div class="summary">
            <div class="shipping-info">
                <h3>Shipping Information</h3>
                <p>
                    {{ $alamatPelanggan }} <!-- Menampilkan alamat pengiriman -->
                </p>
                <a href="{{ route('pelanggan.profile') }}">Change Address <i class="fas fa-pencil-alt"></i></a>
            </div>

            <div class="payment-card">
                <h3>Select Your Payment Card</h3>
                <label>
                    <input type="radio" name="card" checked />
                    <img src="https://storage.googleapis.com/a1aa/image/EBXiwn3HbkJcN9k0yCiMeNvBjCLLJ1g6RBr0SslU0EGWuw4JA.jpg"
                        alt="Visa logo" width="30" height="20" />
                    Visa
                </label>
                <label>
                    <input type="radio" name="card" />
                    <img src="https://storage.googleapis.com/a1aa/image/WABOH5SCRKItDtUViI1TbYIgohgAqCJwXUfVJqJggAVVuw4JA.jpg"
                        alt="MasterCard logo" width="30" height="20" />
                    MasterCard
                </label>
                <label>
                    <input type="radio" name="card" />
                    <img src="https://storage.googleapis.com/a1aa/image/J9aaATYV4xadIZwuJnr9f6fUN5iRMM9iwdQap2iCkGGpchxTA.jpg"
                        alt="American Express logo" width="30" height="20" />
                    American Express
                </label>
                <label>
                    <input type="radio" name="card" />
                    <img src="https://storage.googleapis.com/a1aa/image/VPPaTZOU0s5JNFb94bQz702xYGiUdGcHvfwAkJab0zmVuw4JA.jpg"
                        alt="bKash logo" width="30" height="20" />
                    BKash
                </label>
            </div>
        </div>
    </div>


    <footer>
        <div class="footer-links">
            <div>
                <h4>COMPANY INFO</h4>
                <a href="#">About Us</a>
                <a href="#">Latest Posts</a>
                <a href="#">Contact Us</a>
            </div>
            <div>
                <h4>HELP LINKS</h4>
                <a href="#">Tracking</a>
                <a href="#">Order Status</a>
                <a href="#">Delivery</a>
                <a href="#">Shipping Info</a>
                <a href="#">FAQ</a>
            </div>
            <div>
                <h4>USEFUL LINKS</h4>
                <a href="#">Special Offers</a>
                <a href="#">Gift Cards</a>
                <a href="#">Advertising</a>
                <a href="#">Terms of Use</a>
            </div>
        </div>
        <p>
            © 2020 Tanam.in eCommerce<br />
            Privacy Policy | Terms & Conditions
        </p>
    </footer>
    <script>
        function showPopup() {

            document.getElementById('popupOverlay').style.display = 'block';
            document.getElementById('popupContent').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popupOverlay').style.display = 'none';
            document.getElementById('popupContent').style.display = 'none';
        }
    </script>
    </div>
</body>

</html>