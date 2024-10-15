<?php
session_start();
require_once './middlewares/authMiddleware.php';
require_once './config/db.php';

isNotLogin();

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // sanitasi data
    $title = mysqli_escape_string($conn, $_POST['title']);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $content = mysqli_escape_string($conn, $_POST['content']);
    $date = mysqli_escape_string($conn, $_POST['date']);
    $status = isset($_POST['status']) ? $_POST['status'] : 'nonaktif';
    $user_id = $_SESSION['userId'];

    // validasi data
    if(empty($title) || empty($category) || empty($content) || empty($date)) {
        $_SESSION['message'] = "Data Tidak boleh kosong";
        header('Location: index');
        exit();

    }    


    // uploadGambar
    $foto_produk = null;
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $foto_produk = $_FILES['image']['name'];
        $upload_dir = './contents/assets/images/';

        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $foto_produk);
    }
    $query = "INSERT INTO news (title, content, date, image, status, category_id, user_id) 
          VALUES ('$title', '$content', '$date', " . ($foto_produk ? "'$foto_produk'" : "NULL") . ", '$status', '$category', '$user_id')";

$result = mysqli_query($conn, $query);
    if ($result && mysqli_affected_rows($conn)) {
        $_SESSION['message'] = "Data Berhasil Dibuat";
        header('Location: index');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
