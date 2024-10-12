<?php
switch ($url) {
    case 'index':
        require_once 'contents/user/index.php';
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
    case 'login':
        require_once 'auth/login.php';
        break;
    case 'login-process':
        require_once 'auth/loginProcess.php';
        break;
    case 'logout':
        require_once 'auth/logout.php';
        break;

    default:
        echo 'Alamat tidak ditemukan';
        break;
}
