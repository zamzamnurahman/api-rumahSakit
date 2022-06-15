<?php
include 'conn.php';

$nama_user = $_POST['nama_user'];
$email = $_POST['email'];
$password = $_POST['password'];

if ($nama_user != null && $email != null && $password != null) {

  $query = "INSERT INTO `user` (`nama`, `email`, `password`) VALUES ('$nama_user', '$email', '$password');";
  $result = mysqli_query($connect, $query);

  if ($result < 1) {
    echo "gagal daftar";
  } else {
    echo json_encode(array(
      "nama user" => $nama_user,
      "email" => $email,
      "password" => $password
    ));
  }
} else {
  echo "form belum terisi";
}
