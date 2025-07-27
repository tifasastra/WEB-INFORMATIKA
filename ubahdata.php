<?php

require 'function.php';

// ✅ Tambahkan pengecekan ID
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    echo "<script>
            alert('ID tidak ditemukan!');
            document.location.href = 'datamahasiswa.php';
          </script>";
    exit;
}

$id = $_GET["id"];

// ✅ Query untuk ambil data mahasiswa
$query = "SELECT * FROM mahasiswa WHERE id = $id";
$result = mysqli_query($koneksi, $query);

// ✅ Tambahkan pengecekan hasil query
if (!$result) {
    echo "<script>
            alert('Data tidak ditemukan di database!');
            document.location.href = 'datamahasiswa.php';
          </script>";
    exit;
}

$mhs = mysqli_fetch_assoc($result);

if (!$mhs) {
    echo "<script>
            alert('Data dengan ID tersebut tidak ada!');
            document.location.href = 'datamahasiswa.php';
          </script>";
    exit;
}

// ✅ Jika tombol submit ditekan
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

// ✅ Fungsi ubah data tetap sama
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

    return 0; // Gagal upload file
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f2f2f2; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

<div class="card" style="
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
">
    <div class="card-body">

        <h1 class="mb-4 text-center" style="color: #333;">Edit Data Mahasiswa</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nama:</label>
                <input type="text" name="nama" id="name" class="form-control" required value="<?= htmlspecialchars($mhs['nama']); ?>">
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM:</label>
                <input type="text" name="nim" id="nim" class="form-control" required value="<?= htmlspecialchars($mhs['nim']); ?>">
            </div>

            <div class="mb-3">
                <label for="jurusan" class="form-label">Jurusan:</label>
                <input type="text" name="jurusan" id="jurusan" class="form-control" required value="<?= htmlspecialchars($mhs['jurusan']); ?>">
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat:</label>
                <input type="text" name="alamat" id="alamat" class="form-control" required value="<?= htmlspecialchars($mhs['alamat']); ?>">
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
