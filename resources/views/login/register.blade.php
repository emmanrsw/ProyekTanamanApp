<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            text-align: left;
            font-size: 16px;
        }

        .btn-primary:hover {
            background-color: #4B553D;
        }

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

        a {
            color: black;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
            color: #4B553D;
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

        .custom-left {
            text-align: left;
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
            <h2>Register</h2>

            <?php if ($errors->any()): ?>
                <div class="alert alert-success">
                    <ul>
                        <?php foreach ($errors->all() as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= route('register') ?>" onsubmit="return validateForm()">
                <?= csrf_field() ?>

                <div class="form-group">
                    <input type="text" class="form-control" id="usernameCust" name="usernameCust" placeholder="Username" value="{{ old('username') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="namaCust" name="namaCust" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" id="emailCust" name="emailCust" placeholder="Email" value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="alamatCust" name="alamatCust" placeholder="Alamat Lengkap" value="{{ old('alamat') }}" required>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" id="notlpCust" name="notlpCust" placeholder="Nomor Telepon" value="{{ old('notlp') }}" required>
                </div>

                <div class="form-group">
                    <div style="position: relative;">
                        <input type="password" class="form-control" id="passwordCust" name="passwordCust" placeholder="Password" required>
                        <div id="passwordError" class="text-danger"></div>
                        <!-- Icon mata untuk menampilkan/membunyikan password -->
                        <i class="fa fa-eye" id="togglePassword1" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div style="position: relative;">
                        <input type="password" class="form-control" id="passwordCust_confirmation" name="passwordCust_confirmation" placeholder="Confirm Password" value="{{ old('confirmPw') }}" required>
                        <i class="fa fa-eye" id="togglePassword2" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;"></i>
                    </div>
                </div>

                <div class="form-group form-check mt-3">
                    <input type="checkbox" class="form-check-input" id="stayLoggedIn">
                    <label class="form-check-label" for="stayLoggedIn">Dengan mengklik 'Register', Anda menyetujui Syarat & Ketentuan Tanamin, dan Kebijakan Privasi.</label>
                    <div id="checkboxError" class="error">Anda harus mencentang kotak ini untuk melanjutkan.</div>
                </div>

                
                
                <button type="submit" class="btn btn-primary btn-block mt-4">Register</button>
                <p><a href="/login" class="d-block custom-left mt-3">Login</a></p>
            </form>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('passwordCust');
        const confirmPwInput = document.getElementById('passwordCust_confirmation');
        const passwordError = document.getElementById('passwordError');

        passwordInput.addEventListener('input', function() {
            const password = passwordInput.value;
            passwordError.textContent = '';
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()._])[A-Za-z\d!@#$%^&*()._]{6,}$/;

            if (!passwordRegex.test(password)) {
                passwordError.textContent = 'Password harus terdiri dari minimal 6 karakter, mengandung huruf besar, huruf kecil, angka, dan simbol khusus(!, @, #, $, %, ^, &, *, ., _).';
            }
        });

        // validasi checkbox
        function validateForm() {
            const checkbox = document.getElementById('stayLoggedIn');
            const error = document.getElementById('checkboxError');

            if (!checkbox.checked) {
                error.style.display = 'block';
                return false;
            } else {
                error.style.display = 'none';
                return true;
            }
        }
        // Toggle Password untuk `passwordCust`
        document.getElementById('togglePassword1').addEventListener('click', function() {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // Toggle Password untuk `confirmPw`
        document.getElementById('togglePassword2').addEventListener('click', function() {
            const type = confirmPwInput.type === 'password' ? 'text' : 'password';
            confirmPwInput.type = type;
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>