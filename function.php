<?php

// Connect ke Database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $foto = upload();

    if ($foto === false) {
        return false;
    }

    $query = "INSERT INTO mahasiswa VALUES ('','$foto', '$nama', '$nim', '$email', '$jurusan')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    // Ambil file dari form
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tempName = $_FILES['foto']['tmp_name'];

    //Cek apakah user mengupload gambar
    if ($error === 4) {
        echo "<script>
            alert('Pilih Gambar Terlebih Dahulu')    
            </script>";

        return false;
    }

    // Cek apakah user mengupload gambar atau bukan dari ekstensi file yang dipuload
    $ekstensiFileValid = ['jpg', 'jpeg', 'png']; // Menentukan ektensi file yang dapat diupload
    $ekstensiFile = explode('.', $namaFile); // Untuk memecah string(nama file) menjadi aray
    $ekstensiFile = strtolower(end($ekstensiFile)); // mengambil aray yang paling terkahir dan dirubah menjadi lower dari nama file

    // Cek ekstensi file
    if (in_array($ekstensiFile, $ekstensiFileValid) === false) {
        echo "<script>
            alert('File Yang Dipilih Harus Format jpg, jpeg, png')    
            </script>";
        return false;
    }

    // Cek Ukuran File
    if ($ukuranFile > 1000000) {
        echo "<script>
            alert('Ukuran File Terlalu Besar, Ukuran File Harus Dibawah 1MB')    
            </script>";
        return false;
    }

    // File lolos dan siap diupload
    move_uploaded_file($tempName, 'img/' . $namaFile);

    return $namaFile;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $nim = htmlspecialchars($data["nim"]);
    $email = htmlspecialchars($data["email"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $fotoLama = $data["fotoLama"];

    // Cek apakah user upload foto baru atau tidak
    if ($_FILES['foto']['error'] === 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload();
    }



    $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', email='$email', jurusan='$jurusan', foto='$foto' WHERE id=$id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{

    $query = "SELECT * FROM mahasiswa WHERE
                nama LIKE '%$keyword%' OR
                nim LIKE '%$keyword%' OR
                email LIKE '%$keyword%' OR
                jurusan LIKE '%$keyword%'";

    return query($query);
}
