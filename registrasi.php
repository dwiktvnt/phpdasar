<?php


require 'function.php';

if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('user berhasil ditambah');
            </script>";
    } else {
        echo mysqli_error($conn);
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>

<body>

    <h1>Halaman Registrasi</h1>
    <form action="" method="post">
        <table>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="usernmae"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>

            </tr>
            <tr>
                <td><label for="password2">Masukan Ulang Password</label></td>
                <td><input type="password" name="password2" id="password2"></td>

            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="email" name="email" id="email"></td>

            </tr>
        </table>
        <button type="submit" name="register">Registrasi</button>
    </form>


</body>

</html>