<?php
    // $nama = "feri";
    // echo "Hello World $nama" . "keren";
    // echo$nama;

    require "function.php"; // Mengganti koneksi manual dengan function.php
    $query = "SELECT * FROM mahasiswa";
    $rows = tampildata($query); // Ambil data dari function.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA MAHASISWA</title>
</head>

<body>

    <nav>
        <ul style="list-style-type: none; text-align: center; padding: 0%;">
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="home.html">Home</a>
            </li>
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="about.html">About</a>
            </li>
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="service.html">Services</a>
            </li>
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="contact.html">Contact</a>
            </li>
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="login.html">Login</a>
            </li>
            <li style="display: inline; margin: 0% 15px; text-decoration: none;">
                <a href="datamahasiswa.php">Data</a>
            </li>
        </ul>
    </nav>

    <h1 align="center">Data Mahasiswa</h1>


    <div style="margin: 20px 0 20px 30px;">
       <a href="tambahdata.php">
            <button style="background-color: green; color: white; padding: 5px 15px; cursor: pointer; border: none;">
                Tambah Data
            </button>
       </a>
    </div>
    <table border="1" cellspacing="0" cellpadding="10px">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $i = 1;
        foreach($rows as $mhs) { ?>
        <tr>
            <td><?= $i; ?></td>
            <td><img src="images/mhs/<?= $mhs['foto']; ?>" alt="<?= $mhs['foto']; ?>" width="170px" /></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["nim"]; ?></td>
            <td><?= $mhs["jurusan"]; ?></td>
            <td><?= $mhs["alamat"]; ?></td>
            <td>
                <a href="hapusdata.php?id=<?= $mhs['id']; ?>">Hapus</a> |
                <a href="ubahdata.php?id=<?= $mhs['id']; ?>">Edit</a>
            </td>
        </tr>
        <?php $i++; } ?>
    </table>
</body>

</html>
