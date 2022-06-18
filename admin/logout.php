<?php
session_start();

$_SESSION['status'] = 'noLogin';
header("location:../index.php");
