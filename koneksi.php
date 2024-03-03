<?php

//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "unindra");

//query database
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
};


function tambah($data)
{
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $npm = htmlspecialchars($data['npm']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $email = htmlspecialchars($data['email']);

    //upload gambar 
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES ('' , '$nama', '$npm', '$jurusan', '$email', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
};

function hapus($id)
{
    global $conn;
    mysqli_query($conn, " DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
};

function ubah($data)
{
    global $conn;
    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $npm = htmlspecialchars($data['npm']);
    $jurusan = htmlspecialchars($data['jurusan']);
    $email = htmlspecialchars($data['email']);
    $gambarLama = htmlspecialchars($data['gambarLama']);

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    //upload gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }

    $query = "UPDATE mahasiswa SET 
            nama = '$nama',
            npm = '$npm',
            jurusan = '$jurusan',
            email = '$email',
            gambar = '$gambar'
            
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = " SELECT * FROM mahasiswa 
                WHERE nama LIKE '%$keyword%' OR 
                npm LIKE '%$keyword%' OR 
                jurusan LIKE '%$keyword%' OR
                email LIKE '%$keyword%'
                 ";

    return query($query);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    //cek apakah tidak ada gambar yg di upload
    if ($error === 4) {
        echo "<script>
           alert('pilih gambar terlebih dahulu')
        </script>";
        return false;
    };

    //cek apakah yg di upload adalah gambar 
    $ekstensiGambarValid = ['jpeg', 'jpg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo
        "<script>
        alert('yang anda upload bukan gambar')
            </script>";
        return false;
    }

    if ($ukuranFile > 1000000) {
        echo
        "<script>
        alert('Ukuran gambar terlalu besar')
            </script>";
        return false;
    }



    //generate nama baru / dapatkan nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    //lolos pengecekan , gambar siap di upload 
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


    return $namaFileBaru;
};


function registrasi($data)
{
    global $conn;

    //tangkap data yg dikirimkan ke parameter $data
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek apakah username sudah ada atau belum
    $result = mysqli_query($conn, " SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo
        "<script>
                alert('Username sudah ada , silahkan ulangi masukkan username !');
        </script>";

        return false;
    }

    //cek konfirmasi password
    if ($password !== $password2) {
        echo
        "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";

        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('' , '$username' , '$password')");

    return mysqli_affected_rows($conn);
}
