@extends('layout.navbar')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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

        .carousel-inner img {
            width: 100%;
            /* Menyesuaikan lebar gambar dengan container */
            height: auto;
            /* Memastikan tinggi tetap proporsional */
            object-fit: cover;
            /* Menangani kasus jika gambar memiliki rasio aspek berbeda */
        }

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
            justify-content: center;
            /* Membuat elemen berada di tengah */
            gap: 20px;
            /* Jarak antar testimonial */
            flex-wrap: wrap;
            /* Elemen turun jika tidak muat */
        }

        .testimonial {
            background-color: #fff;
            border-radius: 10px;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            padding: 30px;
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
            margin-left: 70px;
            margin-right: 20px;
            text-align: center;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            /* Rata tengah vertikal */
            height: 300px;
            /* Tinggi tetap */
            transition: transform 0.2s ease;
        }

        .testimonial:hover {
            transform: translateY(-10px);
        }

        .testimonial p {
            flex-grow: 1;
            font-size: 1rem;
            color: #666;
            margin: 15px 0;
            /* Isi teks tetap rapi */
        }

        .testimonial .quote {
            color: #4B553D;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .testimonial .profile {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        .testimonial .profile img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
            margin-right: 10px;
        }

        .testimonial .profile .name {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }

        .testimonial .profile .role {
            font-size: 0.875rem;
            color: #999;
        }

        .testimonial .rating {
            color: #f39c12;
            margin-top: 10px;
        }
    </style>
</head>

@section('content')
    <div class="container-fluid p-0">
        <div class="container-fluid">
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
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="row">
                        <!-- Testimonial 1 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Punya banyak tanaman dari Tanam.in bikin rumah saya jadi lebih asri.</p>
                                <div class="profile">
                                    <img src="images/muka2.jpg" alt="Robert Fox">
                                    <div class="name">Chill Guy</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 2 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Tanaman dari Tanam.in sangat berkualitas, dan pengirimannya cepat!</p>
                                <div class="profile">
                                    <img src="images/muka4.jpg"" alt=" Jenny Wilson">
                                    <div class="name">Jenny Wilson</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 3 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Pelayanan Tanam.in luar biasa! Saya sangat merekomendasikannya.</p>
                                <div class="profile">
                                    <img src="images/muka5.jpg" alt="Kristin Watson">
                                    <div class="name">Kristin Watson</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="row">
                        <!-- Testimonial 4 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Tanaman di sini membuat ruangan kerja saya jadi lebih segar.</p>
                                <div class="profile">
                                    <img src="images/muka1.jpg" alt="Michael Scott">
                                    <div class="name">Michael Scott</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 5 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Proses pemesanan mudah, tanaman sampai dalam kondisi baik!</p>
                                <div class="profile">
                                    <img src="images/muka6.jpg" alt="Pam Beesly">
                                    <div class="name">Pam Beesly</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial 6 -->
                        <div class="col-md-4">
                            <div class="testimonial">
                                <div class="quote"><i class="fas fa-quote-left"></i></div>
                                <p>Saya suka dengan koleksi tanaman hias yang ditawarkan di sini.</p>
                                <div class="profile">
                                    <img src="images/muka3.jpg" alt="Jim Halpert">
                                    <div class="name">Trevor Philips</div>
                                </div>
                                <div class="rating">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                        class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
