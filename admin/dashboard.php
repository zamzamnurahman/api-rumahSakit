<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <?php
  session_start();
  if ($_SESSION['status'] != 'login') {
    header("Location:../index.php");
  }
  ?>
  <nav>
    <h1>SI RUMAH SAKIT</h1>
    <ul>
      <li><a href="">Beranda</a> </li>
      <li><a href="">Data Pasien</a></li>
      <li><a href="">Data Dokter</a></li>
      <li><a href="">Data Kamar</a></li>
      <li><a href="">Data user</a></li>
      <li><a href="">Pengaturan</a></li>
    </ul>
  </nav>
  <h1>Dashboard</h1>
  <table>
    <tr>
      <td>no</td>
      <td>nama</td>
      <td>jenis kelamin</td>
      <td>alamat</td>
    </tr>
    
    <?php 

    include "../conn.php";
    $query = "SELECT * FROM pasien";
    $result = mysqli_query($connect, $query);
    $no = 1;
    while($data = mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>".$no++."</td>";
      echo "<td>".$data['nama_pasien']."</td>";
      echo "<td>".$data['jenis_kelamin']."</td>";
      echo "<td>".$data['alamat']."</td>";
     echo "</tr>";
    }
    ?>
  </table>
  <a href="logout.php">log out</a>
</body>

</html>