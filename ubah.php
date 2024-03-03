<?php
session_start();

//set session
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


//lakukan koneksi ke database terlebih dahulu
require 'koneksi.php';

//ambil data dari URL 
$id = $_GET['id'];

//Query data mahasiswa berdasarkan id
$querydatamhs = query(" SELECT * FROM mahasiswa WHERE id = $id")[0];





//cek apakah tombol submit di tekan
if (isset($_POST['submit'])) {
    //cek apakah data berhasil ditambahkan atau tidak
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!')
                document.location.href = 'index.php';
            </script>";
    } else {
        "<script>
            alert('Data gagal diubah!')
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
    <title>Ubah Data Mahasiswa</title>
</head>

<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <input type="hidden" name="id" value=" <?php echo $querydatamhs['id'] ?>">
                <input type="hidden" name="gambarLama" value=" <?php echo $querydatamhs['gambar'] ?>">
            </li>
            <li>
                <label for="nama"> Nama : </label>
                <input type="text" name="nama" id="nama" required value="<?php echo $querydatamhs['nama'] ?>">
            </li>
            <li>
                <label for="npm">Npm : </label>
                <input type="text" id="npm" name="npm" required value="<?php echo $querydatamhs['npm'] ?>">
            </li>
            <li>
                <label for="jurusan"> Jurusan : </label>
                <input type="text" id="jurusan" name="jurusan" required value=" <?php echo $querydatamhs['jurusan'] ?>">
            </li>
            <li>
                <label for="email"> Email : </label>
                <input type="text" id="email" name="email" required value=" <?php echo $querydatamhs['email'] ?>">
            </li>
            <li>
                <label for="gambar"> Gambar : </label> <br>
                <img src="img/<?php echo $querydatamhs['gambar'] ?>" alt="" width="40"> <br>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit"> Ubah Data ! </button>
                <a href="index.php">Kembali ke halaman sebelumnya</a>
            </li>
        </ul>




    </form>



</body>

</html>