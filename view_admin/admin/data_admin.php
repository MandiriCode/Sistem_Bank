<?php
include 'header.php';
include '../../include/config.php';

$limit = 10;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $limit;

if (isset($_GET['cari']) && $_GET['cari'] != '') {
    $cari = mysqli_real_escape_string($conn, $_GET['cari']);
    $query = mysqli_query($conn, "SELECT * FROM admin WHERE nama_admin LIKE '%$cari%' OR no_telp_admin LIKE '%$cari%' OR email_admin LIKE '%$cari%' LIMIT $start, $limit");
    $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM admin WHERE nama_admin LIKE '%$cari%' OR no_telp_admin LIKE '%$cari%' OR email_admin LIKE '%$cari%' ");
} else {
    $query = mysqli_query($conn, "SELECT * FROM admin LIMIT $start, $limit");
    $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM admin");
}
?>


<!-- Main Content -->
<div class="col-md-10 p-4">
    <h3 class="mb-4">Data Admin</h3>

    <div class="card">
        <div class="card-body">
            <a href="admin_tambah.php" class="btn btn-success mb-3">
                <i class="bi bi-person-plus-fill"></i> Tambah Admin
            </a>
            <form method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="cari" class="form-control rounded-start-pill"
                        placeholder="🔍 Cari nama , No_Telpon, Atau Email ..."
                        value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                    <button class="btn btn-outline-primary rounded-end-pill" type="submit">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </form>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No_Telpon</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;

                    while ($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($data['nama_admin']) ?></td>
                            <td><?= htmlspecialchars($data['alamat_admin']) ?></td>
                            <td><?= htmlspecialchars($data['email_admin']) ?></td>
                            <td><?= htmlspecialchars($data['no_telp_admin']) ?></td>
                            <td><?= htmlspecialchars($data['password_admin']) ?></td>

                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                        <i class="bi bi-gear-fill"></i> Aksi
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="admin_edit.php?id=<?= $data['id_admin'] ?>"><i
                                                    class="bi bi-pencil-square"></i> Update</a></li>
                                        <li><a class="dropdown-item text-danger"
                                                href="admin_delete.php?id=<?= $data['id_admin'] ?>"
                                                onclick="return confirm('Yakin ingin menghapus?')"><i
                                                    class="bi bi-trash3"></i> Delete</a></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <?php
            $total = mysqli_fetch_assoc($total_query)['total'];
            $total_pages = ceil($total / $limit);
            ?>

            <nav>
                <ul class="pagination justify-content-center shadow-sm rounded">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link"
                                href="?page=<?= $i ?>&cari=<?= isset($_GET['cari']) ? urlencode($_GET['cari']) : '' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>

        </div>
    </div>
</div>

</div> <!-- Tutup row -->
</div> <!-- Tutup container -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>