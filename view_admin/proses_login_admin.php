<?php
session_start();
include "../include/config.php";

$email_admin = $_POST['email_admin'];
$password_admin = $_POST['password_admin'];

$query = $conn->query("SELECT * FROM admin WHERE email_admin='$email_admin'");
$data = $query->fetch_assoc();

if ($data && $data['password_admin'] === $password_admin) {
    $_SESSION['admin'] = $data;
    header("Location: index.php");
} else {
    echo "<script>alert('Login Admin gagal!');window.location='login.php';</script>";
}
