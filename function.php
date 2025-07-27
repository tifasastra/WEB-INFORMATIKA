<?php

$koneksi = mysqli_connect("localhost", "root", "", "informatik");

if (!$koneksi) {
    die('Koneksi Gagal: ' . mysqli_connect_error());
}

// Fungsi tampil data
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

// Fungsi tambah data
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

// Fungsi hapus data
if (!function_exists('hapusdata')) {
    function hapusdata($id)
    {
        global $koneksi;
        $query = "DELETE FROM mahasiswa WHERE id = $id";
        mysqli_query($koneksi, $query);

        return mysqli_affected_rows($koneksi);
    }
}

// Fungsi ubah data
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

// Fungsi register
if (!function_exists('register')) {
    function register($data)
    {
        global $koneksi;

        $username = trim($data["username"]);
        $password1 = trim($data["password1"]);
        $password2 = trim($data["password2"]);

        $queryusername = "SELECT id FROM user WHERE username = '$username'";
        $username_check = mysqli_query($koneksi, $queryusername);

        if (mysqli_num_rows($username_check) > 0) {
            return "Username sudah terdaftar!";
        }

        if (!preg_match('/^[a-zA-Z0-9._-]+$/', $username)) {
            return "Username tidak valid!";
        }

        if ($password1 !== $password2) {
            return "Konfirmasi password salah!";
        }

        $hash_password = password_hash($password1, PASSWORD_DEFAULT);

        $query_insert = "INSERT INTO user VALUES ('', '$username', '$hash_password')";

        if (mysqli_query($koneksi, $query_insert)) {
            return "Register berhasil!";
        } else {
            return "Gagal: " . mysqli_error($koneksi);
        }
    }
}

?>
