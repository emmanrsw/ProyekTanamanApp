<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanam.in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
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

    .nav-link {
        color: #000;
        /* Warna default */
    }

    .nav-link.active {
        color: #4B553D;
        /* Warna saat aktif */
        font-weight: bold;
    }

    .topnav {
        position: relative;
    }

    #myLinks {
        position: absolute;
        top: 60px;
        right: 10px;
        background-color: #4B553D;
        border-radius: 5px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        font-size: 14px;
        padding: 10px 10px;
    }

    #myLinks a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        margin-left: 0;
        line-height: 1.5;
    }

    #myLinks a:hover {
        background-color: #ddd;
        color: black;
        border-radius: 5px;
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

    .btn-primary {
        background-color: #4B553D;
        /* Ganti dengan warna yang diinginkan */
        border-color: #4B553D;
        /* Ganti dengan warna yang diinginkan */
    }

    .btn-primary:hover {
        background-color: gray;
        /* Ganti dengan warna yang lebih gelap saat tombol dihover */
        border-color: gray;
        /* Ganti dengan warna yang lebih gelap saat tombol dihover */
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand"
            href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('login.login') }}"><span>Tanam</span><span
                class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('login.login') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('listTanaman') ? 'active' : '' }}"
                        href="{{ Auth::guard('pelanggan')->check() ? route('listTanaman') : route('login.login') }}">
                        Tanaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}"
                        href="{{ Auth::guard('pelanggan')->check() ? route('kontak') : route('login.login') }}">
                        Kontak
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tentangKami') ? 'active' : '' }}"
                        href="{{ Auth::guard('pelanggan')->check() ? route('tentangKami') : route('login.login') }}">
                        Tentang Kami
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pesanan') ? 'active' : '' }}"
                        href="{{ Auth::guard('pelanggan')->check() ? route('pesanan') : route('login.login') }}">
                        Pesanan Saya
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-icons d-flex align-items-center">
            <!-- Search Icon in Navbar -->
            <a href="#" class="nav-link position-relative" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>

            <!-- Search Modal -->
            <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
                aria-hidden="true">
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
            <a href="{{ route('cart') }}" class="nav-link position-relative">
                <i class="fa fa-shopping-cart"></i>
            </a>

            <!-- User Icon -->
            <div class="topnav position-relative">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    @if (Auth::guard('pelanggan')->check() && Auth::guard('pelanggan')->user()->gambarCust)
                    <!-- Jika pengguna memiliki gambar profil -->
                    <img src="{{ asset('uploads/' . Auth::guard('pelanggan')->user()->gambarCust) }}" alt="User Profile"
                        class="rounded-circle" width="30" height="30">
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
                    <a href="{{ route('otp.form') }}" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                    @else
                    <a href="{{ route('login.login') }}" class="nav-link">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content area -->
    <div class="container-fluid p-0">
        @yield('content')
    </div>
</body>

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
            window.location.href =
                `{{ route('searchTanaman') }}?query=${encodeURIComponent(query)}`; // Redirect ke halaman pencarian
        }
    });

    // Menampilkan recent searches saat modal dibuka
    window.onload = function() {
        // Mengosongkan input pencarian saat halaman dimuat
        document.getElementById('searchQuery').value = "";
        displayRecentSearches(); // Menampilkan daftar pencarian terbaru saat halaman dimuat
    };
</script>