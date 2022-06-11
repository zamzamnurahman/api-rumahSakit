<?php

include 'conn.php';

$data = array();

$query = "SELECT * FROM kamar";
$result = mysqli_query($connect, $query);

while ($d = mysqli_fetch_array($result)) {
  array_push($data, array(
    "no kamar" => $d['no_kamar'],
    "nama kamar" => $d['nama_kamar'],
    "jenis kamar" => $d['jenis_kamar'],
    "kapasitas" => $d['kapasitas'],
    "fasilitas" => $d['fasilitas']
  ));
}

echo json_encode($data
);
