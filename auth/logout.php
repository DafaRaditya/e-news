<?php
session_start(); 

if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {

    // Proses logout
    $_SESSION['message'] = 'Anda telah Logout';
    session_destroy();  
    
    header('Location: login');  // Redirect ke halaman login
    exit();

} else {
    
    header('Location: index');  
    exit();
}
?>
