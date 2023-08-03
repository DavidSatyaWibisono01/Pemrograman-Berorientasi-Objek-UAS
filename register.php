<?php
    require 'controller.php';

    // apakah button submit pernah di klik?
    if( isset($_POST["register"]) ){
    
        if( register($_POST) > 0 ){
            echo "<script>
                    alert('akun berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
        }else{
            mysqli_error($conn);
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
    <body>
        <div class="container-regis">
            <h1>Register</h1>
            <form action="" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" autocomplete="off">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" autocomplete="off">
                <label for="conf_password">Konfirmasi Password:</label>
                <input type="password" name="conf_password" id="conf_password" autocomplete="off">
                <button class="btn" type="submit" name="register">Register</button>
            </form>
        </div>
    </body>
</html>