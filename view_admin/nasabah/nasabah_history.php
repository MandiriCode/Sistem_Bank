<?php
include 'header.php';
include '../../include/config.php';

$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_nasabah='$id' ORDER BY tanggal DESC");
?>

<div class="col-md-10 p-4">
    <h3>Riwayat Transaksi</h3>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; while($data = mysqli_fetch_array($query)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= ucfirst($data['tipe']) ?></td>
                <td>Rp <?= number_format($data['jumlah'], 0, ',', '.') ?></td>
                <td><?= $data['tanggal'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
     <a href="data_nasabah.php" class="btn btn-secondary mb-3">
                <i class="bi bi-person-plus-fill"></i> Kembali
            </a>
</div>
