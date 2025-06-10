<?php

include '../include/config.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_admin'];
    $alamat = $_POST['alamat_admin'];
    $no_telp = $_POST['no_telp_admin'];
    $email = $_POST['email_admin'];
    $password = $_POST['password_admin'];
    


    mysqli_query($conn, "INSERT INTO admin (nama_admin, alamat_admin, email_admin, password_admin, no_telp_admin) 
        VALUES ('$nama', '$alamat', '$email', '$password', '$no_telp')");

    header("Location: login.php");
}
?>