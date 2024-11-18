<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanam.in Checkout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        header .logo {
            font-size: 24px;
            font-weight: bold;
        }

        header .logo span {
            color: #4CAF50;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #000;
            font-weight: 500;
        }

        nav a.home {
            color: #4CAF50;
        }

        .main-content {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .product-details,
        .summary {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-details {
            width: 60%;
        }

        .summary {
            width: 35%;
        }

        .product-details h2,
        .summary h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .product-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-details table th,
        .product-details table td {
            padding: 10px;
            text-align: left;
        }

        .product-details table th {
            background-color: #f1f1f1;
        }

        .product-details table td {
            border-bottom: 1px solid #f1f1f1;
        }

        .product-details .total {
            font-size: 24px;
            color: #FF5722;
            text-align: right;
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-methods h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .payment-methods label {
            display: block;
            margin-bottom: 10px;
        }

        .payment-methods input {
            margin-right: 10px;
        }

        .payment-methods .note {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
        }

        .payment-methods .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }

        .summary .shipping-info,
        .summary .payment-card {
            margin-bottom: 20px;
        }

        .summary .shipping-info h3,
        .summary .payment-card h3 {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .summary .shipping-info p,
        .summary .payment-card p {
            font-size: 14px;
            color: #666;
        }

        .summary .payment-card img {
            margin-right: 10px;
        }

        footer {
            margin-top: 40px;
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
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">Tanam.<span>in</span></div>
            <nav>
                <a class="home" href="#">Home</a>
                <a href="#">Tanaman</a>
                <a href="#">Kontak</a>
                <a href="#">Tentang Kami</a>
                <a href="#">Tanaman Saya</a>
            </nav>
        </header>
        <div class="main-content">
            <div class="product-details">
                <h2>Product</h2>
                <table>
                    <tr>
                        <th>Product</th>
                        <th>Subtotal</th>
                    </tr>
                    <tr>
                        <td>KUPING GAJAH x 1</td>
                        <td>Rs. 250,000.00</td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>Rs. 250,000.00</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td class="total">Rs. 250,000.00</td>
                    </tr>
                </table>
                <div class="payment-methods">
                    <h3>Direct Bank Transfer</h3>
                    <label>
                        <input type="radio" name="payment" checked /> Direct Bank Transfer
                    </label>
                    <p class="note">
                        Silakan lakukan pembayaran langsung ke rekening bank kami. Harap gunakan ID Pesanan Anda sebagai referensi pembayaran. Pesanan Anda tidak akan dikirimkan sampai dana kami terima di rekening.
                    </p>
                    <label>
                        <input type="radio" name="payment" /> Transfer
                    </label>
                    <label>
                        <input type="radio" name="payment" /> Cash On Delivery
                    </label>
                    <p class="note">
                        Data pribadi Anda akan digunakan untuk mendukung pengalaman Anda di seluruh situs web ini, untuk mengelola akses ke akun Anda, dan untuk tujuan lain yang dijelaskan dalam kebijakan privasi kami.
                    </p>
                    <button class="btn">BAYAR SEKARANG</button>
                </div>
            </div>
            <div class="summary">
                <div class="shipping-info">
                    <h3>Shipping Information</h3>
                    <p>
                        Mirpur-10, Road 14A<br />
                        Dhaka, Bangladesh<br />
                        01758187028
                    </p>
                    <a href="#">Change Address <i class="fas fa-pencil-alt"></i></a>
                </div>
                <div class="payment-card">
                    <h3>Select Your Payment Card</h3>
                    <label>
                        <input type="radio" name="card" checked />
                        <img src="https://storage.googleapis.com/a1aa/image/EBXiwn3HbkJcN9k0yCiMeNvBjCLLJ1g6RBr0SslU0EGWuw4JA.jpg" alt="Visa logo" width="30" height="20" />
                        <img src="https://storage.googleapis.com/a1aa/image/WABOH5SCRKItDtUViI1TbYIgohgAqCJwXUfVJqJggAVVuw4JA.jpg" alt="MasterCard logo" width="30" height="20" />
                        <img src="https://storage.googleapis.com/a1aa/image/J9aaATYV4xadIZwuJnr9f6fUN5iRMM9iwdQap2iCkGGpchxTA.jpg" alt="American Express logo" width="30" height="20" />
                        <img src="https://storage.googleapis.com/a1aa/image/VPPaTZOU0s5JNFb94bQz702xYGiUdGcHvfwAkJab0zmVuw4JA.jpg" alt="bKash logo" width="30" height="20" />
                    </label>
                    <label>
                        <input type="radio" name="card" /> Cash on Delivery
                    </label>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer-links">
                <div>
                    <h4>COMPANY INFO</h4>
                    <a href="#">About Us</a>
                    <a href="#">Latest Posts</a>
                    <a href="#">Contact Us</a>
                </div>
                <div>
                    <h4>HELP LINKS</h4>
                    <a href="#">Tracking</a>
                    <a href="#">Order Status</a>
                    <a href="#">Delivery</a>
                    <a href="#">Shipping Info</a>
                    <a href="#">FAQ</a>
                </div>
                <div>
                    <h4>USEFUL LINKS</h4>
                    <a href="#">Special Offers</a>
                    <a href="#">Gift Cards</a>
                    <a href="#">Advertising</a>
                    <a href="#">Terms of Use</a>
                </div>
            </div>
            <p>
                © 2020 Tanam.in eCommerce<br />
                Privacy Policy | Terms & Conditions
            </p>
        </footer>
    </div>
</body>

</html>
