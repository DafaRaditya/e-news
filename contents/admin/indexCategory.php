<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();
isSuperAdmin();
require_once './config/db.php';
include_once './templates/layout.php';

$sql = "SELECT * FROM categories";

$result = mysqli_query($conn, $sql);

?>

<nav class="nav">
    <a href="../logout" class="nav-link">Logout</a>
    <p>Halo, <?= $_SESSION['username'] ?></p>
</nav>
<div class="container mt-5">

    <?php if (isset($_SESSION['message'])): ?>
        <div id="alert-box" class="alert alert-dismissible fade show alert-info text-center" role="alert">
            <p><?= $_SESSION['message'] ?></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['message']); ?>

    <?php
    endif;
    ?>


    <div class="d-flex gap-2 justify-content-center">
        <a href="createCategory" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> category</a>
        <a href="index" class="btn btn-success"><i class="bi bi-gear-fill"></i> Kelola Berita</a>
    </div>
    <h2 class="fs-4 fw-medium">Kelola category</h2>
    <table class="table text-center  table-striped table-hover">
        <thead>
            <tr>
                <td>No</td>
                <td>Nama category</td>
                <td>Aksi</td>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            while ($row = mysqli_fetch_array($result)) : ?>

                <tr>
                    <td><?= $i++ ?></td>
                    <td> <?= $row['name'] ?> </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <button onclick="return alert('Ini gada fungsinya yahahha!!')" class="btn btn-warning">Klik saya</button>|
                            <form action="deleteCategory" onsubmit="return confirm('Yakin ingin menghapus data?')" method="post">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button>
                        </div>
                        </form>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    setTimeout(function(){
        let alertBox = document.getElementById('alert-box')
        if(alertBox) {
            let alert = new bootstrap.Alert(alertBox)
            alert.close(); 
        }
    }, 2500)
</script>