<?php
require_once './templates/layout.php';
require_once './config/db.php';

$id = $_GET['id'];

if ($id) :

    $query = "SELECT news.*, user.username, categories.name from news JOIN user ON news.user_id = user.id JOIN categories ON news.category_id = categories.id  WHERE news.id = $id";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) :
        $row = mysqli_fetch_assoc($result);
?>

<img src="/contents/assets/<?= $row['image'] ?>" alt="gambar berita">

<h1><?= $row['title'] ?></h1>
<h5>Kategori : <?= $row['name'] ?></h5>

<p>Posted on: <?= $row['date'] ?></p>
<h3>Author : <?= $row['username'] ?></h3>
        <p><?= $row['content'] ?></p>


<?php else :
        echo "<p>Berita tidak ditemukan.</p>";

    endif;
else:
    echo "<p>invalid request.</p>";
endif;
?>