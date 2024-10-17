<?php
session_start();
require_once './middlewares/authMiddleware.php';
isLogin();
include_once './templates/layout.php';
?>

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-2" style="width: 400px;">
        <div class="card-body">
            <!-- Bootstrap Icon Logo -->
            <div class="d-flex justify-content-center mb-3">
                <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
            </div>

            <h2 class="card-title text-center mb-2">Register</h2>

            <!-- Session message alert -->
            <?php if (isset($_SESSION['message'])) : ?>
                <div id="alert-box" class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    <p><?= $_SESSION['message'] ?></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                unset($_SESSION['message']);
            endif;
            ?>

            <!-- Registration Form -->
            <form action="register-process" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" name="username"  placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email"  placeholder="Email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Register</button>

                <!-- Google Login Anchor -->
                <div class="mt-3 text-center">
                    <a href="login-with-google" class="btn btn-danger w-100"><i class="bi bi-google"></i> Register with Google</a>
                </div>

                <div class="mt-3 text-center">
                    <a href="login">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/e-news/contents/assets/js/"></script>