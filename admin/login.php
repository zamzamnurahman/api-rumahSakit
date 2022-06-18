<?php
session_start();
include "../conn.php";

$username = $_POST['username'];
$password = $_POST['password'];

if (isset($_POST['submit'])) {

  $query = "SELECT * FROM user WHERE email ='$username' AND password ='$password' ";
  $result = mysqli_query($connect, $query);
  $row = mysqli_num_rows($result);

  if ($row == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login";
    header("location:dashboard.php");
  } else {
    $_SESSION["status"] = "gagal login";
    header("location:../index.php");
  }
}
