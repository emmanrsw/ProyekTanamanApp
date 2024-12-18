@extends('layout.navbar')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    /* Banner Section */
    .banner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f5f7f0;
        padding: 80px 100px;
        margin: 0;
        width: 100%;
        /* Mengatur lebar banner 100% dari elemen induknya */
        height: 400px;
        /* Menentukan tinggi spesifik */
    }

    .banner h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #243a56;
    }

    .banner p {
        font-size: 1.2rem;
        margin-top: 15px;
        margin-bottom: 30px;
        color: #555;
    }

    .banner img {
        max-width: 250px;
        height: auto;
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

    /* Plant Gallery */
    .plant-gallery {
        display: flex;
        overflow-x: scroll;
        scroll-behavior: smooth;
        padding: 10px;
        white-space: nowrap;
    }

    .plant-card {
        display: inline-block;
        margin-right: 15px;
        border: 1px solid #ccc;
        /* Menambahkan border di sekeliling kotak */
        border-radius: 10px;
        /* Membuat sudut sedikit membulat */
        padding: 10px;
        /* Memberikan ruang antara gambar dan tepi kotak */
        background-color: #fff;
        /* Warna latar belakang kotak */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Opsional: bayangan untuk efek 3D */
    }

    .plant-card img {
        width: 100%;
        /* Membuat gambar responsif dan sesuai ukuran asli */
        height: auto;
        /* Menjaga rasio gambar */
        max-width: 150px;
        /* Membatasi ukuran maksimum gambar */
        border-radius: 10px;
        /* Opsional: membuat gambar sedikit membulat */
    }

    .plant-card h3 {
        font-size: 14px;
        /* Ukuran teks lebih kecil */
        margin-top: 10px;
        font-weight: normal;
        color: #333;
    }
</style>

@section('content')
<div class="container-fluid p-0">
    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-text">
            <h1>Bonsai</h1>
            <p>Temukan semua yang perlu Anda ketahui tentang tanaman Anda, perlakukan mereka dengan baik dan mereka akan
                menjaga Anda.</p>
            <a href="{{ Auth::guard('pelanggan')->check() ? route('listTanaman') : route('register') }}"
                class="btn-custom">
                Jelajahi Lebih Lanjut
            </a>
        </div>
        <div class="banner-image">
            <img src="Img/bonsai.png" alt="Bonsai" />
        </div>
    </section>

    <!-- Plant Gallery -->
    <section class="plant-gallery">
        <div class="plant-card">
            <img src="Img/birds.png" alt="birds">
            <h3>Sansevieria Trifasciata</h3>
        </div>
        <div class="plant-card">
            <img src="Img/pilee.png" alt="pilea">
            <h3>Pilea Peperoimedes</h3>
        </div>
        <div class="plant-card">
            <img src="Img/plant1.png" alt="aglo">
            <h3>Aglonema KomKom</h3>
        </div>
        <div class="plant-card">
            <img src="Img/pink.png" alt="Anthu">
            <h3>Anthurium Andra</h3>
        </div>
        <div class="plant-card">
            <img src="Img/sily.png" alt="cala">
            <h3>Pink Calla Lily</h3>
        </div>
    </section>
</div>
@endsection