<!DOCTYPE html>
    <html>

    <head>
        <title>Login</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                display: flex;
                height: 100vh;
                margin: 0;
            }

            .image-section {
                flex: 1;
                background: url('https://i.pinimg.com/564x/a6/c9/8f/a6c98f8ed810fd33e4017d4a210d4398.jpg') no-repeat center center;
                background-size: cover;
            }

            .form-section {
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
                padding: 20px;
            }

            .form-container {
                width: 100%;
                max-width: 400px;
            }
        </style>
    </head>

    <body>

        <div class="image-section"></div>
        <div class="form-section">
            <div class="form-container">
                <h1>Tanam.In</h1>
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
                <form method="POST" action="{{ route('loginProcess') }}">
                    @csrf <!-- Token untuk keamanan dari Laravel -->

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="stayLoggedIn">
                        <label class="form-check-label" for="stayLoggedIn">Biarkan saya tetap masuk</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <p><a href="{{ route('forgot-password') }}">Lupa Password?</a></p>
                <p><a href="{{ route('register') }}">Register</a></p>

            </div>
        </div>
    </body>

    </html>