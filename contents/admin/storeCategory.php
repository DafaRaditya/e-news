<?php 
session_start();
require_once './/middlewares/authMiddleware.php';
isNotLogin();
require_once './/config/db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $categoryName = $_POST['name'];

    // Menyiapkan query untuk menyimpan kategori
    $query = "INSERT INTO categories (name)  VALUES ('$categoryName')";

    // Menjalankan query
    if (mysqli_query($conn, $query)) {
        // session_start();
        $_SESSION['message'] = "Kategori berhasil ditambahkan.";
        header('Location: index.php'); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Menutup koneksi
mysqli_close($conn)
?>