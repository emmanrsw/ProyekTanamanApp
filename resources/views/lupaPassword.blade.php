<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Username / Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<style>
    body {
        font-family: 'Poppins';
        background-color: #f8f9fa;
    }

    .change-password-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .change-password-content {
        display: flex;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        max-width: 700px;
        width: 100%;
        gap: 20px;
    }

    .icon-box {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-box img {
        width: 150px;
        height: 150px;
    }

    .form-container {
        flex: 2;
    }

    .form-container h3 {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .btn-custom {
        background-color: #4B553D;
        color: white;
        padding: 10px;
        border-radius: 5px;
        border: none;
        width: 100%;
        font-size: 16px;
    }

    .btn-custom:hover {
        background-color: gray;
    }

    @media (max-width: 768px) {
        .change-password-content {
            flex-direction: column;
            align-items: center;
        }

        .icon-box img {
            width: 100px;
            height: 100px;
        }
    }

    .icon-box img {
        width: 100%;
        /* Lebar maksimum gambar */
        height: auto;
        /* Menjaga rasio aspek gambar */
        object-fit: contain;
        /* Menghindari pemotongan gambar */
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper .form-control {
        padding-right: 40px;
        /* Tambahkan ruang untuk ikon */
    }

    .input-wrapper i {
        position: absolute;
        right: 10px;
        /* Jarak dari sisi kanan */
        top: 50%;
        /* Tempatkan di tengah vertikal */
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
    }

    .input-wrapper i:hover {
        color: #333;
        /* Ubah warna saat hover */
    }
</style>

<body>

    <div class="container change-password-container">
        <div class="change-password-content">
            <!-- Gambar di sebelah kiri -->
            <div class="icon-box">
                <img src="{{ asset('Img/forgot-password.png') }}" alt="Password Icon">
            </div>

            <!-- Formulir di sebelah kanan -->
            <div class="form-container">
                <h3>Lupa Password</h3>
                <form action="{{ route('reset-password') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username') }}">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">New Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password" id="password" class="form-control">
                            <i class="fa fa-eye" id="togglePassword"></i>
                        </div>
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <div class="input-wrapper">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                            <i class="fa fa-eye" id="togglePasswordConfirm"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-custom">Reset Password</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // Ambil elemen input dan ikon
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    // Fungsi untuk toggle visibility password
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;

        // Toggle ikon mata
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', function () {
        const type = passwordConfirmInput.type === 'password' ? 'text' : 'password';
        passwordConfirmInput.type = type;

        // Toggle ikon mata
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
</script>

</html>