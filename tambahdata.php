<?php
$koneksi = mysqli_connect("localhost", "root", "", "informatik");

if (!$koneksi) {
    die("Gagal koneksi: " . mysqli_connect_error());
}

// Fungsi tambah data
function tambahdata($data, $file)
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

    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO mahasiswa (foto, nama, nim, jurusan, alamat) 
                  VALUES ('$path', '$nama', '$nim', '$jurusan', '$alamat')";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }

    return 0; // Gagal upload
}

if (isset($_POST['submit'])) {
    if (tambahdata($_POST, $_FILES) > 0) {
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href = 'datamahasiswa.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan!');
                document.location.href = 'datamahasiswa.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />


</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5 col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-4 text-center">Tambah Data Mahasiswa</h4>

          <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" name="nama" id="name" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" name="nim" id="nim" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" name="jurusan" id="jurusan" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" name="alamat" id="alamat" class="form-control" required />
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label">Upload Foto</label>
              <input type="file" name="foto" id="foto" class="form-control" required />
            </div>

            <div class="d-grid">
              <button type="submit" name="submit" class="btn btn-success">Tambah</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>