<?php
session_start();
require_once './middlewares/authMiddleware.php';
require_once './config/db.php';

isNotLogin();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    // $image = $_POST['image'];
    $status = isset($_POST['status']) ? $_POST['status'] : 'nonaktif';
    $user_id = $_SESSION['userId'];

    // uploadGambar
    $foto_produk = null;
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $foto_produk = $_FILES['image']['name'];
        $upload_dir = './contents/assets/';

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
