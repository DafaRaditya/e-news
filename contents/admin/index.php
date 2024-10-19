<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();
isAdmin();
require_once './config/db.php';
include_once './templates/layout.php';

// menangani update status

if (isset($_POST['update']) && isset($_POST['id']) && isset($_POST['status'])) {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    $sql = "UPDATE news SET status = '$status' WHERE id = $id";

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_affected_rows($conn)) {
        $_SESSION['message'] = "Status berhasil diubah menjadi $status.";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }
    header("Location: index");
    exit();

}



// ambil data berita
$usr_id = $_SESSION['userId'];

$query = "SELECT news.*,user.username,categories.name FROM news JOIN user ON news.user_id = user.id JOIN categories ON news.category_id = categories.id
    WHERE news.user_id = '$usr_id'";

$result = mysqli_query($conn, $query);



?>

<style>
    .img-thumbnail {
        width: 7.7rem;
        height: 5.5em;

    }
</style>
<nav class="nav">
    <a href="/e-news/logout" class="nav-link">Logout</a>
    <p>Halo, <?= $_SESSION['username'] ?></p>

</nav>

<div class="container mt-5">
    <?php if (isset($_SESSION['message'])) : ?>
        <div id="alert-box" class="alert alert-dismissible fade show alert-info text-center" role="alert">
            <p><?= $_SESSION['message'] ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <div class="d-flex gap-2 justify-content-center">
        <a href="create" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> Berita</a>

        <?= $_SESSION['role'] == 'superadmin' ? '<a href="category" class="btn btn-success"> <i class="bi bi-gear-fill"></i> Kelola category</a>' : '' ?>
    </div>
    <h2 class="fs-4 fw-medium">Kelola berita</h2>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Judul</td>
                <td>Kategori</td>
                <td>Gambar</td>
                <td>Author</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($result)) :  ?>
            <tbody>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td> <!-- kategory -->
                    <td>
                        <?php if (isset($row['image'])): ?>
                            <img class='img-thumbnail'
                                src='/e-news/contents/assets/images/<?= $row['image'] ?>'

                                alt='gambar berita'>
                        <?php else: ?>
                            <p>Tidak ada gambar</p>
                        <?php endif; ?>

                    </td>

                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td>

                        <?php if ($row['status'] == 'aktif') : ?>

                            <span class="badge bg-success">Aktif</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Nonaktif</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <div class="d-flex gap-2">
                            <!-- update status data -->
                            <form action="" method="post" onsubmit="return confirm('Yakin ingin mengubah status?')">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="status" value="<?= $row['status'] == 'aktif' ? 'nonaktif' : 'aktif' ?>">
                                <button type="submit" name="update" class="btn <?= $row['status'] == 'aktif' ? 'btn-danger' : 'btn-success' ?>">
                                    <?= $row['status'] == 'aktif' ? 'Nonaktif' : 'Aktif' ?>
                                </button>
                            </form>
                            <!-- delete data -->
                            <form action="delete" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        </div>



                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
    </table>
</div>
<script src="/e-news/contents/assets/js/"></script>
