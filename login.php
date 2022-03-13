<?php
session_start();
if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'function.php';

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
        </table>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? Registrasi <a href="registrasi.php">Di sini</a></p>
</body>

</html>