<?php
// session_start();

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'index';

switch ($url) {
    case 'index':
    case 'login':
    case 'login-process':
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
        require 'web.php';
        break;
    default:
        // echo $_SESSION['isLogin'];

        echo $url;
?>
        <h1 style="  text-align: center; color: #f00; padding: 50px;">404 Not Found</h1>
        <p style=" text-align: center;">Maaf, halaman yang Anda cari tidak ditemukan.</p>
<?php
        break;
}


?>