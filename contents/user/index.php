<?php
session_start();

require_once './templates/layout.php';
require_once './config/db.php';

date_default_timezone_set('Asia/Jakarta');


$today = date('Y-m-d');

$sql_terbaru = "SELECT news.*, categories.name FROM news JOIN categories ON news.category_id = categories.id WHERE news.date = '$today' AND news.status = 'aktif' ORDER BY id DESC";;




$result = mysqli_query($conn, $sql_terbaru);



function limit_text($text, $limit)
{
  if (strlen($text) > $limit) {
    return substr($text, 0, $limit) . '...';
  } else {
    return $text;
  }
}
?>


<link rel="stylesheet" href="/e-news/contents/assets/css/style.css">

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">E-news</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse ms-auto" id="navbarContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>

      </ul>

      <form class="d-flex " action="<?= $_SERVER['PHP_SELF'] ?>" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-search" type="submit"><i class="bi bi-search"></i></button>
      </form>

      <?= isset($_SESSION['isLogin']) ? '<a href="/e-news/logout" class="btn btn-logout ms-3">Logout</a>' : '<a href="login" class="btn btn-login ms-3">Login</a>' ?>
    </div>
  </div>
</nav>

<main>
  <div class="container">
    
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-info">
        <p><?= $_SESSION['message'] ?></p>
      </div>
    <?php endif ?>
  
    <!-- berita terbaru -->
     <div class="row">

    <h2 class=" text-center fs-2">Berita Terbaru</h2>
    <div class="horizontal-scroll">
      <div class="wraper">
        <?php while ($row = mysqli_fetch_assoc($result)) :
  
          $title = $row['title'];
          $content = limit_text($row['content'], 55); // Membatasi sampai 150 karakter
          $id = $row['id'];
          //
        ?>
  <a href="news?id=<?= $id ?>" class="text-decoration-none">
  <div class="card" style="width: 18rem;">
    <img src='/e-news/contents/assets/images/<?= $row['image'] ?>' class="card-img-top" height="180px" alt="...">
    <div class="card-body">
      <h6 class="card-title fs-5"><?= $title ?></h6>
      <p class="card-text fs-6">Tanggal: <?= $row['date'] ?></p>
      <p class="card-text fs-6"><?= $content ?></p>
      <div class="d-flex w-100 justify-content-between">
        <span class="btn btn-primary w-100 px-0">Baca</span>
      </div>
    </div>
  </div>
</a>
        <?php endwhile; ?>
      </div>
  
    </div>
  </div>


<?php  ?>


  </div>
</main>