<?php
require "function.php";
$query = "SELECT * FROM mahasiswa";
$rows = tampildata($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>DATA MAHASISWA</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"/>


    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        nav ul {
            list-style-type: none;
            text-align: center;
            padding: 0;
        }
        nav li {
            display: inline;
            margin: 0 15px;
        }
        nav a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="my-4">
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="service.html">Service</a></li>
            <li><a href="contact.html">Contact</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="datamahasiswa.php">Data</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Data Mahasiswa</h1>

        <div class="mb-3">
            <a href="tambahdata.php" class="btn btn-success">Tambah Data</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $i = 1;
                foreach($rows as $mhs) { ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><img src="images/mhs/<?= $mhs['foto']; ?>" width="100"></td>
                        <td><?= $mhs["nama"]; ?></td>
                        <td><?= $mhs["nim"]; ?></td>
                        <td><?= $mhs["jurusan"]; ?></td>
                        <td><?= $mhs["alamat"]; ?></td>
                        <td>
                            <a href="hapusdata.php?id=<?= $mhs['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                            <a href="ubahdata.php?id=<?= $mhs['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php $i++; } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>