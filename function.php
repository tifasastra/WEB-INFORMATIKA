<?php
$koneksi = mysqli_connect("localhost", "root", "", "informatik");
if (!$koneksi) {
    die('Koneksi Gagal' . mysqli_connect_error());
}

function tampildata($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);

    $rows = [];

    while($row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    }

    return $rows;
}

?>