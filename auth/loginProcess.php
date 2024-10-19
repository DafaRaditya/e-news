<?php 
session_start();
require_once './config/db.php';
require_once './middlewares/authMiddleware.php';

isLogin();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

 $_SESSION['isLogin'] = false;

    $query = "SELECT * FROM user WHERE username = '$username' AND password = SHA1('$password')";

    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result)) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['isLogin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userId'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        if ($user['role'] == 'admin' || $user['role'] == 'superadmin') {
           
            header('Location: admin/index');
            exit();
        }
        else{
            header('Location: index/');
            exit();
        }
    }
    else{
        $_SESSION['isLogin'] = false;
        
        $_SESSION['username'] = $username;
        $_SESSION['message'] = "Gagal login periksa kembali kredensial anda";
        header('Location: ./login');
      

    exit();
    }
}
?>