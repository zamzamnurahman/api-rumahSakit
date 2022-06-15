<?php
include 'conn.php';
$result = mysqli_query($connect, "SELECT * FROM user");

$data = array();
if ($result) {
  while ($d = mysqli_fetch_array($result)) {
    array_push($data, array(
      "id" => $d['id_user'],
      "nama" => $d['nama'],
      "email" => $d['email'],
      "password" => $d['password']
    ));
  }
}

echo json_encode($data);
