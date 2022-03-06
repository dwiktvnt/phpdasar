<?php

require 'function.php';

$mahasiswa = query("SELECT * FROM mahasiswa");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah Data Mahasiswa</a><br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($mahasiswa as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td><?= $row["nama"] ?></td>
                <td><?= $row["nim"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= $row["jurusan"] ?></td>
                <td>
                    <a href="hapus.php?id=<?= $row["id"] ?>" onclick="return confirm('Yakin Ingin Menghapus')">Hapus</a> |
                    <a href="">Update</a>
                </td>
                <?php $i++ ?>
            </tr>
        <?php endforeach ?>
    </table>

</body>

</html>