<?php
session_start();
include '../conn.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "DELETE FROM pasien WHERE id_pasien = $id ";
  $result = mysqli_query($connect, $query);
  if ($result) {
    echo "<script> alert('Antrian berhasil di Update') </script>";
  } else {
    echo "<script> alert('Antrian gagal di update') </script>";
  }
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
<style>
  nav {
    position: fixed;
    background-color: #ffffff;
  }

  .antrian {
    display: flex;
  }

  .antrian h4 {
    margin-right: 20px;
  }

  .antrian a img {
    height: 20px;
    width: 20px;
    align-items: center;
  }

  .no-antrian {
    padding: 0 10px;
    font-weight: bold;
  }

  .tabel-pasien {
    width: 100%;
    border: 2px solid #198754;
  }


  .pasien:hover {
    background-color: #E8FFFF !important;
    cursor: pointer;
  }

  a {
    text-decoration: none;
    font-weight: bold;
    color: black;
  }

  #bg-popup {
    display: none;
    height: 100%;
    width: 100%;
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    filter: blur(50);
    background-color: rgba(0, 0, 0, 0.429);
  }

  #popup {
    display: none;
    position: fixed;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background-color: #E8FFFF;
    height: 500px;
    width: 600px;
    margin: auto;
    border-radius: 20px;
    box-shadow: 1px 2px 4px 5px rgba(0, 0, 0, 0.200);
  }

  .header {
    text-align: center;
    display: flex;
    justify-content: space-between;
    margin: 5px 20px;

  }

  .content {
    margin: 40px 30px;
  }

  .content table {
    margin: 0 auto;
    width: 100%;
  }

  .content tr {
    width: 100%;
    padding: 10px;
  }
</style>

<body>
  <?php

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
  <!-- modal -->
  <div id="bg-popup">
    <div id="popup">
      <div class="header">
        <h1>Profil Pasien</h1>
        <a href="" onclick='closePopup()'><button class="btn btn-success">X</button></a>
      </div>
      <div class="content">
        <table>
          <tr>
            <td>Antrian </td>
            <td>:</td>
            <td id="antrian"></td>
          </tr>
          <tr>
            <td>Id Pasien </td>
            <td>:</td>
            <td id="id_pasien"></td>
          </tr>
          <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <th id="nama"></th>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td id="jk"></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td id="tgl"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td id="alamat"></td>
          </tr>
          <tr>
            <td>No.Telepon</td>
            <td>:</td>
            <td id="no"></td>
          </tr>
          <tr>
            <td>Keluhan</td>
            <td>:</td>
            <td id="keluhan"></td>
          </tr>

        </table>
      </div>
      <div class="row">
        <div class="col-md-12">
          <center><a id="edit-pasien"><button class="btn btn-success">Edit Pasien</button></a></center>
        </div>
      </div>
    </div>

  </div>
  <!-- FORM -->

  <div class="section-antrian" style="padding: 150px 30px 10px 30px;">
    <div class="title">
      <h3><strong>Dashboard Pasien</strong></h3>
    </div>
    <div class="antrian">
      <h4>Antrian ke : </h4>
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
      echo "<h3 class='no-antrian'>" . $antrian . "</h3>";
      ?>
    </div>

  </div>

  <div class="row " style="margin: 30px;">
    <div class="col-md-12">
      <a href="form_pasien.php"><button class="btn btn-success" style="margin: 5px 0px;">Tambah Pasien</button></a>
      <form action="" method="GET" style="display: inline;;">
        <label for="Search"> Cari Pasien </label>
        <input type="text" name="cari" id="cari" autofocus placeholder="Masukkan Nama Pasien" size="30" autocomplete="off">
        <button class="btn btn-warning">Cari</button>
      </form>
      <a href="../admin/pasien.php"><button class="btn btn-warning"><img src="../assets/images/refresh.svg" alt=""></button></a>


      <table class="tabel-pasien" cellPadding='10'>
        <tr align="center" class="bg-success text-white">
          <th>No</th>
          <th>Antrian</th>
          <th>Nama</th>
          <th>Jenis Kelamin</th>
          <th>Tanggal Lahir</th>
          <th>Alamat</th>
          <th>No Telepon</th>
          <th>Keluhan</th>
          <th>by</th>
          <th>Cheklist</th>

        </tr>
        <?php

        if (isset($_GET['cari'])) {
          $cari =  $_GET['cari'];
          $query = "SELECT * FROM pasien WHERE nama_pasien LIKE '%$cari%' ";
          $result = mysqli_query($connect, $query);
        } else {
          $query = "SELECT * FROM pasien";
          $result = mysqli_query($connect, $query);
        }
        $no = 1;
        while ($data = mysqli_fetch_assoc($result)) {
          $antrian = $data['antrian'];
          if ($no % 2 == 0) {
            $row = "<tr align='center' class='bg-light pasien'>";
          } else if ($no % 2 == 1) {
            $row = "<tr align='center' class='pasien'>";
          }
          if ($data['jenis_pemeriksaan'] == 0) {
            $jp = '<td class="bg-primary text-white">';
          } else if ($data['jenis_pemeriksaan'] == 1) {
            $jp = '<td class="bg-warning text-white">';
          } else if ($data['jenis_pemeriksaan'] == 2) {
            $jp = '<td class="bg-danger text-white">';
          }
          //create by
          if ($data['id_user'] == 1) {
            $create = "Admin";
          } else {
            $create = "User";
          }


          echo $row;
          echo "<td class='bg-success text-white'>" . $no++ . "</td>";
          echo  $jp . "" . $data['antrian'] . "</td>";
        ?>

          <td><a href='#' onclick='openPopup("<?= $data["antrian"]; ?>","<?= $data["id_pasien"]; ?>","<?= $data["nama_pasien"]; ?>","<?= $data["jenis_kelamin"]; ?>","<?= $data["tanggal_lahir"]; ?>","<?= $data["alamat"]; ?>","<?= $data["no_telp"]; ?>","<?= $data["keluhan"]; ?>")'> <?= strtoupper($data['nama_pasien']); ?> </a></td>
        <?php
          echo "<td>" . $data['jenis_kelamin'] . "</td>";
          echo "<td>" . $data['tanggal_lahir'] . "</td>";
          echo "<td>" . $data['alamat'] . "</td>";
          echo "<td>" . $data['no_telp'] . "</td>";
          echo "<td>" . $data['keluhan'] . "</td>";
          echo "<td>" . $create . " (" . $data['id_user'] . ")</td>";
          echo "<td> <a href='pasien.php?id=" . $data['id_pasien'] . "'><button class='btn btn-success'>Selesai</button></a> </td>";
          echo "</tr>";
        }
        // echo $antrian;

        ?>
      </table>
    </div>

  </div>
  <a href="logout.php">log out</a>

  <script>
    function openPopup(antrian, id_pasien, nama, jk, tgl, alamat, no, keluhan) {
      // console.log(nama);
      document.getElementById("popup").style.display = 'inline';
      document.getElementById("bg-popup").style.display = 'inline';
      document.getElementById("antrian").innerText = antrian;
      document.getElementById("id_pasien").innerText = id_pasien;
      var modalEdit = document.getElementById("edit-pasien");
      modalEdit.setAttribute('href', "form_pasien.php?id=" + id_pasien);
      document.getElementById("nama").innerText = nama;
      document.getElementById("jk").innerText = jk;
      document.getElementById("tgl").innerText = tgl;
      document.getElementById("alamat").innerText = alamat;
      document.getElementById("no").innerText = no;
      document.getElementById("keluhan").innerText = keluhan;
    }

    function closePopup() {
      document.getElementById("popup").style.display = 'none';
      document.getElementById("bg-popup").style.display = 'none';

    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>