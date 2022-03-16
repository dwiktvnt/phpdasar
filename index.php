<?php
session_start();
require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$mahasiswa = query("SELECT * FROM mahasiswa");

if (isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Halaman Admin</title>
</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah Data Mahasiswa</a><br><br>

    <form action="" method="post">
        <input type="text" name="keyword" autofocus placeholder="Masukan Kata Kunci" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </form><br><br>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Foto Mahasiswa</th>
                    <th scope="col">Nama Mahasiswa</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jurusan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>

            <?php $i = 1; ?>
            <?php foreach ($mahasiswa as $row) : ?>

                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><img src="img/<?= $row["foto"] ?>" width=100></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["nim"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["jurusan"] ?></td>
                    <td>
                        <a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin Ingin Menghapus')">Hapus</a> |
                        <a href="ubah.php?id=<?= $row["id"] ?>">Ubah</a>
                    </td>
                    <?php $i++ ?>
                </tr>

            <?php endforeach ?>
        </table>
    </div>
    <p><a href="logout.php">Logout</a></p>
</body>

</html>