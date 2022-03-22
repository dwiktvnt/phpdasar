<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Tambah Mahasiswa</title>
</head>

<body>
    <div class="container">
        <div class="card mt-2">
            <div class="card-header">
                Ubah Data Mahasiswa
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $mhs["id"]; ?>">
                    <input type="hidden" name="fotoLama" value="<?= $mhs["foto"]; ?>">
                    <div class="mb-3">
                        <label for="foto" class="col-sm-2 col-form-label">Foto Mahasiswa</label>
                        <div class="col-sm-5">
                            <img src="img/<?= $mhs['foto'] ?>" width=80><input class="form-control" type="file" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $mhs["nama"]; ?>">
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="nim" name="nim" value="<?= $mhs["nim"]; ?>">
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="email" name="email" value="<?= $mhs["email"]; ?>">
                        </div>
                    </div>
                    <div class=" mb-3 row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?= $mhs["jurusan"]; ?>">
                        </div>
                    </div>
                    <div class="d-flex flex-row">
                        <button class=" btn btn-primary" type="submit" name="submit">Tambah</button><br>
                        <a href="index.php" class="btn btn-warning">Batal</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted">
                dwiOkta
            </div>
        </div>
    </div>

</body>

</html>