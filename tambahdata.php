<?php
$koneksi = mysqli_connect("localhost", "root", "", "informatik");

if (!$koneksi) {
    die("Gagal koneksi: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $nama = $_POST["nama"];
    $nim = $_POST["nim"];
    $jurusan = $_POST["jurusan"];
    $alamat = $_POST["alamat"];

    if (isset($_FILES['foto'])) {
        $file = $_FILES['foto']['name'];
        $namefile = date('dmY_His') . '_' . $file;
        $tmp = $_FILES['foto']['tmp_name'];
        $folder = 'images/mhs/';
        $path = $folder . $namefile;

        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO mahasiswa (foto, nama, nim, jurusan, alamat) 
                      VALUES ('$namefile', '$nama', '$nim', '$jurusan', '$alamat')";
            mysqli_query($koneksi, $query);

            if (mysqli_affected_rows($koneksi) > 0) {
                echo "
                <script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location.href = 'datamahasiswa.php';
                </script>";
            } else {
                echo "
                <script>
                    alert('Data Gagal Ditambahkan!');
                    document.location.href = 'datamahasiswa.php';
                </script>";
            }
        } else {
            echo "
            <script>
                alert('Gagal mengupload foto!');
                document.location.href = 'datamahasiswa.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Nama:</label>
        <input type="text" name="nama" id="name" required /><br>

        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim" required /><br>

        <label for="jurusan">Jurusan:</label>
        <input type="text" name="jurusan" id="jurusan" required /><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" id="alamat" required /><br>

        <label for="foto">Upload Foto:</label>
        <input type="file" name="foto" id="foto" required /><br><br>

        <button type="submit" name="submit">Tambah</button>
    </form>
</body>
</html>
