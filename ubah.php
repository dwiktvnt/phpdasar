<?php

require 'function.php';

$id = $_GET['id'];

$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "<script>
            alert('data berhasil ubah');
            document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
            alert('data gagal diubah');
            document.location.href = 'index.php';
            </script>";
    }
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
</head>

<body>
    <h1>Ubah Data Mahasiswa</h1>

    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
        <table border="0">
            <tr>
                <td>Nama Mahasiswa</td>
                <td><input type="text" name="nama" required value="<?= $mhs["nama"]; ?>"></td>
            </tr>
            <tr>
                <td>NIM</td>
                <td><input type="text" name="nim" required value="<?= $mhs["nim"]; ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email" required value="<?= $mhs["email"]; ?>"></td>
            </tr>
            <tr>
                <td>Jurusan</td>
                <td><input type="text" name="jurusan" value="<?= $mhs["jurusan"]; ?>"></td>
            </tr>
        </table>
        <button type="submit" name="submit">Ubah</button>



    </form>
</body>

</html>