<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background-color: #4B553D;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 22px;
            font-weight: bold;
        }

        .content {
            padding: 30px;
        }

        .icon-box {
            text-align: center;
            margin-bottom: 20px;
        }

        .icon-box img {
            width: 120px;
            height: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            border-color: #4B553D;
            outline: none;
        }

        .btn-custom {
            background-color: #4B553D;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #3d4434;
        }

        .status {
            color: green;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
            }

            .icon-box img {
                width: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Verifikasi OTP</div>
        <div class="content">
            <!-- Gambar -->
            <div class="icon-box">
                <img src="{{ asset('Img/forgot-password.png') }}" alt="OTP Icon">
            </div>

            <!-- Status pesan -->
            @if(session('status'))
                <div class="status">{{ session('status') }}</div>
            @endif

            @if(session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif

            <!-- Form -->
            @if (!session('otp_sent')) <!-- Jika OTP belum dikirim -->
                <form method="POST" action="{{ route('otp.send') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nomor">Nomor Telepon</label>
                        <input type="text" name="nomor" id="nomor" class="form-control" placeholder="62812xxxx" required>
                    </div>
                    <button type="submit" class="btn-custom">Kirim OTP</button>
                </form>
            @else
                <form method="POST" action="{{ route('otp.verify') }}">
                    @csrf
                    <div class="form-group">
                        <label for="otp">Masukkan OTP</label>
                        <input type="text" name="otp" id="otp" class="form-control" placeholder="Masukkan 6 digit OTP" required>
                    </div>
                    <button type="submit" class="btn-custom">Verifikasi OTP</button>
                </form>
            @endif
        </div>
    </div>
</body>

</html>
