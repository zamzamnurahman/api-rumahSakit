<?php
session_start();
include "../conn.php";

$query = "SELECT antrian FROM pasien ORDER by antrian DESC LIMIT 1";
$result = mysqli_query($connect, $query);
$data = mysqli_fetch_array($result);
// var_dump($data);
if ($data == null) {
  $antrian = 0;
} else {
  $antrian = $data['antrian'];
}
$response = 'gagal';

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

  $response = 'sukses';
  mysqli_close($connect);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

  <title>tambah Pasien</title>
</head>
<style>
  .form {
    padding: 50px;
    box-shadow: 2px 3px 6px #198754;
    border: none;
  }

  .kembali {
    margin: 10px 0;
  }
</style>

<body>
  <div class="position-absolute top-50 start-50 translate-middle">
    <a href="pasien.php"><button class="btn btn-success kembali">kembali</button></a>

    <div class="card form">
      <h2>Formulir Tambah Pasien</h2>
      <form action="" method="post">
        <?php
        $get = isset($_GET['id']);
        if ($get) {
          $id = $_GET['id'];
          $query = "SELECT * FROM pasien WHERE id_pasien = $id";
          $result = mysqli_query($connect, $query);
          $data = mysqli_fetch_assoc($result);
        }
        ?>

        <table>
          <tr>
            <td>Antrian</td>
            <td>:</td>
            <td><input value="<?php if ($get) {
                                echo $data['antrian'];
                              } else {
                                echo $antrian + 1;
                              } ?>" type="text" name="antrian" required></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input value="<?php if ($get) {
                                echo $data['nama_pasien'];
                              } ?>" type="text" name="nama_pasien" required></td>
          </tr>
          <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td><input <?php if ($get) {
                          if ($data['jenis_kelamin'] == 'laki-laki') {
                            echo "checked";
                          }
                        } ?> type="radio" name="jenis_kelamin" id="jenis_kelamin" value="laki-laki" required>laki-laki

              <input <?php if ($get) {
                        if ($data['jenis_kelamin'] == 'perempuan') {
                          echo "checked";
                        }
                      } ?> type="radio" name="jenis_kelamin" id="jenis_kelamin" value="perempuan">Perempuan
            </td>
          </tr>
          <tr>
            <td>No Telepon</td>
            <td>:</td>
            <td><input value=" <?php if ($get) {

                                  echo $data['no_telp'];
                                } ?>" type="tel" name="no_telp" id="no_telp" required></td>
          </tr>
          <tr>
            <td>Tanggal Lahir</td>
            <td>:</td>
            <td><input value="<?php if ($get) {
                                echo $data['tanggal_lahir'];
                              } ?>" type="date" name="tanggal_lahir" id="tanggal_lahir"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>
              <textarea name="alamat" cols="30" rows="2" required> <?php if ($get) {
                                                                      echo $data['alamat'];
                                                                    } ?></textarea>
            </td>
          </tr>
          <tr>
            <td>Keluhan</td>
            <td>:</td>
            <td>
              <textarea name="keluhan" cols="30" rows="5" required><?php if ($get) {
                                                                      echo $data['keluhan'];
                                                                    } ?></textarea>
            </td>
          </tr>
          <tr>
            <td>Jenis Pemeriksaan</td>
            <td>:</td>
            <td>
              <select name="jenis_pemeriksaan" required>
                <option value="0" <?php if ($get) {
                                    if ($data['jenis_pemeriksaan'] == "0") {
                                      echo "selected";
                                    }
                                  }
                                  ?>> Pemeriksaan Umum
                </option>
                <option value="1" <?php if ($get) {
                                    if ($data['jenis_pemeriksaan'] == "1") {
                                      echo "selected";
                                    }
                                  }
                                  ?>> Pemeriksaan Khusus
                </option>
                <option value="2" <?php if ($get) {
                                    if ($data['jenis_pemeriksaan'] == "2") {
                                      echo "selected";
                                    }
                                  }
                                  ?>> Pemeriksaan Darurat
                </option>
              </select>
            </td>
          </tr>
          <tr>
            <td></td>
            <td></td>
            <td><input class="btn btn-success" type="submit" value="Tambah Pasien" name="submit"></td>
          </tr>
        </table>
      </form>
    </div>
  </div>

  <?php
  if ($response == 'sukses') {
    echo "<script> alert('Pasien Berhasil ditambahkan!');</script>";
  }
  ?>
</body>

</html>