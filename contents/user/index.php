<?php
session_start();

require_once './templates/layout.php';
require_once './config/db.php';

date_default_timezone_set('Asia/Jakarta');

// Fungsi untuk membatasi jumlah kata dalam teks
function limit_text($text, $limit)
{
  if (strlen($text) > $limit) {
    return substr($text, 0, $limit) . '...'; // Potong teks klau lebih batas
  } else {
    return $text; // Teks ga dipotong klo ga lebih
  }
}


// Fungsi untuk mengambil berita berdasarkan kategori atau tanggal
function ambilBeritaPerKategori($conn, $category = null, $date = null)
{
  // query default yg mengambil berita aktif aja
  $sql = "SELECT news.*, categories.name FROM news 
  JOIN categories ON news.category_id = categories.id 
  WHERE news.status = 'aktif'";

// kondisi kalau param kategori di isi dan dikondisikan di query
  if ($category) {
    $sql .= " AND categories.name = '$category'";
  }

//sama juga kondisi kalau param date di isi dan dikondisikan di query
  if ($date) {
    $sql .= " AND news.date = '$date'";
  }

  // klau dah lewatin kondisi diatas tambahin ini diakhirnya biar dia mengurutkan berdasarkan id 
  $sql .= " ORDER BY id DESC";

  // eksekusi query
  return mysqli_query($conn, $sql);
}

// fungsi yg ngebuat card

// Fungsi untuk menampilkan berita dalam bentuk card
function renderNewsCard($row)
{
  // data yg diambil dari param diatas 
  $title = $row['title'];
  $content = limit_text($row['content'], 55);
  $id = $row['id'];
  $image = $row['image'];
  $date = $row['date'];
?>

  <!-- HTML untuk card berita -->
  <a href="news?id=<?= $id ?>" class="text-decoration-none">
    <div class="card" style="width: 18rem;">
      <img src='/e-news/contents/assets/images/<?= $image ?>' class="card-img-top" height="180px" alt="...">
      <div class="card-body">
        <h6 class="card-title fs-5"><?= $title ?></h6>
        <p class="card-text fs-6">Tanggal: <?= $date ?></p>
        <p class="card-text fs-6"><?= $content ?></p>
        <div class="d-flex w-100 justify-content-between">
          <span class="btn btn-primary w-100 px-0">Baca</span>
        </div>
      </div>
    </div>
  </a>
<?php
}



$today = date('Y-m-d');

$news_terbaru = ambilBeritaPerKategori($conn, null, $today);
$news_music = ambilBeritaPerKategori($conn, 'Sport', null);







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

      <!-- <form class="d-flex " action="<?= $_SERVER['PHP_SELF'] ?>" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-search" name="search" type="submit"><i class="bi bi-search"></i></button>
      </form> -->

      <a href="search" class="pb-2 ps-2 pt-2" style="color: black;"> <i class="bi bi-search"></i></a>
      <?= isset($_SESSION['isLogin']) ? '<a href="/e-news/logout" class="btn btn-logout ms-3">Logout</a>' : '<a href="register" class="btn btn-login ms-3">Register</a><a href="login" class="btn btn-login ms-1">Login</a>' ?>
    </div>
  </div>
</nav>



<main>
  <div class="container mt-5 ">

    <?php if (isset($_SESSION['message'])): ?>
      <div class="w-50 mx-auto alert alert-info alert-dismissible mb-5 text-center">
        <p><?= $_SESSION['message'] ?></p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php endif ?>

    <!-- berita terbaru -->
    <div class="row">

      <h2 class=" text-center fs-2">Berita Terbaru</h2>
      <div class="horizontal-scroll">
        <div class="wraper">
          <?php while ($row = mysqli_fetch_assoc($news_terbaru)) {
            // var_dump($row);

            // data yg dikirim ke param row berupa harus array
            echo renderNewsCard($row);
          } ?>

        </div>

      </div>
    </div>

    <div class="row">

      <h2 class=" text-center fs-2">Music</h2>
      <div class="horizontal-scroll">
        <div class="wraper">
          <?php while($row_music = mysqli_fetch_assoc($news_music)){
            echo renderNewsCard($row_music);
          } ?>
        </div>
      </div>
    </div>


    <?php  ?>


  </div>
</main>