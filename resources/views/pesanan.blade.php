<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: 'Poppins';
        }

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

        .navbar-nav .nav-link {
            color: #333;
            margin-right: 20px;
        }

        .banner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f5f7f0;
            padding: 80px 40px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 20px;
            height: 100px;
            border-radius: 10px;
        }

        .icon-container {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            transition: background-color 0.3s ease;
        }

        .icon-container i {
            font-size: 2rem;
        }

        .icon-container .text {
            font-size: 1.5rem;
        }

        .btn-custom {
            background-color: #4B553D;
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1rem;
            border: none;
        }

        .btn-custom:hover {
            background-color: gray;
        }

        /* Navbar Icons */
        .navbar-icons {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .topnav {
            position: relative;
        }

        #myLinks {
            position: absolute;
            top: 60px;
            right: 0;
            background-color: #4B553D;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
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

        #barangAda {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        #barangTidakAda {
            background-color: #dc3545;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        #belanjaBtn.hidden {
            display: none;
        }

        #sedangDikemas,
        #dikirim,
        #selesai {
            opacity: 0.5;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        #sedangDikemas.active,
        #dikirim.active,
        #selesai.active {
            opacity: 1;
            transform: scale(1.1);
        }

        .icon-container.active {
            color: #28a745;
        }

        #pesananSedangDikemas,
        #pesananDikirim,
        #pesananSelesai {
            display: none;
        }

        .icon-container[style="pointer-events: none;"] {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .card {
            display: flex;
            flex-direction: row;
            /* Gambar di kiri dan konten di kanan */
            align-items: center;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }

        .card img {
            max-width: 150px;
            /* Ukuran gambar kiri */
            height: auto;
            object-fit: cover;
        }

        .card-body {
            padding: 15px;
            flex: 1;
        }

        .card h5 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .card p {
            margin: 5px 0;
            font-size: 14px;
        }

        .card-container {
            display: flex;
            flex-direction: column;
            /* Card akan menurun satu per satu */
            gap: 15px;
        }


        .card-footer .btn {
            background-color: #4B553D;
            color: white;
        }

        .card-footer .btn:hover {
            background-color: gray;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#pesanan">Pesanan Saya</a></li>
            </ul>
        </div>
    </nav>
    <section class="banner">
    <!-- Sedang Dikemas -->
    <div class="icon-container" id="sedangDikemas" onclick="toggleSection('sedangDikemas')"
        @if ($sedangDikemas->isEmpty() && $dikirim->isEmpty() && $selesai->isEmpty()) style="pointer-events: none;" @endif>
        <i class="fa-solid fa-box-open"></i>
        <span class="text">Sedang dikemas</span>
    </div>

    <!-- Dikirim -->
    <div class="icon-container" id="dikirim" onclick="toggleSection('dikirim')"
        @if ($sedangDikemas->isEmpty() && $dikirim->isEmpty() && $selesai->isEmpty()) style="pointer-events: none;" @endif>
        <i class="fa-solid fa-truck-fast"></i>
        <span class="text">Dikirim</span>
    </div>

    <!-- Selesai -->
    <div class="icon-container" id="selesai" onclick="toggleSection('selesai')"
        @if ($sedangDikemas->isEmpty() && $dikirim->isEmpty() && $selesai->isEmpty()) style="pointer-events: none;" @endif>
        <i class="fa-solid fa-circle-check"></i>
        <span class="text">Selesai</span>
    </div>
</section>

<!-- Teks untuk mengarahkan user -->
<h2 id="instruction" style="text-align: center; font-size: 20px; margin-top:15px; ">Klik button diatas ini untuk melihat pesanan!</h2>

<!-- Tampilkan Konten untuk Sedang Dikemas -->
<div id="tabelSedangDikemas" class="hidden card-container">
    @if ($sedangDikemas->isNotEmpty())
    @foreach ($sedangDikemas as $transaksi)
    @foreach ($transaksi->details as $detail)
    <div class="card">
        <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
            alt="Gambar Tanaman {{ $detail->gambar }}"
            onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
        <div class="card-body">
            <h5>{{ $detail->tanaman->namaTanaman }}</h5>
            <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
            <p>Jumlah: {{ $detail->jumlah }}</p>
            <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
        </div>
    </div>
    @endforeach
    @endforeach
    @else
    <div class="text-center w-100">Tidak ada tanaman yang sedang dikemas.</div>
    @endif
</div>

    <!-- Tampilkan Konten untuk Dikirim -->
    <div id="tabelDikirim" class="hidden card-container">
        @if ($dikirim->isNotEmpty())
        @foreach ($dikirim as $transaksi)
        @foreach ($transaksi->details as $detail)
        <div class="card">
            <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                alt="Gambar Tanaman {{ $detail->gambar }}"
                onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
            <div class="card-body">
                <h5>{{ $detail->tanaman->namaTanaman }}</h5>
                <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                <p>Jumlah: {{ $detail->jumlah }}</p>
                <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
        @endforeach
        @else
        <div class="text-center w-100">Tidak ada tanaman yang sedang dikirim.</div>
        @endif
    </div>

    <!-- Tampilkan Konten untuk Selesai -->
    <div id="tabelSelesai" class="hidden card-container">
        @if ($selesai->isNotEmpty())
        @foreach ($selesai as $transaksi)
        @foreach ($transaksi->details as $detail)
        <div class="card">
            <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                alt="Gambar Tanaman {{ $detail->gambar }}"
                onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
            <div class="card-body">
                <h5>{{ $detail->tanaman->namaTanaman }}</h5>
                <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                <p>Jumlah: {{ $detail->jumlah }}</p>
                <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
        @endforeach
        @else
        <div class="text-center w-100">Tidak ada tanaman yang selesai.</div>
        @endif
    </div>
    <!-- Tombol Bayar Sekarang jika tidak ada transaksi -->
    @if ($sedangDikemas->isEmpty() && $dikirim->isEmpty() && $selesai->isEmpty())
    <div class="text-center mt-4">
        <p>Transaksi Belum dilalukan! Silahkan klik di bawah ini</p>
        <a href="{{ route('listTanaman') }}" class="btn btn-primary">Belanja Sekarang</a>
    </div>
    @endif
</body>
<script>
    function toggleSection(section) {
        // Reset semua tabel dan ikon
        const sections = ['sedangDikemas', 'dikirim', 'selesai'];
        sections.forEach(sec => {
            // Menyembunyikan tabel yang tidak relevan
            document.getElementById('tabel' + capitalizeFirstLetter(sec)).style.display = 'none';
            // Menghapus kelas 'active' dari ikon
            document.getElementById(sec).classList.remove('active');
        });

        // Menampilkan tabel yang sesuai dengan status yang dipilih
        document.getElementById('tabel' + capitalizeFirstLetter(section)).style.display = 'block';
        // Menambahkan kelas 'active' pada ikon yang diklik
        document.getElementById(section).classList.add('active');
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    
    function toggleSection(section) {
        // Menyembunyikan teks instruksi ketika tombol diklik
        document.getElementById('instruction').style.display = 'none';
        
        // Menampilkan konten sesuai section yang dipilih
        if (section === 'sedangDikemas') {
            document.getElementById('tabelSedangDikemas').classList.remove('hidden');
        } else {
            document.getElementById('tabelSedangDikemas').classList.add('hidden');
        }
    }
</script>

</html>