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

<script src="https://cdn.tailwindcss.com">
</script>
<link rel="stylesheet" href="/e-news/contents/assets/css/style.css">

<nav class="bg-white border-b-2 border-gray-300">
  <div class="container mx-auto flex items-center justify-between p-4">
    <a href="#" class="text-blue-600 font-bold text-lg">E-news</a>
    <button class="text-blue-600 lg:hidden" type="button" aria-expanded="false" aria-label="Toggle navigation" onclick="toggleNavbar()">
      <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
      </svg>
    </button>

    <div class="hidden lg:flex lg:items-center lg:space-x-4" id="navbarContent">
      <ul class="flex space-x-4">
      </ul>

      <a href="search" class="text-black px-2">
        <i class="bi bi-search"></i>
      </a>
      <?= isset($_SESSION['isLogin']) ?
        '<a href="/e-news/logout" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 font-semibold">Logout</a>' :
        '<a href="register" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 font-semibold">Register</a>
            <a href="login" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 font-semibold">Login</a>' ?>
    </div>
  </div>

  <div class="lg:hidden" id="mobileNavbarContent">
    <ul class="flex flex-col space-y-2 p-4">
      <li><a href="#" class="text-gray-600 hover:text-blue-600">Home</a></li>
      <a href="search" class="text-black">
        <i class="bi bi-search"></i>
      </a>
      <?= isset($_SESSION['isLogin']) ?
        '<a href="/e-news/logout" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Logout</a>' :
        '<a href="register" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Register</a>
            <a href="login" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Login</a>' ?>
    </ul>
  </div>
</nav>

<script>
  function toggleNavbar() {
    const navbarContent = document.getElementById('navbarContent');
    const mobileNavbarContent = document.getElementById('mobileNavbarContent');
    navbarContent.classList.toggle('hidden');
    mobileNavbarContent.classList.toggle('hidden');
  }
</script>




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
          <?php while ($row_music = mysqli_fetch_assoc($news_music)) {
            echo renderNewsCard($row_music);
          } ?>
        </div>
      </div>
    </div>


    <?php  ?>


  </div>
</main>