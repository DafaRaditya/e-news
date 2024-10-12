<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();



require_once './config/db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $id = $_POST['id'];
    
    $query = "DELETE FROM categories WHERE id = '$id'";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_affected_rows($conn)) {
    
    
        $_SESSION['message'] = "Data Berhasil Dihapus";
    
        header('Location: category');
    
        exit();
}else{
    header('Location: category');
    exit();
}

}
