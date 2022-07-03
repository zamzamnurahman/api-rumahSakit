<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<style>
  nav {
    position: fixed;
    background-color: #ffffff;
  }
</style>

<body>

  <?php
  session_start();
  if ($_SESSION['status'] != 'login') {
    header("Location:../index.php");
  }
  ?>
  <nav>
    <h3>SI RUMAH SAKIT</h3>
    <ul>
      <li><a href="dashboard.php">Beranda</a> </li>
      <li><a href="pasien.php">Data Pasien</a></li>
      <li><a href="">Data Dokter</a></li>
      <li><a href="">Data Kamar</a></li>
      <li><a href="">Data user</a></li>
      <li><a href="">Pengaturan</a></li>
    </ul>
  </nav>
  <h1>Dashboard</h1>

  <a href="logout.php">log out</a>
</body>

</html>