<?php
session_start(); 

if (isset($_SESSION['isLogin']) && $_SESSION['isLogin'] == true) {

    // Proses logout
    $_SESSION['message'] = 'Anda telah Logout';
    session_destroy();  
    
    header('Location: index');  // Redirect ke halaman Index
    exit();

} else {
    
    header('Location: index');  
    exit();
}
?>
