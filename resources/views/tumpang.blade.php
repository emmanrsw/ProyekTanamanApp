<<<<<<< HEAD
        @if (session('success'))
=======
    @if (session('success'))
        <script>
            Swal.fire({
                position: "center", // Muncul di tengah
                icon: "success", // Ikon sukses
                title: "{{ session('success') }}", // Pesan sukses
                showConfirmButton: false, // Tidak ada tombol konfirmasi
                timer: 1000, // Waktu tampil 3 detik
                customClass: {
                    popup: 'swal-wide' // Tambahkan kelas kustom untuk lebar popup
                }
            });
        </script>
    @endif

    <div class="cart-container">
        <!-- Bagian Keranjang Belanja -->
        <div class="cart-items">
            @if ($cartItems->isEmpty())
                <p>Keranjang Anda kosong.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Tanaman</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td><input type="checkbox" class="plant-checkbox" data-item-id="{{ $item->idTanaman }}"
                                        data-price="{{ $item->harga_satuan }}"
                                        data-total="{{ $item->jumlah * $item->harga_satuan }}"
                                        onclick="updateSubtotal()"></td>
                                <td>
                                    <!-- Menampilkan Gambar dan Nama Tanaman di Samping -->
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ asset('images/' . $item->tanaman->gambar) }}"
                                            alt="{{ $item->tanaman->namaTanaman }}"
                                            style="width: 50px; height: 50px; object-fit: cover;">
                                        <span>{{ $item->tanaman->namaTanaman }}</span>
                                    </div>
                                </td>
                                <td class="harga_satuan">{{ number_format($item->harga_satuan) }}</td>
                                <td>

                                    <div class="quantity-wrapper">
                                        <!-- Form untuk Mengurangi Jumlah -->
                                        <form method="POST"
                                            action="{{ route('cart.decreaseqty', ['rowId' => $item->idKeranjang]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn-minus">-</button>
                                        </form>

                                        <!-- Input untuk Menampilkan Jumlah -->
                                        <input type="text" class="jumlah-input" value="{{ $item->jumlah }}"
                                            data-id="{{ $item->idKeranjang }}" readonly>

                                        <!-- Form untuk Menambah Jumlah -->
                                        <form method="POST"
                                            action="{{ route('cart.increaseqty', ['rowId' => $item->idKeranjang]) }}">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn-plus">+</button>
                                        </form>
                                    </div>
                                </td>

                                <td id="total-{{ $item->idTanaman }}">
                                    {{ number_format($item->jumlah * $item->harga_satuan) }}
                                </td>
                                <td>
                                    <form id="delete-form-{{ $item->idTanaman }}"
                                        action="{{ route('cart.remove', $item->idTanaman) }}" method="POST">
                                        <!-- bagian cahyoooo benerin sini yaaa buat notif sebelum di hapus -->
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"
                                            onclick="confirmDelete('{{ $item->idTanaman }}')">Hapus</button>
                                    </form>

                                    <script>
                                        function confirmDelete(itemId) {
                                            Swal.fire({
                                                title: "Apakah Anda yakin?",
                                                text: "Item ini akan dihapus dari keranjang!",
                                                icon: "warning",
                                                showCancelButton: true,
                                                confirmButtonColor: "#3085d6",
                                                cancelButtonColor: "#d33",
                                                confirmButtonText: "Ya, hapus!",
                                                cancelButtonText: "Batal"
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    // Submit form jika pengguna mengonfirmasi
                                                    document.getElementById('delete-form-' + itemId).submit();
                                                }
                                            });
                                        }
                                    </script>
                                    <!-- bagian cahyoooo benerin sini yaaa buat notif sebelum di hapus -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Bagian Jumlah Keranjang -->
        <div class="cart-summary">
            <h5>Ringkasan Keranjang</h5>
            <table>
                <tr>
                    <td>SUBTOTAL</td>
                    <td class="subtotal">Rp0</td>
                </tr>
                <tr>
                    <td>PAJAK (5%)</td>
                    <td id="tax">Rp0</td>
                </tr>
                <tr class="total">
                    <td>TOTAL</td>
                    <td>Rp0</td>
                </tr>
            </table>

            <form action="{{ route('transaksi') }}" method="POST" id="checkoutForm">
                @csrf
                <!-- Elemen hidden input untuk mengirim data checkbox -->
                <input type="hidden" name="selectedItems" id="selectedItems">
                <button type="submit" class="checkout-btn" id="checkoutButton" disabled>Lanjutkan Ke
                    Pembayaran</button>
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
>>>>>>> 83717685cb7613c833d0481ed5920688926333e9