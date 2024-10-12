<?php
function isLogin()
{
    // Mengecek apakah user sudah login
    if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true && isset($_SESSION['role'])) {

        // Redirect berdasarkan role
        if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "superadmin") {
            header('Location: admin/');
            exit();  
        } else {
            header('Location: /e-news/index/');
            exit();  
        }
    }
}

function isNotLogin()
{
    // Pengecekan user belum login
    if (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] !== true) {
        header('Location: /e-news/login');
        exit();  
    }
}

function isAdmin() {
    if(isset($_SESSION['role'])){
        if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "superadmin") {
            return true;
        }
        else{
           header('Location: /e-news/index');
           exit();
        }
    }
}
