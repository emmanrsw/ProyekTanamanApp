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
                <h3>Lupa Username / Password</h3>
                <form action="{{ route('reset-password') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="username">Username (optional)</label>
                        <input type="text" name="username" id="username" class="form-control"
                            value="{{ old('username') }}">
                        @error('username')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">New Password (optional)</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control">
                    </div>

                    <button type="submit" class="btn btn-custom">Reset Username / Password</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>