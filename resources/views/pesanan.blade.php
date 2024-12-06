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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        padding: 80px 40px;
        width: 100%;
        max-width: 1200px;
        /* Memberikan batas maksimal lebar */
        margin: 0 auto;
        margin-top: 20px;
        /* Meratakan di tengah atas-bawah dan kiri-kanan */
        height: 100px;
        border-radius: 10px;
        box-sizing: border-box;
        /* Memastikan padding tidak menambah lebar elemen */
    }

    .icon-container {
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px;
        transition: background-color 0.3s ease;
        cursor: pointer;
        color: black;
    }

    .icon-container i {
        font-size: 2rem;
        /* Mengatur ukuran ikon */
    }

    .icon-container .text {
        font-size: 1.5rem;
        /* Mengatur ukuran teks */
    }

    .icon-container:hover {
        color: #ddd;
        transition: transform 0.2s, color 0.2s;
        /* Transisi halus */
    }

    .text {
        margin-top: 5px;
        /* Memberikan jarak antara ikon dan teks */
        color: #333;
        /* Warna teks */
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
        background-color: #4B553D;
        border-radius: 5px;
        /* Menambahkan sudut membulat */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        /* Menambahkan bayangan */
        z-index: 1000;
        /* Pastikan menu berada di atas elemen lain */
        font-size: 12px;
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

    .modal-header {
        display: flex;
        justify-content: center;
        position: relative;
        font-weight: 25px;
    }

    .modal-header .btn-close {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
    }

    #message1 {
        text-align: center;
        font-size: 1.2rem;
        margin-top: 100px;
        /* Memberikan jarak dari banner */
    }

    /* Tampilan jika barang ada */
    #barangAda {
        background-color: #28a745;
        /* Hijau */
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    /* Tampilan jika barang tidak ada */
    #barangTidakAda {
        background-color: #dc3545;
        /* Merah */
        color: white;
        padding: 10px;
        border-radius: 5px;
    }

    /* Menyembunyikan tombol belanja */
    #belanjaBtn.hidden {
        display: none;
    }

    /* Gaya untuk elemen yang tidak aktif */
    #sedangDikemas,
    #dikirim,
    #selesai {
        opacity: 0.5;
        /* Redup */
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    /* Gaya untuk elemen yang aktif */
    #sedangDikemas.active,
    #dikirim.active,
    #selesai.active {
        opacity: 1;
        /* Nyala */
        transform: scale(1.1);
        /* Sedikit membesar */
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{route('home')}}"><span>Tanam</span><span class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#{{route('home')}}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#pesanan">Pesanan Saya</a></li>
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

    <!-- <! Banner Section -->
    <section class="banner">
        <div class="icon-container" id="sedangDikemas">
            <i class="fa-solid fa-box-open"></i>
            <span class="text">Sedang dikemas</span>
        </div>
        <div class="icon-container" id="dikirim">
            <i class="fa-solid fa-truck-fast"></i>
            <span class="text">Dikirim</span>
        </div>
        <div class="icon-container" id="selesai">
            <i class="fa-solid fa-circle-check"></i>
            <span class="text">Selesai</span>
        </div>
    </section>

    <!-- Elemen pesan yang akan ditampilkan di bawah banner -->
    <div id="message1"
        style="text-align: center; font-size: 1.2rem; color: #333; margin-top: 150px; position: relative;">
        <!-- Ikon sebagai watermark -->
        <i class="fa-brands fa-shopify"
            style="font-size: 20rem; color: rgba(0, 0, 0, 0.1); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1;"></i>

        <p id="messageText" style="margin-bottom: 10px;"></p>

        <a href="#" class="btn btn-custom mt-3" id="belanjaBtn" style="display: none;">Belanja Sekarang</a>
    </div>

    <script>
        isBarangAda = true; // Ganti dengan kondisi nyata dari data Anda

        if (isBarangAda) {
            // Ubah teks dan tampilkan indikator barang sudah ada
            document.getElementById("messageText").innerText = "Cek Status Pemesanan!";
            document.getElementById("messageText").className = "barangAda"; // Menambahkan kelas untuk styling

            // Sembunyikan tombol belanja
            document.getElementById("belanjaBtn").classList.add("hidden");
        } else {
            // Ubah teks dan tampilkan indikator barang belum ada
            document.getElementById("messageText").innerText = "Belum Ada! Silahkan klik dibawah ini.";
            document.getElementById("messageText").className = "barangTidakAda"; // Menambahkan kelas untuk styling

            // Tampilkan tombol belanja
            document.getElementById("belanjaBtn").classList.remove("hidden");
        }
    </script>

    <script>
        // ini barangnya gak ada samsek
        isBarangAda = false; // Ganti dengan kondisi nyata dari data Anda
        // Cek jika ada barang atau tidak
        if (isBarangAda) {

            // lgsg table
            document.getElementById("messageText").innerText = "Barang sudah ada!";
            document.getElementById("belanjaBtn").style.display = "none"; // Sembunyikan tombol belanja
        } else {
            document.getElementById("messageText").innerText = "Belum Ada! Silahkan klik dibawah ini.";
            document.getElementById("belanjaBtn").style.display = "inline-block"; // Tampilkan tombol belanja
        }
    </script>


    <!-- Elemen pesan yang akan ditampilkan di bawah banner -->
    <div id="message" style="display: none; text-align: center; font-size: 1.2rem; color: #333; margin-top: 50px;">
        <!-- Pesan akan muncul di sini -->
    </div>

    <script>
        window.onload = function() {
            var messageElement = document.getElementById("message1");
            var belanjaBtn = document.getElementById("belanjaBtn");

            // Menampilkan pesan dan tombol langsung saat halaman dimuat
            messageElement.style.display = "block"; // Pastikan pesan muncul langsung

            // Aksi tombol Belanja
            belanjaBtn.addEventListener("click", function() {
                window.location.href = "/tanaman"; // Ganti dengan URL halaman belanja yang sesuai
            });
        };

        // Fungsi untuk mereset kelas aktif pada semua tombol
        function resetActive() {
            document.getElementById("sedangDikemas").classList.remove("active");
            document.getElementById("dikirim").classList.remove("active");
            document.getElementById("selesai").classList.remove("active");
        }


        // Variabel status barang
        const isBarangAda = {
            sedangDikemas: false, // Sesuaikan dengan kondisi nyata
            dikirim: false, // Sesuaikan dengan kondisi nyata
            selesai: false // Sesuaikan dengan kondisi nyata
        };

        // Fungsi untuk menampilkan pesan default jika tidak ada barang sama sekali
        function cekBarang() {
            if (!isBarangAda.sedangDikemas && !isBarangAda.dikirim && !isBarangAda.selesai) {
                // Barang tidak ada sama sekali
                document.getElementById("messageText").innerText = "Belum Ada! Silahkan klik dibawah ini.";
                document.getElementById("belanjaBtn").style.display = "inline-block"; // Tampilkan tombol belanja
                document.getElementById("message1").style.display = "none"; // Sembunyikan banner jika ada
            } else {
                // Barang ada, sembunyikan pesan default
                document.getElementById("messageText").innerText = "";
                document.getElementById("belanjaBtn").style.display = "none"; // Sembunyikan tombol belanja
            }
        }

        // Fungsi untuk reset tombol aktif
        function resetActive() {
            document.querySelectorAll(".status-button").forEach(button => {
                button.classList.remove("active");
            });
        }

        // Event Listener untuk "Sedang Dikemas"
        document.getElementById("sedang dikemas").addEventListener("click", function() {
            document.getElementById("message1").style.display = "none";
            var messageElement = document.getElementById("message");

            if (isBarangAda.sedangDikemas) {
                messageElement.textContent = "Barang sedang dikemas.";
            } else {
                messageElement.textContent = "Tidak ada barang yang sedang dikemas.";
            }

            messageElement.style.display = "block";
            resetActive();
            this.classList.add("active");
        });

        // Event Listener untuk "Dikirim"
        document.getElementById("dikirim").addEventListener("click", function() {
            document.getElementById("message1").style.display = "none";
            var messageElement = document.getElementById("message");

            if (isBarangAda.dikirim) {
                messageElement.textContent = "Barang sedang dikirim.";
            } else {
                messageElement.textContent = "Tidak ada barang yang dikirim.";
            }

            messageElement.style.display = "block";
            resetActive();
            this.classList.add("active");
        });

        // Event Listener untuk "Selesai"
        document.getElementById("selesai").addEventListener("click", function() {
            document.getElementById("message1").style.display = "none";
            var messageElement = document.getElementById("message");

            if (isBarangAda.selesai) {
                messageElement.textContent = "Barang sudah selesai dikirim.";
            } else {
                messageElement.textContent = "Belum ada barang yang terselesaikan.";
            }

            messageElement.style.display = "block";
            resetActive();
            this.classList.add("active");
        });

        // Panggil fungsi cekBarang untuk menampilkan pesan default jika tidak ada barang
        cekBarang();
        // -----------------------------------------------------------------------------------------------------------------------
        // yang asli punya gisel ke file tumpang
        // ----------------------------------------------------------------------------------------------------------------------- -->



        // -----------------------------------------------------------------------------------------------------------------------
        document.getElementById("sedangDikemas").addEventListener("click", function() {
            // Sembunyikan #message1
            document.getElementById("message1").style.display = "none";

            // Tampilkan pesan di bawah banner
            var messageElement = document.getElementById("message");
            messageElement.textContent = "Tidak ada barang yang sedang dikemas";
            messageElement.style.display = "block";

            // Reset semua tombol dan atur tombol ini sebagai aktif
            resetActive();
            this.classList.add("active");
        });

        // -----------------------------------------------------------------------------------------------------------------------
        document.getElementById("dikirim").addEventListener("click", function() {
            // Sembunyikan #message1
            document.getElementById("message1").style.display = "none";

            // Tampilkan pesan di bawah banner
            var messageElement = document.getElementById("message");
            messageElement.textContent = "Tidak ada barang yang dikirim";
            messageElement.style.display = "block";

            // Reset semua tombol dan atur tombol ini sebagai aktif
            resetActive();
            this.classList.add("active");
        });

        // -----------------------------------------------------------------------------------------------------------------------
        document.getElementById("selesai").addEventListener("click", function() {
            // Sembunyikan #message1
            document.getElementById("message1").style.display = "none";

            // Tampilkan pesan di bawah banner
            var messageElement = document.getElementById("message");
            messageElement.textContent = "Belum ada barang yang terselesaikan";
            messageElement.style.display = "block";

            // Reset semua tombol dan atur tombol ini sebagai aktif
            resetActive();
            this.classList.add("active");
        });

        // -----------------------------------------------------------------------------------------------------------------------
    </script>

    </div>
    </div>
    </div>
</body>

</html>