<?php
session_start();
include '../conn.php';
if (isset($_POST['submit'])) {
  $nama_pasien = $_POST['nama_pasien'];
  $jenis_kelamin = $_POST['jenis_kelamin'];
  $no_telp = $_POST['no_telp'];
  $tanggal_lahir = $_POST['tanggal_lahir'];
  $alamat = $_POST['alamat'];
  $keluhan = $_POST['keluhan'];
  $jenis_pemeriksaan = $_POST['jenis_pemeriksaan'];
  $jenis_pengobatan = 0;
  $antrian = $_POST['antrian'];
  if ($_SESSION['status'] == 'login') {
    $id_user = 1;
  } else {
    echo "Error for session login";
    mysqli_close($connect);
  }

  $query = "INSERT INTO `pasien` (`id_user`, `id_pasien`, `nama_pasien`, `antrian`, `jenis_kelamin`, `no_telp`, `tanggal_lahir`, `alamat`, `keluhan`, `jenis_pemeriksaan`, `jenis_pengobatan`) VALUES ($id_user, NULL, '$nama_pasien', $antrian, '$jenis_kelamin', '$no_telp', '$tanggal_lahir', '$alamat', '$keluhan', '$jenis_pemeriksaan', '$jenis_pengobatan')";

  $result = mysqli_query($connect, $query);
}

?>

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
    $query2 = "SELECT * FROM pasien LIMIT 1";
    $result2 = mysqli_query($connect, $query2);
    $data2 = mysqli_fetch_assoc($result2);
    if (isset($data2["antrian"])) {
      $antrian = $data2["antrian"];
    } else {
      $antrian = 0;
    }

    // Antrian
    echo "<h1>Nomor Antrian : " . $antrian . "</h1>";
    ?>
  </div>
  <div class="row " style="margin: 50px;">
    <div class="col-md-7">
    <div class="btn btn-primary">laki-laki</div>
    <div class="btn btn-primary">_</div>
    <div class="btn btn-primary">_</div>

      <table cellpadding="10">
        <tr align="center" bgcolor='whiteGrey'>
          <th>No</th>
          <th>ID Pasien</th>
          <th>Antrian</th>
          <th>nama</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>No Telepon</th>
          <th>keluhan</th>
          <th>Create by</th>

        </tr>

        <?php

        $query = "SELECT * FROM pasien";
        $result = mysqli_query($connect, $query);
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
          // var_dump($data);
          if ($data['jenis_kelamin']  == 'laki-laki') {
            $jk =  "<td bgcolor='greenGrey'>";
          } else if ($data['jenis_kelamin'] == 'perempuan') {
            $jk = "<td bgcolor='pink'>";
          }

          if ($data['jenis_pemeriksaan'] == 0) {
            $jp = '<td bgcolor="grey">';
          } else if ($data['jenis_pemeriksaan'] == 1) {
            $jp = '<td bgcolor="blue">';
          } else if ($data['jenis_pemeriksaan'] == 2) {
            $jp = '<td bgcolor="red">';
          }
          //create by
          if ($data['id_user'] == 1) {
            $create = "Admin";
          } else {
            $create = "User";
          }


          echo "<tr align='center'>";
          echo "<td bgcolor='whiteGrey'>" . $no++ . "</td>";
          echo $jk . "" . $data['id_pasien'] . "</>";
          echo "<td>" . $data['antrian'] . "</td>";
          echo "<td>" . $data['nama_pasien'] . "</td>";
          echo "<td>" . $data['tanggal_lahir'] . "</td>";
          echo "<td>" . $data['alamat'] . "</td>";
          echo "<td>" . $data['no_telp'] . "</td>";
          echo $jp . "" . $data['keluhan'] . "</td>";
          echo "<td>" . $create ." (".$data['id_user']. ")</td>";
          echo "</tr>";
        }
        ?>
      </table>
    </div>
    <div class="table-right col-md-4 offset-md-1 ">
      <h2>Formulir Tambah Pasien</h2>
      <form action="pasien.php" method="post">

        <table>
          <tr>
            <td>Antrian</td>
            <td>:</td>
            <td><input type="text" name="antrian"></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama_pasien" id="nama_pasien"></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="laki-laki">laki-laki
              <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="perempuan">Perempuan
            </td>
          </tr>
          <tr>
            <td>No Telepon</td>
            <td>:</td>
            <td><input type="tel" name="no_telp" id="no_telp"></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input type="date" name="tanggal_lahir" id="tanggal_lahir"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="alamat" id="alamat" cols="30" rows="2"></textarea></td>
          </tr>
          <tr>
            <td>Keluhan</td>
            <td>:</td>
            <td><textarea name="keluhan" id="keluhan" cols="30" rows="5"></textarea></td>
          </tr>
          <tr>
            <td>Jenis Pemeriksaan</td>
            <td>:</td>
            <td>
              <select name="jenis_pemeriksaan">
                <option value="0"> Pemeriksaan Umum
                </option>
                <option value="1"> Pemeriksaan Khusus
                </option>
                <option value="2"> Pemeriksaan Darurat
                </option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input class="btn btn-warning" type="submit" value="Tambah Pasien" name="submit"></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
  <a href="logout.php">log out</a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>