<?php
include 'header.php';
include '../../include/config.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM nasabah WHERE id_nasabah='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];
    $no_rek = $_POST['no_rek'];

    // Cek apakah no rekening sudah dipakai oleh nasabah lain
    $cek_no_rek = mysqli_query($conn, "SELECT * FROM nasabah WHERE no_rek_nasabah='$no_rek' AND id_nasabah != '$id'");
    if (mysqli_num_rows($cek_no_rek) > 0) {
        echo "<script>alert('No Rekening yang dimasukkan sudah ada.'); window.location='nasabah_edit.php?id=$id';</script>";
        exit;
    }

    // Lanjut update
    mysqli_query($conn, "UPDATE nasabah SET nama_nasabah='$nama', no_hp_nasabah='$no_hp', alamat_nasabah='$alamat', no_rek_nasabah='$no_rek' WHERE id_nasabah='$id'");
    header("Location: data_nasabah.php");
    exit;
}
?>

<div class="col-md-10 p-4">
    <h3>Edit Nasabah</h3>
    <form method="POST">
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama_nasabah'] ?>" required>
        </div>
        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp_nasabah'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control"><?= $data['alamat_nasabah'] ?></textarea>
        </div>
        <div class="mb-3">
            <label>No Rekening</label>
            <input type="text" name="no_rek" class="form-control" value="<?= $data['no_rek_nasabah'] ?>" required pattern="\d{7,}" title="Nomor rekening minimal 7 digit">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Simpan</button>
    </form>
</div>
