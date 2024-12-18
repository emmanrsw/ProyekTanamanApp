
// function addToCart(productId) {
        //     fetch(`/cart/add/${productId}`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify({
        //                 productId: productId
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             alert(data.message || "Produk berhasil ditambahkan ke keranjang!");
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // }
        // function addToCart(productId) {
        //     // Ambil jumlah dari input yang ada di modal
        //     const jumlah = document.getElementById('jumlah').value;

        //     // Pastikan jumlah adalah angka yang valid
        //     if (jumlah < 1) {
        //         alert('Jumlah tidak valid');
        //         return;
        //     }

        //     fetch(`/cart/add/${productId}`, {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        //             },
        //             body: JSON.stringify({
        //                 productId: productId,
        //                 jumlah: jumlah // Kirimkan jumlah yang dimasukkan pengguna
        //             })
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             Swal.fire({
        //                 title: 'Berhasil!',
        //                 text: data.message || "Produk berhasil ditambahkan ke keranjang!",
        //                 icon: 'success',
        //                 confirmButtonText: 'OK'
        //             })
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // }










function addToCart(productId) {
            // Ambil jumlah dari input yang ada di modal
            const jumlah = document.getElementById('jumlah').value;

            // Debugging: Cek apakah jumlah sudah terambil dengan benar
            console.log('Jumlah:', jumlah);

            // Pastikan jumlah adalah angka yang valid dan lebih besar dari 0
            if (isNaN(jumlah) || jumlah < 1) {
                alert('Jumlah tidak valid. Masukkan angka yang lebih besar dari 0.');
                return;
            }

            // Cek apakah CSRF token ada
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            if (!csrfToken) {
                console.error('CSRF Token tidak ditemukan!');
                alert('Terjadi masalah dengan CSRF token.');
                return;
            }

            // Menampilkan data yang akan dikirim untuk debugging
            console.log('Mengirim data ke server:', {
                productId: productId,
                jumlah: jumlah
            });

            // Kirim data ke server menggunakan Fetch API
            fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        productId: productId,
                        jumlah: jumlah // Kirimkan jumlah yang dimasukkan pengguna
                    })
                })
                // .then(response => {
                //     if (!response.ok) {
                //         throw new Error('Response tidak berhasil');
                //     }
                //     return response.json();
                // })
                .then(response => response.json())
                .then(data => {
                    // Menampilkan notifikasi sukses dengan SweetAlert
                    Swal.fire({
                        title: 'Berhasil!',
                        text: data.message || "Produk berhasil ditambahkan ke keranjang!",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                })
                .catch(error => {
                    // Menangani error jika ada masalah saat pengiriman
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Terjadi kesalahan, silakan coba lagi.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
        }

        function sortProducts() {
            const sortBy = document.querySelector('.sort-by').value;

            // Mengarahkan ke URL dengan query string untuk pengurutan
            window.location.href = `?sortBy=${sortBy}`;
        }

        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }