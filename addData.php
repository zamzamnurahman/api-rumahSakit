<?php
include 'conn.php';

$nama_pasien = $_POST['nama_pasien'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$no_telp = $_POST['no_telp'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$keluhan = $_POST['keluhan'];
$jenis_pemeriksaan = $_POST['jenis_pemeriksaan'];
$jenis_pengobatan = $_POST['jenis_pengobatan'];

$result = mysqli_query($connect, 'INSERT INTO pasien VALUES ("","' . $nama_pasien . '","' . $jenis_kelamin . '","' . $no_telp . '","' . $tanggal_lahir . '","' . $alamat . '", "'. $keluhan .'", "'.$jenis_pemeriksaan.'", "'.$jenis_pengobatan.'")');

if ($result) {

  $data = array(
    "nama" => $_POST['nama_pasien'],
    "jenis kelamin" => $_POST['jenis_kelamin'],
    "no telp" => $_POST['no_telp'],
    "tanggal lahir" => $_POST['tanggal_lahir'],
    "alamat" => $_POST['alamat'],
    "keluhan" => $_POST['keluhan'],
    "jenis pemeriksaan" => $_POST['jenis_pemeriksaan'],
    "jenis pengobatan" => $_POST['jenis_pengobatan'],
  );
  echo json_encode($data);
}
