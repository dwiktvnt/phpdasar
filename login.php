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
    <title>Halaman Login</title>
</head>

<body>
    <h1>Login Admin</h1>

    <?php if (isset($error)) : ?>
        <h3 style="color: red; font-style: italic;">Password/Username Salah</h3>
    <?php endif; ?>
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="username" autofocus autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
        </table><br>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Ingat Saya</label><br><br>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? Registrasi <a href="registrasi.php">Di sini</a></p>
</body>

</html>