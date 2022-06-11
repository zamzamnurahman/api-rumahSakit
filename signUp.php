<?php
include 'conn.php';

$nama_user = $_POST['nama_user'];
$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($connect, "INSERT INTO user VALUES('','$nama_user','$email','$password')");

if (!$result) {
  echo "gagal daftar";
} else {

  echo json_encode(array(
    "nama user" => $nama_user,
    "email" => $email,
    "password" => $password
  ));
}
