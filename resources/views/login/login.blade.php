<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        }

        .in {
            color: #4B553D;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 36px;
            z-index: 10;
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

        .form-control {
            border: none;
            border-bottom: 2px solid #444;
            padding: 10px 0;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-bottom: 2px solid #4B553D;
        }

        .form-group label {
            font-size: 0.9rem;
            color: #696969;
        }

        .btn-primary {
            background-color: black;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #4B553D;
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
            margin: 5px;
        }

        .btn-google,
        .btn-apple {
            background-color: transparent;
            border: 2px solid black;
            color: black;
        }

        .btn-google:hover,
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
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
            @endif

            @if (session('logout_message'))
            <div class="alert alert-success">
                {{ session('logout_message') }}
            </div>
            @endif

            @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('loginProcess') }}" onsubmit="return validateForm()">
                @csrf <!-- Token untuk keamanan dari Laravel -->

                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <div style="position: relative;">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <div id="passwordError" class="text-danger"></div>
                        <!-- Icon mata untuk menampilkan/membunyikan password -->
                        <i class="fa fa-eye" id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
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

            <p><a href="#">Lupa Password?</a></p>
            <p><a href="{{ route('register') }}">Register</a></p>

        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            // Toggle tipe input antara 'password' dan 'text'
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;

            // Toggle icon antara mata terbuka dan tertutup
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

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