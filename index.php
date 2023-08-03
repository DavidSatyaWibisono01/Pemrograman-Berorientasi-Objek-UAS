<?php
    require 'controller.php';

    if( isset($_POST['login']) ){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

        // cek username apakah ada di db?
        if( mysqli_num_rows($cek) === 1 ){

            $row = mysqli_fetch_assoc($cek);
            // cek apakah passwordnya sama kyak di db?
            if( password_verify($password, $row['password']) ) {
                header("Location: dashboard.php");
                exit;
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
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <div class="container-login">
        <h1>Login</h1>
        <?php if (isset($error)) : ?>
            <p class="error-message">Username/password salah!</p>
        <?php endif; ?> 
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="btn" name="login">Login</button>
            <a href="register.php" class="btn-back">Register</a>
        </form>
    </div>

</body>
</html>