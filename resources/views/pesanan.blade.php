@extends('layout.navbar')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    /* Card Styling */
    .card {
        display: flex;
        flex-direction: row;
        align-items: left;
        /* Agar isi card sejajar secara horizontal */
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        width: 100%;
        padding: 10px;
    }

    .card-content {
        display: flex;
        flex-direction: row;
        /* Menyusun gambar di kiri dan konten di kanan secara horizontal */
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 5px;
    }

    .card:hover {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Efek hover untuk meningkatkan interaktivitas */
    }

    .card img {
        width: 120px;
        /* Ukuran gambar yang konsisten */
        height: 120px;
        /* Sesuaikan tinggi agar proporsional */
        object-fit: cover;
        /* Agar gambar tetap terpotong dengan proporsional */
        margin-right: 15px;
        /* Memberikan jarak antar gambar dan informasi */
        flex-shrink: 0;
        /* Gambar tidak akan mengecil jika konten di kanan terlalu besar */
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding: 15px;
        flex-grow: 1;
        /* Membuat card-body mengisi sisa ruang */
    }

    .card h5 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
        color: #4B553D;
    }

    .card-info {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        margin-left: 15px;
        /* Memberikan jarak antar gambar dan informasi */
        flex-grow: 1;
        /* Agar informasi mengisi sisa ruang */
    }

    .card-info h6 {
        margin-bottom: 5px;
        font-size: 14px;
        font-weight: normal;
    }

    .card-info p {
        margin: 3px 0;
        font-size: 14px;
    }

    .card p {
        margin: 3px 0;
        font-size: 14px;
        color: #6c757d;
    }

    /* Container for all cards */
    .card-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Add spacing and a clear structure for the section */
    #tabelSedangDikemas,
    #tabelDikirim,
    #tabelSelesai {
        display: none;
    }

    /* Styling for each section's header */
    .banner {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #f5f7f0;
        /* padding: 10px 40px; */
        margin-top: 20px;
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
        text-align: center;
    }

    .icon-container i {
        font-size: 2rem;
        margin-bottom: 8px;
    }

    .icon-container .text {
        font-size: 1.2rem;
        color: #6c757d;
    }

    .icon-container.active {
        color: #4B553D;
    }

    /* Hint message */
    #hintMessage {
        background-color: #f8f9fa;
        border: 1px dashed #ccc;
        padding: 20px;
        margin: 20px auto;
        border-radius: 8px;
        font-size: 1rem;
        color: #4B553D;
        max-width: 500px;
    }

    /* General Styling for the page */
    .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
</style>

@section('content')
    <div class="container-fluid p-0">
        <!-- Banner -->
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

        <!-- Konten Sedang Dikemas -->
        <div id="tabelSedangDikemas" class="hidden card-container">
            @if ($sedangDikemas->isNotEmpty())
                @foreach ($sedangDikemas as $transaksi)
                    <div class="card">
                        <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                        <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                        <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                        <!-- Gambar Tanaman -->
                        @foreach ($transaksi->details as $detail)
                            <div class="card-content">
                                <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                    alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                    onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                                <!-- Informasi Transaksi -->
                                <div class="card-info">
                                    <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                    <h6>Jumlah: {{ $detail->jumlah }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="text-center w-100">Tidak ada tanaman yang sedang dikemas.</div>
            @endif
        </div>

        <!-- Konten Dikirim -->
        <div id="tabelDikirim" class="hidden card-container">
            @if ($dikirim->isNotEmpty())
                @foreach ($dikirim as $transaksi)
                    <div class="card">
                        <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                        <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                        <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                        @foreach ($transaksi->details as $detail)
                            <div class="card-content">
                                <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                    alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                    onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                                <div class="card-info">
                                    <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                    <h6>Jumlah: {{ $detail->jumlah }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="text-center w-100">Tidak ada tanaman yang sedang dikirim.</div>
            @endif
        </div>

        <!-- Konten Selesai -->
        <div id="tabelSelesai" class="hidden card-container">
            @if ($selesai->isNotEmpty())
                @foreach ($selesai as $transaksi)
                    <div class="card">
                        <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                        <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                        <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                        @foreach ($transaksi->details as $detail)
                            <div class="card-content">
                                <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                    alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                    onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                                <div class="card-info">
                                    <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                    <h6>Jumlah: {{ $detail->jumlah }}</h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
        @else
            <!-- Pesan Petunjuk -->
            <div id="hintMessage" class="text-center mt-4">
                <p>Silakan klik button di atas untuk melihat status transaksi Anda.</p>
            </div>
        @endif
    </div>

    <script>
        function toggleSection(section) {
            const sections = ['sedangDikemas', 'dikirim', 'selesai'];
            sections.forEach(sec => {
                document.getElementById('tabel' + capitalizeFirstLetter(sec)).style.display = 'none';
                document.getElementById(sec).classList.remove('active');
            });

            document.getElementById('tabel' + capitalizeFirstLetter(section)).style.display = 'block';
            document.getElementById(section).classList.add('active');

            const hintMessage = document.getElementById('hintMessage');
            if (hintMessage) {
                hintMessage.style.display = 'none';
            }
        }

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
@endsection
