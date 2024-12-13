<html>

<head>
    <title>
        Tanam.in
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Poppins', 'Poppins';
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
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

        /* .header {
            background-image: url('/assets/Img/backgroundT.jpg');
            background-size: cover;
            background-position: center;
            height: 300px;
        } */
        .content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
        }

        .content .text {
            max-width: 50%;
        }

        .content .text h1 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .content .text p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }

        .content .image {
            max-width: 45%;
        }

        .content .image img {
            width: 100%;
            border-radius: 10px;
        }

        .jumbotron img {
            width: 100%;
            /* Memastikan gambar mengambil seluruh lebar elemen */
            height: 300;
            /* Menjaga rasio gambar */
            display: block;
            /* Menghilangkan spasi kecil di bawah gambar */
        }

        /* .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 0 20px;
        } */
        .text {
            flex: 1;
            padding-left: 50px;
        }

        .text h1 {
            font-size: 48px;
            color: #333;
            margin: 0 0 20px;
        }

        .text p {
            font-size: 18px;
            color: #666;
            margin: 0 0 20px;
        }

        .text ul {
            list-style: none;
            padding: 0;
            margin: 0 0 20px;
        }

        .text ul li {
            font-size: 18px;
            color: #666;
            margin: 10px 0;
            display: flex;
            align-items: center;
        }

        .text ul li i {
            color: #4B553D;
            margin-right: 10px;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            background-color: #4B553D;
            color: #fff;
            font-size: 18px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #00a844;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            font-size: 36px;
            color: #333;
        }

        .testimonials {
            display: flex;
            justify-content: space-between;
        }

        .testimonial {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            padding: 20px;
            width: 30%;
            text-align: center;
        }

        .testimonial .quote {
            color: #4B553D;
            font-size: 24px;
        }

        .testimonial p {
            font-size: 16px;
            color: #666;
            margin: 20px 0;
        }

        .testimonial .profile {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .testimonial .profile img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .testimonial .profile .name {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .testimonial .profile .role {
            font-size: 14px;
            color: #999;
        }

        .testimonial .rating {
            color: #f39c12;
            margin-top: 10px;
        }

        .navigation {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .navigation .nav-button {
            background-color: #fff;
            border: none;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #4B553D;
            cursor: pointer;
            font-size: 20px;
            height: 40px;
            margin: 0 10px;
            width: 40px;
        }

        .navigation .nav-button:hover {
            background-color: #888;
            color
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ route('home') }}">
            <span>Tanam</span><span class="highlight">.in</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="tanaman">Tanaman</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak">Kontak</a></li>
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
            <div class="topnav">
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    @if (Auth::guard('pelanggan')->check() && Auth::guard('pelanggan')->user()->gambarCust)
                        <!-- Jika pengguna memiliki gambar profil -->
                        <img src="{{ asset('uploads/' . Auth::guard('pelanggan')->user()->gambarCust) }}"
                            alt="User Profile" class="rounded-circle" width="30" height="30">
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
        <div class="content">
            <div class="text">
                <h1>
                    100% Tanaman Hias Pilihan Terbaik
                </h1>
                <p>
                    Tanam.in adalah toko online khusus tanaman hias yang dirancang untuk memenuhi kebutuhan dekorasi
                    rumah
                    Anda. Kami percaya bahwa tanaman memiliki kekuatan untuk membuat setiap ruangan terasa hidup dan
                    segar.
                    Koleksi kami mencakup tanaman hias berkualitas tinggi, hasil dari kerja sama dengan petani lokal
                    yang
                    berpengalaman.
                </p>
            </div>
            <div class="image">
                <img alt="A happy farmer holding a basket of fresh vegetables in a garden" height="400"
                    src="Img/petani.png" width="600" />
            </div>
        </div>
        <div class="content">
            <div class="image">
                <img alt="Delivery person holding a blue crate filled with various groceries" height="400"
                    src="Img/kurir.png" width="600" />
            </div>
            <div class="text">
                <h1>
                    Kami Mengirim, Anda Menikmati Keindahannya.
                </h1>
                <p>
                    Kami menyediakan berbagai macam tanaman hias sesuai kebutuhanmu
                </p>
                <ul>
                    <li>
                        <i class="fas fa-check-circle">
                        </i>
                        Beragam Pilihan
                    </li>
                    <li>
                        <i class="fas fa-check-circle">
                        </i>
                        Tanaman Berkualitas
                    </li>
                    <li>
                        <i class="fas fa-check-circle">
                        </i>
                        Dukungan Terbaik
                    </li>
                </ul>
                <a class="button" href="/tanaman">
                    Shop Now
                    <i class="fas fa-arrow-right">
                    </i>
                </a>
            </div>
        </div>
    </div>
    <div class="header">
        <h1>Client Testimonial</h1>
    </div>

    <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <!-- Testimonial 1 -->
            <div class="carousel-item active">
                <div class="testimonial">
                    <div class="quote"><i class="fas fa-quote-left"></i></div>
                    <p>Punya banyak tanaman dari Tanam.in bikin rumah saya jadi lebih asri.</p>
                    <div class="profile">
                        <img src="https://via.placeholder.com/50" alt="Robert Fox">
                        <div class="name">Robert Fox</div>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="carousel-item">
                <div class="testimonial">
                    <div class="quote"><i class="fas fa-quote-left"></i></div>
                    <p>Tanaman dari Tanam.in sangat berkualitas, dan pengirimannya cepat!</p>
                    <div class="profile">
                        <img src="https://via.placeholder.com/50" alt="Jenny Wilson">
                        <div class="name">Jenny Wilson</div>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="carousel-item">
                <div class="testimonial">
                    <div class="quote"><i class="fas fa-quote-left"></i></div>
                    <p>Pelayanan Tanam.in luar biasa! Saya sangat merekomendasikannya.</p>
                    <div class="profile">
                        <img src="https://via.placeholder.com/50" alt="Kristin Watson">
                        <div class="name">Kristin Watson</div>
                    </div>
                    <div class="rating">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
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
