<?php
date_default_timezone_set('Asia/Jakarta');

// Koneksi ke database
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'proyekinf';
$conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Fungsi untuk membersihkan input
function cleanInput($data)
{
    return htmlspecialchars(trim($data));
}

// Menghapus OTP lama
function hapusOTP($conn, $idCust)
{
    $deleteQuery = "DELETE FROM otp WHERE idCust = '$idCust'";
    return mysqli_query($conn, $deleteQuery);
}

// Mengirim OTP via API Fonnte
function kirimOTP($nomor, $otp)
{
    $data = [
        'target' => $nomor,
        'message' => "Kode OTP Anda adalah: $otp"
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["Authorization: WZnBcwQ94dJrZA9ZzcLu"]); // Ganti dengan token API Anda
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}

// Proses Request OTP
if (isset($_POST['submit-otp'])) {
    $idCust = cleanInput($_POST['idCust']);

    if (!empty($idCust)) {
        // Ambil nomor telepon berdasarkan idCust
        $queryCust = "SELECT notelpCust FROM pelanggan WHERE idCust = '$idCust'";
        $resultCust = mysqli_query($conn, $queryCust);

        if ($resultCust && mysqli_num_rows($resultCust) > 0) {
            $row = mysqli_fetch_assoc($resultCust);
            $nomor = $row['notelpCust'];

            // Format nomor agar sesuai (+62)
            if (substr($nomor, 0, 1) === '0') {
                $nomor = "+62" . substr($nomor, 1);
            }

            // Hapus OTP lama
            hapusOTP($conn, $idCust);

            // Generate OTP baru
            $otp = rand(100000, 999999);
            $waktu = time();

            // Simpan OTP ke tabel otp
            $insertQuery = "INSERT INTO otp (idCust, otp, waktu) VALUES ('$idCust', '$otp', '$waktu')";
            if (mysqli_query($conn, $insertQuery)) {
                // Kirim OTP via Fonnte
                $response = kirimOTP($nomor, $otp);
                if ($response) {
                    echo "OTP berhasil dikirim ke nomor: $nomor";
                } else {
                    echo "Gagal mengirim OTP.";
                }
            } else {
                echo "Error menyimpan OTP: " . mysqli_error($conn);
            }
        } else {
            echo "ID pelanggan tidak ditemukan.";
        }
    }
}

// Proses Verifikasi OTP
if (isset($_POST['submit-login'])) {
    $idCust = cleanInput($_POST['idCust']);
    $otp = cleanInput($_POST['otp']);

    $query = "SELECT * FROM otp WHERE idCust = '$idCust' AND otp = '$otp'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        if (time() - $data['waktu'] <= 300) { // OTP berlaku 5 menit
            echo "OTP valid, login berhasil!";
        } else {
            echo "OTP kadaluarsa.";
        }
    } else {
        echo "OTP salah.";
    }
}

mysqli_close($conn);



// if (isset($_POST['submit-otp'])) {
//     $nomor = mysqli_escape_string($conn, $_POST['nomor']);
//     if ($nomor) {
//         if (!mysqli_query($conn, "DELETE FROM otp WHERE nomor = $nomor")) {
//             echo ("Error description: " . mysqli_error($con));
//         }
//         $curl = curl_init();
//         $otp = rand(100000, 999999);
//         $waktu = time();
//         mysqli_query($conn, "INSERT INTO otp (nomor,otp,waktu) VALUES ( $nomor ,$otp , $waktu )");
//         $data = [
//             'target' => $nomor,
//             'message' => "Your OTP : " . $otp
//         ];

//         curl_setopt(
//             $curl,
//             CURLOPT_HTTPHEADER,
//             array(
//                 "Authorization: TOKEN",
//             )
//         );
//         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
//         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
//         curl_setopt($curl, CURLOPT_URL, "https://api.fonnte.com/send");
//         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//         $result = curl_exec($curl);
//         curl_close($curl);
//     }
// } elseif (isset($_POST['submit-login'])) {
//     $otp = mysqli_escape_string($conn, $_POST['otp']);
//     $nomor = mysqli_escape_string($conn, $_POST['nomor']);
//     $q = mysqli_query($conn, "SELECT * FROM otp WHERE nomor = $nomor AND otp = $otp");
//     $row = mysqli_num_rows($q);
//     $r = mysqli_fetch_array($q);
//     if ($row) {
//         if (time() - $r['waktu'] <= 300) {
//             echo "otp benar";
//         } else {
//             echo "otp expired";
//         }
//     } else {
//         echo "otp salah";
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Form OTP</title>
</head>

<body>
    <form method="POST" action="" accept-charset="utf-8" style="margin: 100px auto;box-shadow: 0 0 15px -2px lightgray;width:100%;max-width:600px;padding:20px;box-sizing:border-box;">
        <h1 style="text-align: center;">OTP</h1>
        <center>

            <div style="display: <?php echo isset($_POST['submit-otp']) ? "none" : "flex" ?>;flex-direction:column;margin-bottom:10px;box-sizing:border-box;"><label for="nomor" style="text-align: left;margin-bottom:5px;">Nomor</label> <input placeholder="62812xxxx" name="nomor" type="text" id="nomor" required style="padding:8px;border:2px solid lightgray;border-radius:5px;" <?php if (isset($_POST['submit-otp'])) {
                                                                                                                                                                                                                                                                                                                                                                                                echo "value='$nomor' hidden";
                                                                                                                                                                                                                                                                                                                                                                                            } ?> /></div>
            <?php
            if (isset($_POST['submit-otp'])) { ?>
                <div style="display: flex;flex-direction:column;margin-bottom:10px;"><label for="otp" style="text-align: left;margin-bottom:5px;box-sizing:border-box;">OTP</label> <input placeholder="xxxxxx" name="otp" type="text" id="otp" style="padding:8px;border:2px solid lightgray;border-radius:5px;" /></div>
            <?php }
            if (!isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-otp" style="background-color: orange;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-otp">Request otp</button>
            <?php }
            if (isset($_POST['submit-otp'])) { ?>
                <button type="submit" id="btn-login" style="background-color:darkturquoise;border:none;padding:8px 16px;color:white;cursor:pointer;" name="submit-login">Login</button>
            <?php }  ?>
        </center>
    </form>


</body>

</html>