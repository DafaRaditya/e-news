<?php
switch ($url) {
    case 'index':
        require_once 'contents/user/index.php';
        break;
    case 'search':
        require_once 'contents/user/search.php';
        break;
    case 'admin':
    case 'admin/index':
        require_once 'contents/admin/index.php';
        break;
    case 'admin/create':
        require_once 'contents/admin/createNews.php';
        break;
    case 'admin/store':
        require_once 'contents/admin/storeNews.php';
        break;
    case 'admin/delete':
        require_once 'contents/admin/deleteNews.php';
        break;
    case 'admin/category':
        require_once 'contents/admin/indexCategory.php';
        break;
    case 'admin/createCategory':
        require_once 'contents/admin/createCategory.php';
        break;
    case 'admin/storeCategory':
        require_once 'contents/admin/storeCategory.php';
        break;
    case 'admin/deleteCategory':
        require_once 'contents/admin/deleteCategory.php';
        break;
    case 'login':
        require_once 'auth/login.php';
        break;
    case 'login-process':
        require_once 'auth/loginProcess.php';
        break;
    case 'register':
        require_once 'auth/register.php';
        break;
    case 'register-process':
        require_once 'auth/registerProcess.php';
        break;
    case 'logout':
        require_once 'auth/logout.php';
        break;
    case 'news':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            require_once 'contents/user/news.php';
        } else {
            echo 'Berita tidak ditemukan';
        }
        break;
    default:
        echo 'Alamat tidak ditemukan';
        break;
}
