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
        /* Ensure there is no margin at the bottom */
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: 700;
        color: #000;
    }

    /* untuk tulisan .in */
    .navbar-brand .highlight {
        color: #4B553D;
    }

    .navbar-nav .nav-link {
        color: #333;
        margin-right: 20px;
    }

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

    .topnav {
        position: relative;
    }

    #myLinks {
        position: absolute;
        top: 60px;
        /* Sesuaikan dengan tinggi navbar Anda */
        right: 0;
        /* Memposisikan menu di sisi kanan */
        background-color: #333;
        border-radius: 5px;
        /* Menambahkan sudut membulat */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Menambahkan bayangan */
        z-index: 1000;
        /* Pastikan menu berada di atas elemen lain */
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

    #recent-search-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .clock-icon {
        margin-left: -18px;
        margin-right: 8px;
        vertical-align: baseline;
        /* Menyelaraskan ikon dengan teks secara vertikal */
    }

    .search-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .search-header .recent-search-item {
        flex-grow: 1;
        text-decoration: none;
        color: #333;
        font-size: 15px;
    }

    .search-header .delete-recent {
        margin-left: auto;
        text-decoration: none;
        color: red;
        font-size: 15px;
    }

    .search-header .delete-recent:hover {
        text-decoration: underline;
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Pesanan Saya</a></li>
            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon in Navbar -->
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>

            <!-- Search Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="searchModalLabel">Pencarian</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Input untuk pencarian -->
                            <input type="text" id="searchQuery" class="form-control" placeholder="Cari tanaman...">
                            <div class="recent-searches mt-3">
                                <h6>Pencarian Terbaru</h6>
                                <ul id="recent-search-list">
                                    <!-- Recent search items will be dynamically added here by JavaScript -->
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="searchBtn">Cari</button>
                        </div>
                    </div>
                </div>
            </div>

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
                    @if(Auth::guard('pelanggan')->check())
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

    <!-- Search Modal TIDAK TERPAKAI-->
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

    <!-- Banner Section -->
    <section class="banner">
        <div class="banner-text">
            <h1>Bonsai</h1>
            <p>Temukan semua yang perlu Anda ketahui tentang tanaman Anda, perlakukan mereka dengan baik dan mereka akan
                menjaga Anda.</p>
            <a href="{{ Auth::guard('pelanggan')->check() ? route('listTanaman') : route('register') }}" class="btn-custom">
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

        // function displayRecentSearches() {
        //     let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

        //     const recentSearchList = document.getElementById('recent-search-list');
        //     recentSearchList.innerHTML = ''; // Clear the list before adding

        //     recentSearches.forEach(query => {
        //         const li = document.createElement('li');
        //         li.innerHTML = `
        //         <a href="#" class="recent-search-item" data-query="${query}">${query}</a>
        //         <a href="#" class="delete-recent" data-query="${query}">Hapus</a>
        //     `;
        //         recentSearchList.appendChild(li);
        //     });
        // }

        // Event listener untuk menangani klik pada pencarian
        document.addEventListener('click', function(e) {
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
        document.getElementById('searchBtn').addEventListener('click', function() {
            const query = document.getElementById('searchQuery').value.trim();
            if (query) {
                saveRecentSearch(query); // Simpan pencarian ke localStorage
                // Lakukan pencarian berdasarkan query (bisa dikirim ke server atau lakukan pencarian di frontend)
                window.location.href = `{{ route('searchTanaman') }}?query=${encodeURIComponent(query)}`; // Redirect ke halaman pencarian
            }
        });

        // Menampilkan recent searches saat modal dibuka
        window.onload = function() {
            // Mengosongkan input pencarian saat halaman dimuat
            document.getElementById('searchQuery').value = "";
            displayRecentSearches(); // Menampilkan daftar pencarian terbaru saat halaman dimuat
        };
    </script>

</body>

</html>