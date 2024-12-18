<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP</title>
    <style>
        /* Styling sederhana untuk form */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .container {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background: white;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: orange;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: darkorange;
        }

        .error {
            color: red;
        }

        .status {
            color: green;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Verifikasi OTP</h1>

        <!-- Status pesan -->
        @if(session('status'))
        <div class="status">{{ session('status') }}</div>
        @endif
        @if(session('error'))
        <div class="error">{{ session('error') }}</div>
        @endif

        <!-- Form Input OTP -->
        <form method="POST" action="{{ route('otp.verify') }}">
            @csrf
            <div>
                <label for="otp">Masukkan OTP yang telah dikirim ke nomor telepon</label>
                <input type="text" name="otp" id="otp" placeholder="Masukkan 6 digit OTP" required>
            </div>
            <button type="submit">Verifikasi OTP</button>
        </form>

    </div>

</body>

</html>
