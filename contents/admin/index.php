<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();
// isAdmin();
require_once './config/db.php';
include_once './templates/layout.php';

$usr_id = $_SESSION['userId'];

$query = "SELECT news.*,user.username,categories.name FROM news JOIN user ON news.user_id = user.id JOIN categories ON news.category_id = categories.id
    WHERE news.user_id = '$usr_id'";

$result = mysqli_query($conn, $query);

// echo

?>

<style>
    .img-thumbnail{
    /* background-color: red; */
        /* aspect-ratio: 1 / 1; Mengatur rasio aspek 16:9 */
        width: 7.7rem;
        height: 5.5em;

    }
</style>
<nav class="nav">
    <a href="../logout" class="nav-link">Logout</a>
</nav>

<div class="container mt-5">
    <?php if (isset($_SESSION['message'])) : ?>
        <div class="alert alert-dismissible fade show alert-info text-center" role="alert">
            <p><?= $_SESSION['message'] ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <div class="d-flex justify-content-center">
        <a href="create" class="btn btn-primary">Buat Berita</a>
    </div>
    <h2 class="fs-4 fw-medium">Kelola berita</h2>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Judul</td>
                <td>Kategori</td>
                <td>Author</td>
                <td>Status</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($result)) : ?>
            <tbody>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['name'] ?></td> <!-- kategory -->
                    <td>
                    <?= isset($row['image']) ? "<img class='img-thumbnail' src='./contents/assets/" . $row['image'] . "'  alt=''>" : "Tidak ada gambar"; ?>
                    </td>

                    <td><?= $row['username'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <form action="delete" method="post" onsubmit="return confirm('Yakin ingin menghapus data?')">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                        <!-- <a href="delete?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="confirm('Yakin ingin menghapus data?')">Hapus</a> -->
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
    </table>
</div>