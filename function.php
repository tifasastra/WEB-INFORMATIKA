<?php

$koneksi = mysqli_connect("localhost", "root", "", "informatik");

if (!$koneksi) {
    die('Koneksi Gagal: ' . mysqli_connect_error());
}

if (!function_exists('tampildata')) {
    function tampildata($query)
    {
        global $koneksi;
        $result = mysqli_query($koneksi, $query);

        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }

        return $rows;
    }
}

if (!function_exists('tambahdata')) {
    function tambahdata($data, $file)
    {
        global $koneksi;

        $nama = $data["nama"];
        $nim = $data["nim"];
        $jurusan = $data["jurusan"];
        $alamat = $data["alamat"];

        $fileName = $file['foto']['name'];
        $tmp = $file['foto']['tmp_name'];
        $folder = 'images/mhs/';
        $newFileName = date('dmY_His') . '_' . $fileName;
        $path = $folder . $newFileName;

        if (move_uploaded_file($tmp, $path)) {
            $query = "INSERT INTO mahasiswa (foto, nama, nim, jurusan, alamat) 
                      VALUES ('$newFileName', '$nama', '$nim', '$jurusan', '$alamat')";
            mysqli_query($koneksi, $query);

            return mysqli_affected_rows($koneksi);
        }

        return 0;
    }
}

if (!function_exists('hapusdata')) {
    function hapusdata($id)
    {
        global $koneksi;
        $query = "DELETE FROM mahasiswa WHERE id = $id";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

if (!function_exists('ubahdata')) {
    function ubahdata($data, $file, $id)
    {
        global $koneksi;

        $nama = $data["nama"];
        $nim = $data["nim"];
        $jurusan = $data["jurusan"];
        $alamat = $data["alamat"];

        $fileName = $file['foto']['name'];
        $tmp = $file['foto']['tmp_name'];
        $folder = 'images/mhs/';
        $newFileName = date('dmY_His') . '_' . $fileName;
        $path = $folder . $newFileName;

        if (!empty($fileName)) {
            if (move_uploaded_file($tmp, $path)) {
                $query = "UPDATE mahasiswa SET
                            foto = '$newFileName',
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

        return 0;
    }
}