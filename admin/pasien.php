<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu Pasien</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
  <?php
  include "../conn.php";

  session_start();
  if ($_SESSION['status'] != 'login') {
    header("Location:../index.php");
  }
  ?>
  <nav>
    <h1>SI RUMAH SAKIT</h1>
    <ul>
      <li><a href="dashboard.php">Beranda</a> </li>
      <li><a href="pasien.php">Data Pasien</a></li>
      <li><a href="">Data Dokter</a></li>
      <li><a href="">Data Kamar</a></li>
      <li><a href="">Data user</a></li>
      <li><a href="">Pengaturan</a></li>
    </ul>
  </nav>
  <div class="title" style="margin: 0 50px;">
    <h1>Dashboard</h1>
    <?php
    $query = "SELECT * FROM pasien LIMIT 1";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);
    $antrian = $data["antrian"];

    // Antrian
    echo "<h1>Nomor Antrian : " . $antrian . "</h1>";
    ?>
  </div>
  <div class="row " style="margin: 50px;">
    <div class="col-md-7">
      <a href="tambahPasien.php"><button>+</button></a>
      <table cellpadding="10">
        <tr>
          <th>no</th>
          <th>ID Pasien</th>
          <th>Antrian</th>
          <th>keluhan</th>
          <th>nama</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>NO Telepon</th>

        </tr>

        <?php

        $query = "SELECT * FROM pasien";
        $result = mysqli_query($connect, $query);
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)) {
          // var_dump($data);
          echo "<tr>";
          echo "<td>" . $no++ . "</td>";
          echo "<td>" . $data['id_pasien'] . "</td>";
          echo "<td>" . $data['antrian'] . "</td>";
          echo "<td>" . $data['keluhan'] . "</td>";
          echo "<td>" . $data['nama_pasien'] . "</td>";
          echo "<td>" . $data['jenis_kelamin'] . "</td>";
          echo "<td>" . $data['tanggal_lahir'] . "</td>";
          echo "<td>" . $data['alamat'] . "</td>";
          echo "<td>" . $data['no_telp'] . "</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
    <div class="table-right col-md-4 offset-md-1">
      <h2>Formulir Tambah Pasien</h2>
      <table bgcolor="white">
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" name="nama" id="nama"></td>
        </tr>
        <tr>
          <td>Keluhan</td>
          <td>:</td>
          <td><input type="text" name="keluhan" id="keluhan"></td>
        </tr>
        <tr>
          <td>Tanggal Lahir</td>
          <td>:</td>
          <td><input type="date" name="date" id="date"></td>
        </tr>

      </table>
    </div>
  </div>
  <a href="logout.php">log out</a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>