<?php
    require 'controller.php';
    $students = query("SELECT * FROM mahasiswa ORDER BY id DESC");

    if( isset($_POST["search"]) ){
        $keyword = $_POST["keyword"];
        $students = search($keyword);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/animation.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Data Mahasiswa</h1>
            <a href="input-data.php" class="add-button">Tambah data Mahasiswa</a> 
        </div>

        <form class="search-form" action="" method="post">
            <input type="text" name="keyword" class="search-input" placeholder="Cari siswa...">
            <button type="submit" name="search" class="search-button">Cari</button>
        </form>

        <table class="student-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($students as $student) { ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td><?= $student["nama"] ?></td>
                        <td><?= $student["nim"] ?></td>
                        <td><?= $student["prodi"] ?></td>
                        <td><?= $student["fakultas"] ?></td>
                        <td><img src="assets/img/<?= $student["gambar"] ?>" alt="" width="75px"></td>
                        <td class="action-links">
                            <a href="delete.php?id=<?= $student["id"] ?>" class="delete-link">Hapus</a>
                            <a href="update.php?id=<?= $student["id"] ?>" class="update-link">Ubah</a>
                        </td>
                    </tr>
                    <?php $i++ ?>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
