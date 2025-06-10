<?php
include '../../include/config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM nasabah WHERE id_nasabah='$id'");
header("Location: data_nasabah.php");
