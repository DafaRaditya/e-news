<?php
// session_start();

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'index';

switch ($url) {
        case 'index':
        case 'search':
        case 'login':
        case 'login-process':
        case 'register':
        case 'register-process':
        case 'admin':
        case 'admin/index':
        case 'admin/create':
        case 'admin/store':
        case 'admin/category':
        case 'admin/createCategory':
        case 'admin/storeCategory':
        case 'admin/deleteCategory':
        case 'admin/delete':
        case 'logout':
        case 'news':
                require 'web.php';
                break;
        default:
               

                echo $url;
?>
                <h1 style="  text-align: center; color: #f00; padding: 50px;">404 Not Found</h1>
                <p style=" text-align: center;">Maaf, halaman yang Anda cari tidak ditemukan.</p>
<?php
                break;
}


?>