<?php
include 'conn.php';

if (isset($_GET['id'])) {

  $query = "SELECT * FROM dokter WHERE id_jadwal='$_GET[id]' ORDER BY jadwal ASC ";
  $result = mysqli_query($connect, $query);

  if ($result) {
    $data = array();
    while ($d = mysqli_fetch_array($result)) {
      array_push($data, array(
        "id" => $d['id_dokter'],
        "nama" => $d['nama_dokter'],
        "jenis kelamin" => $d['jenis_kelamin'],
        "jadwal" => $d['jadwal'],
        "id jadwal" => $d['id_jadwal'],
        "jenis dokter" => $d['jenis dokter'],
        "no telp" => $d['no_telp'],
        "alamat" => $d['alamat'],
        "image" => $d['image'],
      ));
    }
  }
} else {
  $query = "SELECT * FROM dokter";
  $result = mysqli_query($connect, $query);

  if ($result) {
    $data = array();
    while ($d = mysqli_fetch_array($result)) {
      array_push($data, array(
        "id" => $d['id_dokter'],
        "nama" => $d['nama_dokter'],
        "jenis kelamin" => $d['jenis_kelamin'],
        "jadwal" => $d['jadwal'],
        "id jadwal" => $d['id_jadwal'],
        "jenis dokter" => $d['jenis dokter'],
        "no telp" => $d['no_telp'],
        "alamat" => $d['alamat'],
        "image" => $d['image'],
      ));
    }
  }
}
echo json_encode($data);
