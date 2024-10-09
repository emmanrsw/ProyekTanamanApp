<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanamin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .header {
            background-color: #f0f0f0;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .search-bar {
            max-width: 600px;
            margin: 0 auto 20px auto;
        }

        .search-bar input[type="search"] {
            width: 100%;
            max-width: 500px;
            margin-right: 10px;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 20px;
        }

        .product {
            width: 300px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .product img {
            width: 100%;
            height: auto;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        .hamburger-menu {
            position: absolute;
            top: 10px;
            right: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" style="color: #333; font-size: 20px; font-weight: bold;">Tanam.In</a>
            <form class="d-flex" method="GET" action="" role="search" style="margin-right: 50px;">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="dropdown hamburger-menu">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            ☰
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#"><strong>Username:</strong> <span id="username"><?= session()->get('username') ?></span></a>
            <a class="dropdown-item" href="#"><strong>Email:</strong> <span id="email"><?= session()->get('email') ?></span></a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" id="logout" onclick="return confirmLogout()">Logout</a>
        </div>
    </div>

    <div class="product-container">
        <?php
        // Data tanaman dalam bentuk array asosiatif
        $plants = [
            [
                'name' => 'Anthurium Andraeanum',
                'description' => 'Tanaman Anthurium andraeanum memiliki daun besar, mengkilap bentuk hati dan bunga mencolok, terdiri atas warna warni dan spadix',
                'price' => '50000',
                'image_url' => 'https://i.pinimg.com/564x/71/7d/f3/717df3b830d0c9cc6ccd2a408b4b4075.jpg'
            ],

            [
                'name' => 'Pilea Peperomioides',
                'description' => 'Tanaman Pilea peperomioides adalah tanaman berbunga dalam keluarga jelatang Uticaceae, asli provinsi Yunnan dan Sichuan di Tiongkok Selatan',
                'price' => '100000',
                'image_url' => 'https://i.pinimg.com/564x/7e/0b/f5/7e0bf5b2eb4165f66f85ff4a98170faa.jpg'
            ],

            [
                'name' => 'Strelitzia Nicoli',
                'description' => 'Tanaman Strelitzia nicoli adalah spesies tanaman mirip daun pisang dengan batang tegak berkayu mencapai 7-8m, dan rumpun yang terbentuk dapat menyebar sejauh 3-5 m.',
                'price' => '600000',
                'image_url' => 'https://i.pinimg.com/564x/be/a2/a7/bea2a7386439b5cba688c597f2755833.jpg'
            ],

            [
                'name' => 'Anggrek Ngengat',
                'description' => 'Tanaman Anggrek Ngengat adalah tanaman asli Asia Tenggara. Ia memiliki dedaunan yang mengkilap, hijau sepanjang tahun, dan bunga kuning putih sebagai atributnya',
                'price' => '200000',
                'image_url' => 'https://i.pinimg.com/564x/21/d1/77/21d1772b0f2df2db386c512b419d7b12.jpg'
            ],

            [
                'name' => 'Calathea Makoyana',
                'description' => 'Tanaman Calathea Makoyana adalah spesies tumbuhan yang termasuk dalam genus Groppertia dalam famili Marantaceae, yang berasal dari negara Brazil bagian timur.',
                'price' => '300000',
                'image_url' => 'https://i.pinimg.com/564x/cd/44/06/cd44063fafd73e5e7dd53357c11c33ae.jpg'
            ],

            [
                'name' => 'Ficus Iyrata',
                'description' => 'Tanaman Ficus Iyrata adalah spesies tanaman berbunga dalam keluarga Murbei dan Moraceae. Spesies ini berasal dari Afrika barat, dari Kamerun barat hingga Sierra Leone',
                'price' => '100000',
                'image_url' => 'https://i.pinimg.com/564x/a6/c9/8f/a6c98f8ed810fd33e4017d4a210d4398.jpg'
            ],

            [
                'name' => 'Peperomia Obtusifolia',
                'description' => 'Tanaman Peperomia Obtusifolia adalah berbunga dalam genus Peperomia di bawah keluarga Piperaceae, yang berasal dari Florida, Meksiko, dan Karibia. Dan mendapat julukan berdaun tumpul.',
                'price' => '30000',
                'image_url' => 'https://i.pinimg.com/564x/08/57/9a/08579a70a259b9fc5f12c9453b98384e.jpg'
            ],

            [
                'name' => 'Dracaena Trifasciata',
                'description' => 'Tanaman Dracaena Trifasciata adalah spesies tumbuhan berbunga dalam keluarga Asparagaceae, berasal dari Afrika Barat tropis dari Nigeria timur hingga Kongo. Ia paling dikenal sebagai lidah ibu mertua',
                'price' => '20000',
                'image_url' => 'https://i.pinimg.com/564x/c4/0c/9f/c40c9f238dee598d968ba0c1b107b9b0.jpg'
            ],

            [
                'name' => 'Sirih Gading',
                'description' => 'Tanaman Sirih Gading adalah tanaman merambat semi epifit yang biasanya ditanam orang sebagai penghias perangan atau ruangan. Tumbuhan anggota suku talas-talsan ini dikenal dari warna daunnya yang belang.',
                'price' => '20000',
                'image_url' => 'https://i.pinimg.com/564x/0c/fa/27/0cfa274ffff5c2aec94718d054cb4987.jpg'
            ],

            [
                'name' => 'Ficus Elastica',
                'description' => 'Tanaman Ficus Elastica adalah spesies tumbuhan yang berasal dari genus ficus, asli timur laut India, Nepal, Bhutan, Myanmar, China, Malaysia dan Indonesia. Dan di bawa ke Sri Lanka, Hindia Barat.',
                'price' => '300000',
                'image_url' => 'https://i.pinimg.com/564x/68/aa/a5/68aaa56a6fbbba739567243761a3d238.jpg'
            ],

            [
                'name' => 'Haworthi Fasciata',
                'description' => 'Tanaman Haworthi Fasciata adalah spesies tanaman sukulen dari provinsi Eastern Cape, Afrika Selatan. Spesies ini jarang dibudidayakan, kebanyakan tumbuhan yang diberi label H.',
                'price' => '60000',
                'image_url' => 'https://i.pinimg.com/564x/c6/42/82/c64282526782e8a638894e6c8159af09.jpg'
            ],

            [
                'name' => 'Aloe Vera',
                'description' => 'Tanaman Aloe Vera adalah spesies tumbuhan dengan daun berdaging tebal dari genus Aloe. Tumbuhan ini bersifat menahun, berasal dari Jazirah Arab, dan tanaman liarnya telah menyebar ke kawasan beriklim tropis.',
                'price' => '60000',
                'image_url' => 'https://i.pinimg.com/736x/8d/52/16/8d5216e2a0d730d9374c7eaa6b31c690.jpg'
            ],
        ];

        // Mendapatkan nilai pencarian dari query string
        $searchQuery = isset($_GET['search']) ? strtolower($_GET['search']) : '';

        // Loop melalui data tanaman dan tampilkan jika sesuai dengan pencarian
        foreach ($plants as $plant) {
            if ($searchQuery === '' || strpos(strtolower($plant['name']), $searchQuery) !== false) {
                echo '<div class="product">';
                echo '<img src="' . htmlspecialchars($plant['image_url']) . '" alt="Product Image">';
                echo '<h3>' . htmlspecialchars($plant['name']) . '</h3>';
                echo '<p>' . htmlspecialchars($plant['description']) . '</p>';
                echo '<p>Rp' . htmlspecialchars($plant['price']) . '</p>';
                echo '<button class="btn btn-primary btn-add-to-cart" data-product=\'' . htmlspecialchars(json_encode($plant, JSON_HEX_APOS)) . '\'>Add to Cart</button>';
                echo '</div>';
            }
        }
        ?>
    </div>

    <div class="footer">
        <p>&copy; Tanamin E-commerce. All rights reserved.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk konfirmasi logout
        function confirmLogout() {
            return confirm('Are you sure you want to logout?');
        }

        // JQuery untuk menambah produk ke keranjang
        $(document).ready(function() {
            $('.btn-add-to-cart').click(function() {
                var product = $(this).data('product');
                var cart = JSON.parse(localStorage.getItem('cart')) || [];

                // Menambahkan produk ke keranjang
                var existingProduct = cart.find(p => p.name === product.name);
                if (existingProduct) {
                    existingProduct.quantity += 1; // Tambah kuantitas jika produk sudah ada di keranjang
                } else {
                    product.quantity = 1; // Tambahkan produk baru dengan kuantitas 1
                    cart.push(product);
                }

                // Simpan keranjang kembali ke localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Redirect ke halaman keranjang
                window.location.href = 'cart'; // Ganti ini dengan URL halaman keranjang Anda
            });
        });
    </script>
</body>

</html>