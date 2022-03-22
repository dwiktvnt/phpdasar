<?php
session_start();
require 'function.php';

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//pagination

//tentukan jumlah data perhalaman
$jumlahDataPerhalaman = 3;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
// menentukan jumlah halaman
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);
// menentukan halaman aktif
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
// menentuka data dari halaman aktif
$dataAwal = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $dataAwal, $jumlahDataPerhalaman");

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
    <style>
        h1 {
            text-align: center;
        }

        .btn {
            margin-left: 2%;
        }

        .btn-primary {
            margin-left: 93%;
        }

        form {
            margin-left: 2%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Daftar Mahasiswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">Test</span>
            </button>
            <form method="post" class="d-flex flex-row">
                <input class="form-control me-2" name="keyword" type="text" placeholder="Masukan Kata Kunci" autocomplete="off">
                <button class="btn btn-outline-success" type="submit" name="cari">Search</button>
            </form>

        </div>

    </nav>



    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php" class="btn btn-success">Tambah Data Mahasiswa</a>
    <a class="btn btn-primary" href="logout.php">Logout</a>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group me-2" role="group" aria-label="First group">
            <?php if ($halamanAktif > 1) : ?>
                <button type="button" class="btn btn-outline-secondary"><a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a></button>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <button type="button" class="btn btn-outline-secondary"><a style="font-weight: bold; color:black" href="?halaman=<?= $i ?>"><?= $i ?></a></button>
                <?php else : ?>
                    <button type="button" class="btn btn-outline-secondary"><a href="?halaman=<?= $i ?>"><?= $i ?></a></button>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <button type="button" class="btn btn-outline-secondary"><a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a></button>
            <?php endif; ?>
        </div>
    </div>
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
</body>

</html>