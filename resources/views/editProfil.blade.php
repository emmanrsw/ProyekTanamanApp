@extends('layout.navbar')

<style>
    .container-fluid {
        display: flex;
        max-width: 1300px;
        /* margin: 20px auto; */
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .sidebar {
        width: 190px;
        background-color: #fff;
        border-right: 1px solid #ddd;
        padding: 20px;
    }

    /* Wrapper untuk gambar dan info profil */
    .profile-info {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .sidebar img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }

    .sidebar h2 {
        font-size: 16px;
        margin: 0 10px;
        /* Jarak antara gambar dan tulisan */
    }

    .sidebar a {
        display: block;
        color: #333;
        text-decoration: none;
        padding: 10px 0;
        font-size: 14px;
    }

    .edit-profile {
        margin-left: auto;
        /* Posisi ikon edit ke paling kanan */
        font-size: 14px;
        cursor: pointer;
        color: #5B6B3A;
    }

    .sidebar a.active {
        color: #5B6B3A;
        font-weight: bold;
    }

    .sidebar a i {
        margin-right: 10px;
    }

    .content {
        flex: 1;
        padding: 20px;
    }

    .content h1 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .content p {
        color: #666;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .btn-primary {
        background-color: #5B6B3A;
        /* Button color */
        color: white;
        /* Text color */
        padding: 10px 20px;
        /* Padding */
        border: none;
        /* Remove border */
        border-radius: 5px;
        /* Rounded corners */
        cursor: pointer;
        /* Pointer cursor on hover */
        font-size: 16px;
        /* Font size */
        transition: background-color 0.3s;
        /* Smooth background color transition */
        text-align: center;
        /* Centered text */
        width: 15%;
        /* Full width */
        margin-top: 5px;
    }

    .btn-primary:hover {
        background-color: #4B553D;
        /* Button hover color */
    }
</style>

@section('content')
<div class="container-fluid p-0">
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="profile-info">
                <form action="{{ route('updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="profileImage" class="d-block">
                        @if($customer->gambarCust) <!-- Jika sudah ada gambar profil -->
                        <img src="{{ asset('uploads/' . $customer->gambarCust) }}" alt="Profile Picture"
                            class="rounded-circle" width="150" id="profileImagePreview">
                        @else <!-- Jika belum ada gambar profil, tampilkan ikon profil default -->
                        <i class="fas fa-user-circle" style="font-size: 100px; color: #ddd;"></i>
                        @endif
                        <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;"
                            onchange="this.form.submit();">
                    </label>
                </form>
            </div>

            <!-- Modal untuk upload gambar -->
            <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editProfileModalLabel">Ubah Gambar Profil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('updateProfilePicture') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="profileImageInput">Pilih Gambar</label>
                                    <input type="file" id="profileImageInput" name="profileImage" class="form-control"
                                        accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3 w-100">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <a class="active" href="#"><i class="fas fa-user"></i> Akun Saya</a>
        </div>

        <!-- Konten -->
        <div class="content">
            <h1>Profil Saya</h1>
            <p>Kelola informasi profil Anda untuk mengontrol, melindungi dan mengamankan akun</p>

            <!-- Form Profil Page -->
            <form action="{{ route('pelanggan.update') }}" method="POST">
                @csrf <!-- Token CSRF untuk keamanan -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="usernameCust" name="usernameCust" value="{{ $customer->usernameCust }}" required>
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" id="namaCust" name="namaCust" value="{{ $customer->namaCust }}" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="emailCust" name="emailCust" value="{{ $customer->emailCust }}" required>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" id="notlpCust" name="notlpCust" value="{{ $customer->notlpCust }}" required>
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" id="alamatCust" name="alamatCust" value="{{ $customer->alamatCust }}" required>
                </div>
                <button type="submit" class="btn btn-primary" style="float: left; margin-right: 10px;">Simpan</button>
                <a href="{{ route('pelanggan.profile') }}" class="btn btn-primary" style="float: left; margin-right: 10px;">Kembali</a>

            </form>
            <!-- Tombol Hapus Gambar (dalam form terpisah) -->
            @if ($customer->gambarCust)
            <form action="{{ route('pelanggan.hapusGambar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary" style="float: left; margin-right: 10px;">Hapus Gambar</button>
            </form>
            @endif


        </div>
    </div>
</div>
<script>
    // Update preview image after file selection
    document.getElementById('profileImage').addEventListener('change', function(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profileImagePreview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });
</script>>
@endsection