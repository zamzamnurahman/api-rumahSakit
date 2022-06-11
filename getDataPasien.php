<?php

include 'conn.php';

$query = "SELECT * FROM pasien";
$result = mysqli_query($connect, $query);

$data = array();
while ($d = mysqli_fetch_array($result)) {
  array_push($data, array(
    "id" => $d['id_pasien'],
    "nama" => $d['nama_pasien'],
    "jenis kelamin" => $d['jenis_kelamin'],
    "no telepon" => $d['no_telp'],
    "tanggal lahir" => $d['tanggal_lahir'],
    "alamat" => $d['alamat']

  ));
}

echo json_encode($data);
