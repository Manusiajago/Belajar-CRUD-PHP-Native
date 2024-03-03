<?php
session_start();

//cek session user
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

//meminta dari file koneksi.php
require 'koneksi.php';

$mahasiswa = query("SELECT * FROM mahasiswa");

// tombol cari di tekan 
if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa R7I</title>
    <style>
        .links {
            width: 200px;
            height: 50px;
            background-color: greenyellow;
            margin-top: 50px;
            text-decoration: none;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
        }

        .links a {
            text-decoration: none;
            color: white;
            font-size: 15px;
        }

        .links:hover {
            background-color: black;
            color: white;
            transition: 0.5s;
        }
    </style>
</head>

<body>
    <a href="logout.php">Logout!</a>

    <h1>Daftar Mahasiswa R7I</h1>

    <form action="" method="POST">
        <input type="text" name="keyword" autofocus size="40" placeholder="Masukkan Keyword Pencarian" autocomplete="off">
        <button type="submit" name="cari"> Cari ! </button>
    </form>
    <br>



    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Npm</th>
            <th>Jurusan</th>
            <th>Email</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $mhs) : ?>
            <tr>
                <td> <?= $i ?></td>
                <td> <?= $mhs["nama"] ?></td>
                <td> <?= $mhs["npm"] ?></td>
                <td> <?= $mhs["jurusan"] ?></td>
                <td> <?= $mhs["email"] ?></td>
                <td><img src="img/<?= $mhs["gambar"] ?>" alt="" width="50"></td>
                <td>
                    <a href="ubah.php?id=<?php echo $mhs['id'] ?>">ubah</a> |
                    <a href="hapus.php?id=<?php echo $mhs['id']; ?>" onclick=" return confirm('Apakah anda yakin?')">hapus</a>

                </td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>







    </table>

    <div class="links">
        <a href="tambah.php">Tambah Data Mahasiswa</a>
    </div>


</body>

</html>