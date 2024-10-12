<?php 
session_start();

require_once './middlewares/authMiddleware.php';
isNotLogin();
isSuperAdmin();
require_once './config/db.php';
include_once './templates/layout.php';


?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Kategori</h2>
    <form action="storeCategory" method="POST">
        <div class="mb-3">
            <label for="categoryName" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="" name="name" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Tambahkan Kategori</button>
        </div>
    </form>
</div>