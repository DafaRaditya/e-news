<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();

require_once './config/db.php';
include_once './templates/layout.php';
?>
<div class="container mt-5">
    <form action="store" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Title Field (12 columns full width) -->
            <div class="col-6 mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required maxlength="255">
            </div>
            <div class="col-6 mb-3">
                <label class="mb-2" for="category">Category:</label>
                <select class="form-select" name="category" id="category" required>
                    <option value="" selected disabled>Pilih kategori</option>

                    <?php
                    $categoriesResult = mysqli_query($conn, "SELECT * FROM categories");
                    while ($row = mysqli_fetch_array($categoriesResult)) : ?>
                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                    <?php endwhile; ?>

                </select>



            </div>

            <!-- Content Field (12 columns full width) -->
            <div class="col-12 mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>

            <!-- Date Field (6 columns on row 2) -->
            <div class="col-md-6 mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>

            <!-- Image Upload Field (6 columns on row 2) -->
            <div class="col-md-6 mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>

            <!-- Active Status (Switch Toggle in full width) -->
            <div class="col-md-6 mb-3">
                <label for="active" class="form-label">Active</label>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="active" name="status" value="aktif">
                    <!-- <label class="form-check-label" for="active">Yes/No</label> -->
                </div>
            </div>
        </div>

        <!-- Submit Button (Full width on its own row) -->
        <div class="row">
            <div class="col-12">
            </div>
        </div>
        <div class="d-flex justify-content-end">

            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</div>