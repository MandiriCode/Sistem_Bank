<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../../login.php");
    exit;
}

include '../../include/config.php';

// Pastikan nama kolom sesuai tabel transaksi
$query = "SELECT nama_nasabah, tipe, jumlah, tanggal FROM transaksi ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
        <link rel="stylesheet" href="../../asset/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .laporan-card {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
            transition: 0.3s ease;
        }
        .laporan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.2);
        }
        h3 {
            color: #0d6efd;
        }
        .btn-print {
            float: right;
            margin-bottom: 20px;
        }
        .no-print {
            display: none !important;
        }
        @media print {
            .btn-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="container mt-5">
        <a href="../index.php" type="button" class="btn btn-secondary " >Kembali</a>

    <div class="laporan-card" id="laporan">
        <h3 class="mb-4">Laporan Transaksi Nasabah</h3>
        
        <button class="btn btn-success btn-print" onclick="previewPDF()">Preview PDF</button>
        <table class="table table-bordered table-striped mt-4">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Nasabah</th>
                    <th>Jenis Transaksi</th>
                    <th>Nominal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama_nasabah']) ?></td>
                        <td><?= ucfirst(htmlspecialchars($row['tipe'])) ?></td>
                        <td>Rp <?= number_format($row['jumlah'], 0, ',', '.') ?></td>
                        <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>


function previewPDF() {
    const originalButton = document.querySelector('.btn-print');

    // Sembunyikan tombol sebelum buat PDF
    originalButton.classList.add('no-print');

    const element = document.getElementById('laporan');

    const opt = {
        margin:       0.5,
        filename:     'laporan_transaksi_nasabah.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'A4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).toPdf().get('pdf').then(function (pdf) {
        const pdfBlob = pdf.output('blob');
        const blobUrl = URL.createObjectURL(pdfBlob);
        window.open(blobUrl, '_blank');

        // Tampilkan kembali tombol setelah selesai
        originalButton.classList.remove('no-print');
    });
}
</script>
</body>
</html>
