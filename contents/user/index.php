<?php
session_start();

require_once './templates/layout.php';
require_once './config/db.php';


echo "URL:" . $url . "<br>";

$result = mysqli_query($conn, "SELECT * FROM news");

// echo "URL: " . $url . "<br>";

function limit_text($text, $limit)
{
    if (strlen($text) > $limit) {
        return substr($text, 0, $limit) . '...';
    } else {
        return $text;
    }
}
?>

<nav>
    <?= isset($_SESSION['isLogin'])  ? '<a href="/e-news/logout" class="nav-link" >Logout</a>' : ' <a href="login" class="nav-link" >Login</a>' ?>


</nav>

<?php while ($row = mysqli_fetch_assoc($result)) :

    $title = $row['title'];
    $content = limit_text($row['content'], 35); // Membatasi sampai 150 karakter
    $id = $row['id'];


    ?>
   
   
        <div class='card'>
            <img src="./contents/assets/'<?= $row['image'] ?>" class="img-thumbnail" alt="">
            <h3><?= $title ?></h3>
            <p><?= $content?></p>
            <a href='/e-news/news/{$id}'>Read More</a>
        </div>



<?php endwhile; ?>
       
<!-- <h1>Ini halaman index user</h1> -->