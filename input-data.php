<?php
    require 'controller.php';

    // apakah button submit pernah di klik atau belum
    if( isset($_POST["submit"]) ){
        
        if( input($_POST) > 0 ){
            echo "<script>
                    alert('data berhasil ditambahkan');
                    document.location.href = 'dashboard.php';
                </script>";
        }else{
            echo "<script>
                    alert('data gagal ditambahkan');
                    document.location.href = 'dashboard.php';
                </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Siswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="container-input-data">
            <h1>Input Data Siswa</h1>
            <form action="" method="post">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
                <label for="nim">NIM:</label>
                <input type="text" name="nim" id="nim" required>
                <label for="prodi">Prodi:</label>
                <input type="text" name="prodi" id="prodi" required>
                <label for="fakultas">Fakultas:</label>
                <input type="text" name="fakultas" id="fakultas" required>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" required>
                <button class="btn-input" type="submit" name="submit">Kirim</button>
                <a href="index.php" class="btn-back">kembali</a>
            </form>
        </div>
    </div>
</body>
</html>
