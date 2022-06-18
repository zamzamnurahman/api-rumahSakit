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
$antrian = $_POST['antrian'];
$id_user = $_POST['id_user'];

$query = "INSERT INTO `pasien` (`id_user`, `id_pasien`, `nama_pasien`, `antrian`, `jenis_kelamin`, `no_telp`, `tanggal_lahir`, `alamat`, `keluhan`, `jenis_pemeriksaan`, `jenis_pengobatan`) VALUES ($id_user, NULL, '$nama_pasien', $antrian, '$jenis_kelamin', '$no_telp', '$tanggal_lahir', '$alamat', '$keluhan', '$jenis_pemeriksaan', '$jenis_pengobatan')";

$result = mysqli_query($connect, $query);

// echo $result;
if ($result > 0) {
  $data = array(
    "Status" => "OKE",
    "nama" => $nama_pasien,
    "jenis kelamin" => $jenis_kelamin,
    "no telp" => $no_telp,
    "tanggal lahir" => $tanggal_lahir,
    "alamat" => $alamat,
    "keluhan" => $keluhan,
    "jenis pemeriksaan" => $jenis_pemeriksaan,
    "jenis pengobatan" => $jenis_pengobatan,
    "id user" => $id_user,
    "antrian" => $antrian,
  );
  echo json_encode($data);
} else {
  echo 'gagal tambah pasien';
}
