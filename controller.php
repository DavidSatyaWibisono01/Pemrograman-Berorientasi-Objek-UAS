<?php
    $conn = mysqli_connect("localhost", "root", "", "db_mahasiswa");

    function query($query){
        global $conn;
        $result = mysqli_query($conn, $query);
        $kotak = [];
        while( $box = mysqli_fetch_assoc($result) ){
            $kotak[] = $box;
        }
        return $kotak;
    }


    function input($data){
            global $conn;
            $nama = htmlspecialchars($data["nama"]);
            $nim = htmlspecialchars($data["nim"]);
            $prodi = htmlspecialchars($data["prodi"]);
            $fakultas = htmlspecialchars($data["fakultas"]);
            $gambar = htmlspecialchars($data["gambar"]);

            $query = "INSERT INTO mahasiswa 
                        VALUES 
                    ('', '$nama', '$nim', '$prodi', '$fakultas', '$gambar')
                ";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);
    }

    function delete($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");

        return mysqli_affected_rows($conn);
    }

    function update( $data ){
        global $conn;
        $id = $data["id"];
        $nama = htmlspecialchars($data["nama"]);
        $nim = htmlspecialchars($data["nim"]);
        $prodi = htmlspecialchars($data["prodi"]);
        $fakultas = htmlspecialchars($data["fakultas"]);
        $gambar = htmlspecialchars($data["gambar"]);

        $query = "UPDATE mahasiswa SET
                    nama = '$nama',
                    nim = '$nim',
                    prodi = '$prodi',
                    fakultas = '$fakultas',
                    gambar = '$gambar'
                WHERE id = $id
        ";
        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function search($keyword){
        $query = "SELECT * FROM mahasiswa
                WHERE
                    nama LIKE '%$keyword%' OR
                    nim LIKE '%$keyword%' OR
                    prodi LIKE '%$keyword%' OR
                    fakultas LIKE '%$keyword%'
        ";
        return query($query);
    }


    function register( $regis ){
        global $conn;

        $username = strtolower(stripslashes($regis['username']));
        $password = mysqli_real_escape_string($conn, $regis['password']);
        $conf_password = mysqli_real_escape_string($conn, $regis['conf_password']);

        $cek = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username' ");
        if( mysqli_fetch_assoc($cek) ){            
            echo "
                <script>
                    alert('username sudah digunakan!');
                </script>
            ";
            return false;
        }

        // cek apakah passwordnya sama?
        if( $password !== $conf_password ){
            echo "
                <script>
                    alert('password tidak sesuai!');
                </script>
            ";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        // input ke db
        $query = "INSERT INTO users 
                VALUES
                ('', '$username', '$password')
        ";

        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
    }

    function uploadImage()
    {
    // Mendapatkan informasi file gambar
    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $tmpName = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    // Cek apakah ada gambar yang diupload
    if ($error === 4) {
        return null; // Tidak ada gambar yang diupload
    }

    // Memeriksa ekstensi file gambar
    $validExtensions = ['jpg', 'jpeg', 'png'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!in_array($fileExtension, $validExtensions)) {
        echo "Error: Ekstensi file tidak valid!";
        return null;
    }

    // Mengecek ukuran file gambar (maksimum 2MB)
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($fileSize > $maxFileSize) {
        echo "Error: Ukuran file terlalu besar!";
        return null;
    }

    // Menyimpan gambar ke direktori tujuan
    $destination = "uploads/" . $fileName;
    if (!move_uploaded_file($tmpName, $destination)) {
        echo "Error: Gagal mengunggah gambar!";
        return null;
    }

    return $destination;
    }

?>