<?php
session_start();
require_once './middlewares/authMiddleware.php';
isLogin();
include_once './templates/layout.php';

?>


<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">



    <div class="card p-2" style="width: 400px;">

        <div class="card-body">
            <h2 class="card-title text-center mb-2">Login</h2>
            <?php if (isset($_SESSION['message'])) : ?>
                <div id="alert-box" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <p><?= $_SESSION['message'] ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            endif;
            ?>

            <form action="login-process" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Username:</label>
                    <input type="type" class="form-control" name="username" value="<?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>" placeholder="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="mt-3 text-center">
                    <a href="#">Dont have acount?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/e-news/contents/assets/js/"></script>