<?php
include 'conn.php';

$hasil = mysqli_query(
  $connect,
  "SELECT  id_pasien
FROM  pasien
ORDER  BY  id_pasien
DESC  LIMIT  1 "
);
$data = mysqli_fetch_object($hasil);




$result = mysqli_query(
  $connect,
  'INSERT INTO rekam_medis VALUES (
    "","","' . $nama_pasien . '","' . $jenis_kelamin . '","' . $no_telp . '","' . $tanggal_lahir . '","' . $alamat . '"
    )'
);

if ($result) {
  $data = array(
    "nama" => $_POST['nama_pasien'],
    "jenis kelamin" => $_POST['jenis_kelamin'],
    "no telp" => $_POST['no_telp'],
    "tanggal lahir" => $_POST['tanggal_lahir'],
    "alamat" => $_POST['alamat']
  );
  echo json_encode($data);
}
