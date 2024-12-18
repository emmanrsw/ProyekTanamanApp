@extends('layout.navbar')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
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

#barangAda {
    background-color: #4B553D;
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
    color: #4B553D;
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
    align-items: left;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
    
}

.card img {
    max-width: 120px;
        margin-right: 15px;
        object-fit: cover;
        height: auto;
}

.card-body {
    display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 15px;
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

.hidden {
    display: none;
}
.card-content {
    display: flex; /* Menjadikan flexbox untuk sejajar horizontal */
    align-items: left; /* Vertikal tengah */
}
#hintMessage {
    background-color: #f8f9fa; /* Warna latar belakang abu-abu terang */
    border: 1px dashed #ccc; /* Border berupa garis putus-putus */
    padding: 20px;
    margin: 20px auto;
    border-radius: 8px;
    font-size: 1rem;
    color: #4B553D;
    max-width: 500px; /* Lebar maksimum */
}
.btn-primary{
    background-color: #4B553D;
}
</style>

@section('content')
<div class="container-fluid p-0">
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

    

    <!-- Tampilkan Konten untuk Sedang Dikemas -->
    <div id="tabelSedangDikemas" class="hidden card-container">
    @if ($sedangDikemas->isNotEmpty())
        @foreach ($sedangDikemas as $transaksi)
            <!-- Mulai kartu untuk setiap transaksi -->
            <div class="card">
                <div class="card-body">
                    <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                    <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                    <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                    @foreach ($transaksi->details as $detail)
                        <div class="card-content">
                            <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                 alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                 onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                            <div>
                                <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                <p>Jumlah: {{ $detail->jumlah }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- End kartu untuk transaksi -->
        @endforeach
    @else
        <div class="text-center w-100">Tidak ada tanaman yang sedang dikemas.</div>
    @endif
</div>

<div id="tabelDikirim" class="hidden card-container">
    @if ($dikirim->isNotEmpty())
        @foreach ($dikirim as $transaksi)
            <div class="card">
                <div class="card-body">
                    <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                    <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                    <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                    @foreach ($transaksi->details as $detail)
                        <div class="card-content">
                            <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                 alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                 onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                            <div>
                                <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                <p>Jumlah: {{ $detail->jumlah }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center w-100">Tidak ada tanaman yang sedang dikirim.</div>
    @endif
</div>

<div id="tabelSelesai" class="hidden card-container">
    @if ($selesai->isNotEmpty())
        @foreach ($selesai as $transaksi)
            <div class="card">
                <div class="card-body">
                    <h5>Transaksi ID: {{ $transaksi->idTJual }}</h5>
                    <p>Tanggal Pembelian: {{ $transaksi->tglTJual }}</p>
                    <p>Total Harga: Rp {{ number_format($transaksi->harga_total, 0, ',', '.') }}</p>
                    @foreach ($transaksi->details as $detail)
                        <div class="card-content">
                            <img src="{{ asset('images/' . $detail->tanaman->gambar) }}"
                                 alt="Gambar Tanaman {{ $detail->tanaman->gambar }}"
                                 onerror="this.src='https://via.placeholder.com/300x200.png?text=Gambar+Tidak+Tersedia'">
                            <div>
                                <h6>{{ $detail->tanaman->namaTanaman }}</h6>
                                <p>Jumlah: {{ $detail->jumlah }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
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

        // Sembunyikan pesan petunjuk setelah klik
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
