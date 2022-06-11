<?php
include 'conn.php';
$result = mysqli_query($connect, "SELECT * FROM user WHERE id_user = $_GET[id] ");

$data = mysqli_fetch_assoc($result);
echo json_encode($data);
