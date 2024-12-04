<html>

<head>
    <title>
        Tanam.in - Hubungi Kami
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins';
            margin: 0;
            padding: 0px;
            /* box-sizing: border-box; */
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .navbar-toggler-icon {
            color: #333;
        }

        .topnav {
            position: relative;
        }

        .topnav .icon {
            font-size: 1.2rem;
            cursor: pointer;
            color: #333;
        }

        .topnav #myLinks {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 10px;
        }

        .topnav #myLinks a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 1rem;
        }

        .topnav #myLinks a:hover {
            background-color: #f0f0f0;
        }

        .jumbotron img {
            width: 100%;
            /* Memastikan gambar mengambil seluruh lebar elemen */
            height: 200;
            /* Menjaga rasio gambar */
            display: block;
            /* Menghilangkan spasi kecil di bawah gambar */
        }

        .contact-section {
            padding: 20px 80px;
            display: flex;
            justify-content: space-between;
        }

        .contact-info {
            width: 40%;
        }

        .contact-info h3 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 16px;
        }

        .contact-info i {
            margin-right: 10px;
            color: #6b8e23;
        }

        .contact-form {
            font-weight: bold;
            width: 50%;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #eaeaea;
            border-radius: 5px;
        }

        .contact-form button {
            background-color: #b8860b;
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .offline-store {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .offline-store h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 50px;
        }

        .store-locations {
            display: flex;
            justify-content: center;
            gap: 250px;
        }

        .store {
            text-align: center;
        }

        .store img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
        }

        .store h3 {
            font-size: 20px;
            margin: 20px 0 10px;
        }

        .store p {
            font-size: 16px;
            margin: 10px 0;
        }

        .store a {
            text-decoration: none;
            color: #000;
            font-weight: 500;
        }

        .hubungi-kami {
            padding: 20px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .hubungi-kami h3 
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .hubungi-kami p {
            font-size: 16px;
            padding: 0px 270px;
            color: #555;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand"
            href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}"><span>Tanam</span><span
                class="highlight">.in</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link"
                        href="{{ Auth::guard('pelanggan')->check() ? route('home') : route('register') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="404">Kontak</a></li>
                <li class="nav-item"><a class="nav-link" href="tentangKami">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="pesanan">Pesanan Saya</a></li>

            </ul>
        </div>
        <div class="navbar-icons d-flex align-items-center">
            <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fa fa-search"></i>
            </a>
            <a href="{{ route('cart') }}" class="nav-link">
                <i class="fa fa-shopping-cart"></i>
            </a>
            <!-- User Icon -->
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-user"></i>
                </a>
                <div id="myLinks" style="display: none;">
                    @if (Auth::guard('pelanggan')->check())
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
    <div class="container-fluid">
        <div class="jumbotron">
            <img src="/Img/backgroundTK.jpg" alt="jumbotron" class="img-fluid">
        </div>
    </div>
    <div class="hubungi-kami text-center my-4">
        <h3>Hubungi Kami</h3>
        <p>Untuk Informasi Lebih Lanjut Tentang Produk &amp; Layanan Kami. Silakan Kirim Email kepada Kami. Staf Kami
            Selalu Ada Untuk Membantu Anda. Jangan Ragu!</p>
    </div>
    <div class="contact-section">
        <div class="contact-info">

            <p>
                <i class="fas fa-map-marker-alt"></i>
                <strong>Alamat</strong>
                <br />
                236 5th SE Avenue, New York NY10000, United States
            </p>
            <p>
                <i class="fas fa-phone"></i>
                <strong>Telepon</strong>
                <br />
                Mobile: +(+84) 546-6789
                <br />
                Hotline: +(+84) 456-6789
            </p>
            <p>
                <i class="fas fa-clock"></i>
                <strong>Jam Kerja</strong>
                <br />
                Monday-Friday: 9:00 - 22:00
                <br />
                Saturday-Sunday: 9:00 - 21:00
            </p>

        </div>
        <div class="contact-form">
            <form action="/submit-contact" method="POST">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" />

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" />

                <label for="subject">Subjek</label>
                <input type="text" id="subject" name="subject" placeholder="Subjek pesan Anda (Opsional)" />

                <label for="message">Pesan</label>
                <textarea id="message" name="message" placeholder="Tulis pesan Anda di sini"></textarea>

                <button type="submit">Kirim</button>
            </form>
        </div>
    </div>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tanam.in - Hubungi Kami</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                margin: 0;
                padding: 0;
            }

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 40px;
                background-color: white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                font-size: 1.5rem;
                font-weight: 700;
                color: #000;
            }

            .navbar-brand .highlight {
                color: #4B553D;
            }

            .jumbotron img {
                width: 100%;
                height: auto;
                display: block;
            }

            .offline-store {
                text-align: center;
                padding: 50px 80px;
                background-color: #f9f9f9;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                margin: 20px auto;
            }

            .offline-store h2 {
                font-size: 28px;
                font-weight: bold;
                color: #333;
                margin-bottom: 30px;
            }

            .store-locations {
                display: flex;
                justify-content: center;
                gap: 50px;
                flex-wrap: wrap;
            }

            .store {
                text-align: center;
                max-width: 300px;
            }

            .store img {
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .store img:hover {
                transform: scale(1.1);
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
            }

            .store h3 {
                font-size: 20px;
                margin: 20px 0 10px;
                color: #333;
            }

            .store p {
                font-size: 16px;
                margin: 10px 0;
                color: #555;
            }

            .store a {
                text-decoration: none;
                color: #4B553D;
                font-weight: 500;
            }

            .store a:hover {
                text-decoration: underline;
            }
        </style>
    </head>

    <body>
        <div class="offline-store">
            <h2>Offline Store</h2>
            <div class="store-locations">
                <div class="store">
                    <img src="https://storage.googleapis.com/a1aa/image/AGes711sX02MRCoq7m01QLZqurNrOqveRVdQeifCGF2eYLSeE.jpg"
                        alt="Yogyakarta Store">
                    <h3>Yogyakarta</h3>
                    <p>Jalan Kaliurang, 22765 Sleman</p>
                </div>
                <div class="store">
                    <img src="https://storage.googleapis.com/a1aa/image/jW0Vbk0Fu1aMAVaNIke5yT9V3fkd9mKHpKMhetpvr5lS2iknA.jpg"
                        alt="Solo Store">
                    <h3>Solo</h3>
                    <p>Jalan Solo, 1049 Solo</p>
                </div>
            </div>
        </div>
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
    </body>

</html>
