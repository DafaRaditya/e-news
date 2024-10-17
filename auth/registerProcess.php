<?php
session_start();
require_once './middlewares/authMiddleware.php';
isLogin();
require_once './config/db.php';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $usrname = mysqli_real_escape_string($conn,($_POST['username']));
    $email = mysqli_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    if (empty($usrname)) {
        $_SESSION['message'] = "Username tidak boleh kosong";
        header("Location: register");
        exit();
    } 

    if (empty($email)) {
        $_SESSION['message'] = "Email tidak boleh kosong";
        header("Location: register");
        exit();
    } 
    if (empty($password)) {
        $_SESSION['message'] = "Password tidak boleh kosong";
        header("Location: register");
        exit();
    }

    require_once './config/db.php';
    

    $sql = "SELECT * FROM user WHERE email = '$email' OR username = '$usrname'";

    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION['message'] = "Email atau username sudah terdaftar". $usrname   ;
        
        header("Location: register");
        exit();
    } else {
        $query = "INSERT INTO user (username, email, password, role) VALUES('$usrname','$email', SHA1('$password'), 'user')";
        $r = mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['message'] = "Akun berhasil dibuat";
            $_SESSION['isLogin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userId'] = $user['id'];

            header("Location: index");
            exit();
        }
    }
}
