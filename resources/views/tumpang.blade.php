    <!-- // ----------------------------------------------------------------------------------------------------------------------- -->
    <!-- <script>
        // ini barangnya gak ada samsek
        isBarangAda = false; // Ganti dengan kondisi nyata dari data Anda
        // Cek jika ada barang atau tidak
        if (isBarangAda) {

            // lgsg table
            document.getElementById("messageText").innerText = "Barang sudah ada!";
            document.getElementById("belanjaBtn").style.display = "none"; // Sembunyikan tombol belanja
        } else {
            document.getElementById("messageText").innerText = "Belum Ada! Silahkan klik dibawah ini.";
            document.getElementById("belanjaBtn").style.display = "inline-block"; // Tampilkan tombol belanja
        }
    </script> -->
    <!-- // ----------------------------------------------------------------------------------------------------------------------- -->








// -----------------------------------------------------------------------------------------------------------------------
        // document.getElementById("sedangDikemas").addEventListener("click", function () {
        // // Sembunyikan #message1
        // document.getElementById("message1").style.display = "none";

        // // Tampilkan pesan di bawah banner
        // var messageElement = document.getElementById("message");
        // messageElement.textContent = "Tidak ada barang yang sedang dikemas";
        // messageElement.style.display = "block";

        // // Reset semua tombol dan atur tombol ini sebagai aktif
        // resetActive();
        // this.classList.add("active");
        // });

        // -----------------------------------------------------------------------------------------------------------------------
        // document.getElementById("dikirim").addEventListener("click", function () {
        // // Sembunyikan #message1
        // document.getElementById("message1").style.display = "none";

        // // Tampilkan pesan di bawah banner
        // var messageElement = document.getElementById("message");
        // messageElement.textContent = "Tidak ada barang yang dikirim";
        // messageElement.style.display = "block";

        // // Reset semua tombol dan atur tombol ini sebagai aktif
        // resetActive();
        // this.classList.add("active");
        // });

        // -----------------------------------------------------------------------------------------------------------------------
        // document.getElementById("selesai").addEventListener("click", function () {
        // // Sembunyikan #message1
        // document.getElementById("message1").style.display = "none";

        // // Tampilkan pesan di bawah banner
        // var messageElement = document.getElementById("message");
        // messageElement.textContent = "Belum ada barang yang terselesaikan";
        // messageElement.style.display = "block";

        // // Reset semua tombol dan atur tombol ini sebagai aktif
        // resetActive();
        // this.classList.add("active");
        // });

        // -----------------------------------------------------------------------------------------------------------------------























           <!-- Elemen pesan yang akan ditampilkan di bawah banner -->
    <div id="message1"
        style="text-align: center; font-size: 1.2rem; color: #333; margin-top: 150px; position: relative;">
        <!-- Ikon sebagai watermark -->
        <i class="fa-brands fa-shopify"
            style="font-size: 20rem; color: rgba(0, 0, 0, 0.1); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: -1;"></i>

        <p id="messageText" style="margin-bottom: 10px;"></p>

        <a href="#" class="btn btn-custom mt-3" id="belanjaBtn" style="display: none;">Belanja Sekarang</a>
    </div>

    <!-- <script>
        isBarangAda = true; // Ganti dengan kondisi nyata dari data Anda

        if (isBarangAda) {
            // Ubah teks dan tampilkan indikator barang sudah ada
            document.getElementById("messageText").innerText = "Cek Status Pemesanan!";
            document.getElementById("messageText").className = "barangAda"; // Menambahkan kelas untuk styling

            // Sembunyikan tombol belanja
            document.getElementById("belanjaBtn").classList.add("hidden");
        } else {
            // Ubah teks dan tampilkan indikator barang belum ada
            document.getElementById("messageText").innerText = "Belum Ada! Silahkan klik dibawah ini.";
            document.getElementById("messageText").className = "barangTidakAda"; // Menambahkan kelas untuk styling

            // Tampilkan tombol belanja
            document.getElementById("belanjaBtn").classList.remove("hidden");
        }
    </script> -->