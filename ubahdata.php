<?php

require 'function.php';

$id = $_GET["id"];

$query = "SELECT * FROM mahasiswa WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$mhs = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    if (ubahdata($_POST, $_FILES, $id) > 0) {
        echo "
            <script>
                alert('Data Berhasil Diubah!');
                document.location.href = 'datamahasiswa.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diubah!');
                document.location.href = 'datamahasiswa.php';
            </script>
        ";
    }
}

// Fungsi ubah data TANPA htmlspecialchars
function ubahdata($data, $file, $id)
{
    global $koneksi;

    $nama = $data["nama"];
    $nim = $data["nim"];
    $jurusan = $data["jurusan"];
    $alamat = $data["alamat"];

    $namaFile = $file['foto']['name'];
    $tmp = $file['foto']['tmp_name'];
    $folder = 'images/mhs/';
    $nameFileBaru = date('dmY_His') . '_' . $namaFile;
    $path = $folder . $nameFileBaru;

    if (!empty($namaFile)) {
        if (move_uploaded_file($tmp, $path)) {
            $query = "UPDATE mahasiswa SET
                        foto = '$path',
                        nama = '$nama',
                        nim = '$nim',
                        jurusan = '$jurusan',
                        alamat = '$alamat'
                      WHERE id = $id";
            mysqli_query($koneksi, $query);
            return mysqli_affected_rows($koneksi);
        }
    } else {
        $query = "UPDATE mahasiswa SET
                    nama = '$nama',
                    nim = '$nim',
                    jurusan = '$jurusan',
                    alamat = '$alamat'
                  WHERE id = $id";
        mysqli_query($koneksi, $query);
        return mysqli_affected_rows($koneksi);
    }

    return 0; // Jika gagal upload
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body style="background-color: #f2f2f2; font-family: Arial, sans-serif;">

<div class="card" style="
    max-width: 500px; 
    margin: 50px auto; 
    padding: 30px; 
    background: #fff; 
    border-radius: 10px; 
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
">
    <div class="card-body">

        <h1 class="mb-4" style="text-align: center; color: #333;">Edit Data Mahasiswa</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" name="nama" id="name" class="form-control" required value="<?= $mhs['nama']; ?>">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" name="nim" id="nim" class="form-control" required value="<?= $mhs['nim']; ?>">
            </div>

            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan:</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" required value="<?= $mhs['jurusan']; ?>">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required value="<?= $mhs['alamat']; ?>">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Upload Foto Baru (Opsional):</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>

            <button type="submit" name="submit" class="btn btn-primary w-100">Edit</button>
        </form>

    </div>
</div>

</body>
</html>