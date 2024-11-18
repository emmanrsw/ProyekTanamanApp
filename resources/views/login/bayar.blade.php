<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Sekarang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        /* Modal styling */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
        }
        .close-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 15px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .close-btn:hover {
            background-color: darkred;
        }
    </style>
</head>
<body>
    <button class="btn" id="payButton">BAYAR SEKARANG</button>

    <!-- Modal -->
    <div class="modal" id="payModal">
        <div class="modal-content">
            <h3>Konfirmasi Pembayaran</h3>
            <p>Apakah Anda yakin ingin melanjutkan pembayaran?</p>
            <button class="btn" onclick="proceedPayment()">Ya, Bayar</button>
            <button class="close-btn" onclick="closeModal()">Batal</button>
        </div>
    </div>

    <script>
        // Get button and modal elements
        const payButton = document.getElementById('payButton');
        const payModal = document.getElementById('payModal');

        // Show modal on button click
        payButton.addEventListener('click', () => {
            payModal.style.display = 'flex';
        });

        // Close modal
        function closeModal() {
            payModal.style.display = 'none';
        }

        // Proceed to payment (redirect or logic)
        function proceedPayment() {
            alert("Pembayaran sedang diproses...");
            closeModal();
            // Tambahkan logika pembayaran di sini, misalnya redirect ke halaman pembayaran
            window.location.href = "/transaksi"; // Ganti dengan URL pembayaran
        }
    </script>
</body>
</html>
