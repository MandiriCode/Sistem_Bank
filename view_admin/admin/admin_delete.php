<?php
include '../../include/config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM admin WHERE id_admin='$id'");
header("Location: data_admin.php");
