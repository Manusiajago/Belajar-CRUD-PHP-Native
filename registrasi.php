<?php
//panggil ke halaman koneksi
require "koneksi.php";

//validasi ketika tombol register di tekan
if (isset($_POST["register"])) {
    //cek apakah data berhasil di tambah atau tidak
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('data berhasil di tambah!')
            </script>";
    } else {
        echo mysqli_error($conn);
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>

<body>

    <h2>Registrasi Form</h2>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username"> Username : </label>
                <input type="text" name="username" id="username" placeholder="Masukkan Username" autocomplete="off">
            </li>
            <li>
                <label for="password"> Password : </label>
                <input type="password" name="password" id="password" placeholder="Masukkan Password" autocomplete="off">
            </li>
            <li>
                <label for="password2"> Konfirmasi Password </label>
                <input type="password" name="password2" id="password2" placeholder="Konfirmasi Password" autocomplete="off">
            </li>
            <li>
                <button type="submit" name="register"> Sign Up</button>
            </li>
        </ul>
    </form>
</body>

</html>