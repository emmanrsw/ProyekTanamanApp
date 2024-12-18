@extends('layout.navbar')

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .icon {
            font-size: 1.2rem;
            cursor: pointer;
            color: #333;
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
            gap: 300px;
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

        .hubungi-kami {
            padding: 20px;
            background-color: #f9f9f9;
        }

        .hubungi-kami h3 {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .hubungi-kami p {
            font-size: 14px;
            padding: 0px 270px;
            color: #555;
        }

        footer {
            margin-top: 80px;
            padding: 20px 0;
            background-color: #fff;
            text-align: center;
            font-size: 12px;
            color: #666;
        }

        footer .footer-links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        footer .footer-links div {
            width: 30%;
        }

        footer .footer-links h4 {
            font-size: 14px;
            margin-bottom: 10px;
        }

        footer .footer-links a {
            display: block;
            color: #666;
            text-decoration: none;
            margin-bottom: 5px;
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
</head>

@section('content')
    <div class="container-fluid p-0">
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

            <footer>
                <div class="footer-links">
                    <div>
                        <h4>INFORMASI PERUSAHAAN</h4>
                        <a href="tentangKami">Tentang Kami</a>
                        <a href="home">Dashboard</a>
                        <a href="kontak">Hubungi Kami</a>
                    </div>
                    <div>
                        <h4>LINK BANTUAN</h4>
                        <a href="pesanan">Pelacakan</a>
                        <a href="pesanan">Status Pesanan</a>
                        <a href="pesanan">Pengiriman</a>
                        <a href="pesanan">Info Pengiriman</a>
                    </div>
                    <div>
                        <h4>ALAMAT</h4>
                        <p>Jl. Raya No. 123, Kota X, Indonesia</p>
                        <h4>MEDIA SOSIAL</h4>
                        <p>
                            <i class="fa-brands fa-facebook"></i>
                            <i class="fa-brands fa-instagram"></i>
                            <i class="fa-brands fa-whatsapp"></i>
                        </p>
                    </div>
                </div>
                <p>
                    © 2020 Tanam.in eCommerce<br />
                    Privacy Policy | Terms & Conditions
                </p>

            </footer>
        </div>
    @endsection
