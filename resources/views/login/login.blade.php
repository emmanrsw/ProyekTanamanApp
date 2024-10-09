<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .image-section {
            flex: 1;
            background: url('Img/tanamanpolos.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .tanam {
            color: black;
            /* Warna untuk "Tanam." */
        }

        .in {
            color: #4B553D;
            /* Warna untuk "in" */
        }

        .logo {
            position: absolute;
            /* Memungkinkan untuk menempatkan di atas gambar */
            top: 20px;
            /* Jarak dari atas */
            left: 50%;
            /* Memposisikan ke tengah horizontal */
            transform: translateX(-50%);
            /* Memindahkan logo setengah lebar teks */
            color: white;
            /* Warna teks */
            font-size: 36px;
            /* Ukuran font */
            z-index: 10;
            /* Memastikan teks berada di atas gambar */
            font-family: 'Poppins';
            font-weight: 700;
        }

        .form-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-family: 'Rubik';
        }

        .form-container {
            width: 100%;
            max-width: 400px;
        }

        /* Gaya untuk input field */
        .form-control {
            border: none;
            /* Menghapus border */
            border-bottom: 2px solid #444;
            /* Garis bawah */
            border-radius: 3;
            /* Menghapus sudut */
            padding: 10px 0;
            /* Padding atas dan bawah */
            transition: border-color 0.3s;
            /* Transisi saat fokus */
        }

        .form-control:focus {
            outline: none;
            /* Menghapus outline default */
            border-bottom: 2px solid #4B553D;
            /* Garis bawah saat fokus */
        }

        .form-group label {
            font-size: 0.9rem;
            color: #696969;
            /* Label color */
        }

        .btn-primary {
            background-color: black;
            /* Button color */
            border: none;
            /* Remove border */
            border-radius: 5px;
            /* Rounded button */
            transition: background-color 0.3s;
            /* Transition effect */
            text-align: left;
            font-size: 1p6x;
        }

        .btn-primary:hover {
            background-color: #4B553D;
            /* Button hover color */
        }

        h2 {
            font-weight: 550;
        }

        a {
            color: black;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
            color: #4B553D;
        }

        /* Style untuk pesan kesalahan */
        .error {
            color: red;
            font-size: 0.9rem;
            display: none;
            /* Awalnya tidak ditampilkan */
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            padding: 10px;
            width: 120px;
            /* Ukuran lebar setiap tombol */
            margin: 5px;
            /* Spasi antara tombol */
        }

        /* Tombol Google */
        .btn-google {
            background-color: transparent;
            border: 2px solid black;
            color: black;
        }

        .btn-google:hover {
            background-color: transparent;
            color: #4B553D;
        }

        /* Tombol Apple */
        .btn-apple {
            background-color: transparent;
            border: 2px solid black;
            color: black;
        }

        .btn-apple:hover {
            background-color: transparent;
            color: #4B553D;
        }

        .btn-social i {
            margin-right: 8px;
        }

        .social-buttons {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        h2 {
            font-weight: 550;
        }

        .error {
            color: red;
            font-size: 0.9rem;
            display: none;
        }

        .custom-left {
            text-align: center;
        }

        .or-text {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            color: #696969;
        }

        .or-text::before,
        .or-text::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #444;
            margin: 0 10px;
        }
    </style>
</head>

<body>

    <div class="image-section">
        <h1 class="logo">
            <span class="tanam">Tanam.</span><span class="in">in</span>
        </h1>
    </div>
    <div class="form-section">
        <div class="form-container">
            <h2>Login</h2>

            <!-- Flash Messages -->
            @if (session('msg'))
            <div class="alert alert-danger">
                {{ session('msg') }}
            </div>
            @endif

            @if (session('logout_message'))
            <div class="alert alert-success">
                {{ session('logout_message') }}
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('loginProcess') }}" onsubmit="return validateForm()">
                @csrf <!-- Token untuk keamanan dari Laravel -->

                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="stayLoggedIn">
                    <label class="form-check-label" for="stayLoggedIn">Biarkan saya tetap masuk.</label>
                    <div id="checkboxError" class="error">Anda harus mencentang kotak ini untuk melanjutkan.</div>
                </div>

                <h6 class="or-text my-3">Atau Login melalui</h6>

                <!-- Social Buttons - Horizontal Layout -->
                <div class="social-buttons">
                    <button type="button" class="btn-social btn-google">
                        <img src="Img/logo_google.png" alt="Google" width="20" height="20" style="margin-right: 8px;"> Google
                    </button>
                    <button type="button" class="btn-social btn-apple">
                        <img src="Img/logo_apple.png" alt="Apple" width="25" height="25" style="margin-right: 8px;"> Apple
                    </button>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>

            <p><a href="{{ route('forgot-password') }}">Lupa Password?</a></p>
            <p><a href="{{ route('register') }}">Register</a></p>

        </div>
    </div>

    <script>
        function validateForm() {
            const checkbox = document.getElementById('stayLoggedIn');
            const error = document.getElementById('checkboxError');

            if (!checkbox.checked) {
                error.style.display = 'block'; // Tampilkan pesan kesalahan
                return false; // Cegah pengiriman formulir
            } else {
                error.style.display = 'none'; // Sembunyikan pesan kesalahan jika dicentang
                return true; // Izinkan pengiriman formulir
            }
        }
    </script>
</body>

</html>