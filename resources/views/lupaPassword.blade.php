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
    /* CSS untuk Halaman Lupa Username / Password */
    .reset-password-form {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 50px auto;
    }

    .reset-password-form h3 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .reset-password-form .form-group {
        margin-bottom: 20px;
    }

    .reset-password-form label {
        font-size: 14px;
        font-weight: bold;
        color: #555;
    }

    .reset-password-form .form-control {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-top: 5px;
    }

    .reset-password-form .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .reset-password-form .alert-danger {
        font-size: 14px;
        color: #e74c3c;
        margin-top: 5px;
    }

    .reset-password-form button {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .reset-password-form button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 576px) {
        .reset-password-form {
            padding: 20px;
            margin: 20px;
        }

        .reset-password-form h3 {
            font-size: 20px;
        }

        .reset-password-form .form-control {
            font-size: 16px;
        }

        .reset-password-form button {
            font-size: 14px;
        }
    }
</style>

<body>

    <div class="container">
        <h3>Lupa Username / Password</h3>
        <form action="{{ route('reset-password') }}" method="POST" class="reset-password-form">
            @csrf

            <div class="form-group">
                <label for="username">Username (optional)</label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}">
                @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">New Password (optional)</label>
                <input type="password" name="password" id="password" class="form-control">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Reset Username / Password</button>
        </form>
    </div>

</body>

</html>
