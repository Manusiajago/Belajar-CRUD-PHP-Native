<?php
session_start();

//set session 
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


//lakukan koneksi ke database terlebih dahulu
require 'koneksi.php';



//cek apakah tombol submit di tekan


if (isset($_POST['submit'])) {
    //cek apakah data berhasil ditambahkan atau tidak
    if (tambah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!')
                document.location.href = 'index.php';
            </script>";
    } else {
        "<script>
            alert('Data gagal ditambahkan!')
            document.location.href = 'index.php';
        </script>";
    }
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
</head>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama"> Nama : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="npm">Npm : </label>
                <input type="text" id="npm" name="npm" required>
            </li>
            <li>
                <label for="jurusan"> Jurusan : </label>
                <input type="text" id="jurusan" name="jurusan" required>
            </li>
            <li>
                <label for="email"> Email : </label>
                <input type="text" id="email" name="email" required>
            </li>
            <li>
                <label for="gambar"> Gambar : </label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit"> Tambah Data ! </button>
                <a href="index.php">Kembali ke halaman sebelumnya</a>
            </li>
        </ul>




    </form>



</body>

</html>