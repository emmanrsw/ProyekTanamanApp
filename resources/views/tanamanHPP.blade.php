@extends('layout.navbar')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>
    <script>
        // Menyimpan pencarian terbaru ke localStorage
        function saveRecentSearch(query) {
            let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

            // Menambahkan query ke array recent search, dan pastikan tidak ada duplikasi
            if (!recentSearches.includes(query)) {
                recentSearches.unshift(query); // Menambahkan di depan array
            }

            // Menyimpan kembali ke localStorage, dan bataskan hanya 5 pencarian terbaru
            if (recentSearches.length > 5) {
                recentSearches.pop(); // Hapus elemen terakhir jika lebih dari 5
            }

            localStorage.setItem('recent_searches', JSON.stringify(recentSearches));
            displayRecentSearches(); // Refresh list of recent searches
        }

        // Menampilkan recent searches dari localStorage
        function displayRecentSearches() {
            let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

            const recentSearchList = document.getElementById('recent-search-list');
            recentSearchList.innerHTML = ''; // Clear the list before adding

            recentSearches.forEach(query => {
                const li = document.createElement('li');
                li.innerHTML = `
                <li class="search-header">
                    <a href="#" class="recent-search-item" data-query="${query}">
                        <i class="fa-solid fa-clock-rotate-left clock-icon"></i> 
                        ${query}
                    </a>
                    <a href="#" class="delete-recent" data-query="${query}">Hapus</a>
                </li>
                `;
                recentSearchList.appendChild(li);
            });
        }

        // Event listener untuk menangani klik pada pencarian
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('recent-search-item')) {
                e.preventDefault();
                const query = e.target.getAttribute('data-query');
                document.getElementById('searchQuery').value = query;
            }

            if (e.target && e.target.classList.contains('delete-recent')) {
                e.preventDefault();
                const query = e.target.getAttribute('data-query');
                removeRecentSearch(query);
            }
        });

        // Menghapus pencarian dari localStorage
        function removeRecentSearch(query) {
            let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

            // Menghapus query dari array recent search
            recentSearches = recentSearches.filter(item => item !== query);
            localStorage.setItem('recent_searches', JSON.stringify(recentSearches));
            displayRecentSearches(); // Refresh list after deletion
        }

        // Menangani pencarian baru dan menyimpan pencarian ke localStorage
        document.getElementById('searchBtn').addEventListener('click', function () {
            const query = document.getElementById('searchQuery').value.trim();
            if (query) {
                saveRecentSearch(query); // Simpan pencarian ke localStorage
                // Lakukan pencarian berdasarkan query (bisa dikirim ke server atau lakukan pencarian di frontend)
                window.location.href =
                    `{{ route('searchTanaman') }}?query=${encodeURIComponent(query)}`; // Redirect ke halaman pencarian
            }
        });

        // Menampilkan recent searches saat modal dibuka
        window.onload = function () {
            // Mengosongkan input pencarian saat halaman dimuat
            document.getElementById('searchQuery').value = "";
            displayRecentSearches(); // Menampilkan daftar pencarian terbaru saat halaman dimuat
        };
    </script>
</div>
@endsection