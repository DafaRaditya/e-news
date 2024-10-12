<?php
session_start();

require_once './templates/layout.php';

echo "URL:" . $url . "<br>";

// echo "URL: " . $url . "<br>";

?>

<nav>
    <?= isset($_SESSION['isLogin'])  ? '<a href="/e-news/logout" class="nav-link" >Logout</a>' : ' <a href="login" class="nav-link" >Login</a>' ?>


</nav>

<h1>Ini halaman index user</h1>