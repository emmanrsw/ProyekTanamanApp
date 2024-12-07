<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian</title>
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

    .navbar-brand .highlight {
        color: #6c9969;
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
    .carousel-inner img {
        width: 100%;
        /* Menyesuaikan lebar gambar dengan container */
        height: auto;
        /* Memastikan tinggi tetap proporsional */
        object-fit: cover;
        /* Menangani kasus jika gambar memiliki rasio aspek berbeda */
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
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Tanaman Saya</a></li>
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
            <!-- User icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    <a href="#" class="nav-link">
                        {{ session('usernameCust') }}
                    </a>
                    <a href="#" style="font-size: 1rem;">Ubah Password</a>
                    <a href="{{ route('logout') }}" style="font-size: 1rem;">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/Img/1bg.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Img/2bg.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/Img/3bg.png" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Pencarian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('searchTanaman') }}" method="GET">
                        <input type="text" name="query" class="form-control" placeholder="Cari tanaman..." required>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-primary">Lanjutkan ke Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Hasil Pencarian: "{{ $query }}"</h3>

        @if(isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
        @else
        <div class="row">
            @foreach($tanamans as $tanaman)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/'.$tanaman->gambar) }}" class="card-img-top" alt="{{ $tanaman->namaTanaman }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $tanaman->namaTanaman }}</h5>
                        <p class="card-text"><strong>Harga:</strong> {{ $tanaman->hargaTanaman }}</p>
                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal"
                            data-nama="{{ $tanaman->namaTanaman }}"
                            data-harga="{{ $tanaman->hargaTanaman }}"
                            data-gambar="{{ asset('images/'.$tanaman->gambar) }}"
                            data-deskripsi="{{ $tanaman->deskripsi }}"
                            onclick="showTanamanDetails(this)">
                            Lihat Detail
                        </a>


                        <!-- MODAL -->
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="detailModalLabel">Detail Tanaman</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img id="modalTanamanImage" src="" class="img-fluid" alt="Gambar Tanaman">
                                            </div>
                                            <div class="col-md-6">
                                                <h4 id="modalTanamanNama"></h4>
                                                <p><strong>Harga:</strong> <span id="modalTanamanHarga"></span></p>
                                                <p id="modalTanamanDeskripsi"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <a href="#" class="btn btn-primary">Tambah ke Keranjang</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    <script>
        // Mendapatkan dan menampilkan recent search dari localStorage
        function displayRecentSearches() {
            let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

            const recentSearchList = document.getElementById('recent-search-list');
            recentSearchList.innerHTML = ''; // Clear the list before adding

            recentSearches.forEach(query => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <a href="{{ route('searchTanaman') }}?query=${encodeURIComponent(query)}">${query}</a>
                    <a href="#" class="delete-recent" data-query="${query}">Hapus</a>
                `;
                recentSearchList.appendChild(li);
            });
        }

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

        // Menghapus pencarian dari localStorage
        function removeRecentSearch(query) {
            let recentSearches = JSON.parse(localStorage.getItem('recent_searches')) || [];

            // Menghapus query dari array recent search
            recentSearches = recentSearches.filter(item => item !== query);
            localStorage.setItem('recent_searches', JSON.stringify(recentSearches));
            displayRecentSearches(); // Refresh list after deletion
        }

        // Event listener untuk menangani klik pada link "Hapus"
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('delete-recent')) {
                e.preventDefault();
                const query = e.target.getAttribute('data-query');
                removeRecentSearch(query);
            }
        });

        // Menyimpan pencarian setelah halaman dimuat (jika ada query di URL)
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            const query = urlParams.get('query');
            if (query) {
                saveRecentSearch(query); // Menyimpan pencarian yang dilakukan
            }
            displayRecentSearches(); // Menampilkan recent searches
        };

        function showTanamanDetails(element) {
            const nama = element.getAttribute('data-nama');
            const harga = element.getAttribute('data-harga');
            const gambar = element.getAttribute('data-gambar');
            const deskripsi = element.getAttribute('data-deskripsi');

            document.getElementById('modalTanamanNama').innerText = nama;
            document.getElementById('modalTanamanHarga').innerText = harga;
            document.getElementById('modalTanamanImage').src = gambar;
            document.getElementById('modalTanamanDeskripsi').innerText = deskripsi;
        }
    </script>
</body>

</html>