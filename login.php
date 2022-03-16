<?php
session_start();
require 'function.php';
//cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {

    //Tangkap data dari form login
    $username = $_POST["username"];
    $password = $_POST["password"];

    //Cek usernama di database
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //Cek username yg diinputkan user ada atau tidak di database
    if (mysqli_num_rows($result) === 1) {
        //Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {

            //Set session
            $_SESSION["login"] = true;

            //cek cookie (remember me)
            if (isset($_POST["remember"])) {
                //set cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }
            header("Location: index.php");
        }
    }
    $error = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Halaman Login</title>
</head>

<body>
    <?php if (isset($error)) : ?>
        <h3 style="color: red; font-style: italic;">Password/Username Salah</h3>
    <?php endif; ?>

    <div class="global-container" sty>
        <div class="card login-form">
            <div class="card-body">
                <h1 class="card-title text-center">Login Admin</h1>
            </div>
            <div class="card-text">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Ingat Saya</label>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
                <p>Belum punya akun? Registrasi <a href="registrasi.php">Di sini</a></p>
            </div>
        </div>
    </div>



</body>

</html>