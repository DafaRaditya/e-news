<?php
session_start();
require_once './middlewares/authMiddleware.php';
isNotLogin();



require_once './config/db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $id = $_POST['id'];
    
    $query = "DELETE FROM news WHERE id = '$id'";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_affected_rows($conn)) {
    
    
        $_SESSION['message'] = "Data Berhasil Dihapus";
    
        header('Location: index');
    
        exit();
}else{
    header('Location: index');
    exit();
}

}
