<?php
include_once './config/db.php';
include_once './templates/layout.php';

$numrows = 0;
$keyword = '';


if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    $sql = "SELECT news.*, categories.name FROM news 
  JOIN categories ON news.category_id = categories.id 
  WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%' OR categories.name LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);

    $numrows = mysqli_num_rows($result) > 0 ? mysqli_num_rows($result) : '';

}

?>

<style>
    .search-bar {
        margin: 20px 0;
    }

    .search-bar form {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .search-bar input {
        width: 80%;
        max-width: 100%;
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-radius: 5px 0 0 5px;
        font-size: 16px;
    }

    .search-bar button {
        padding: 10px 15px;
        border: 1px solid #ccc;
        border-left: 0;
        border-radius: 0 5px 5px 0;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    .search-bar button i {
        font-size: 17px;
    }

    .max-w-4xl a:hover {
        color: #1d4ed8;
    }
</style>

<script src="https://cdn.tailwindcss.com">
</script>


<main>

    <div class="container">
        <h1 class="text-center mt-5">
            Apa yang kamu cari?
        </h1>
        <div class="search-bar d-flex justify-content-center">
            <form action="" method="get">
                <input value="<?php if(isset($keyword)) echo $keyword; ?>" placeholder="Masukkan kata/topic yang ingin kamu cari. Contoh: pemilu" type="text" name="keyword" required />
                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>


        <?php if($numrows > 0) : ?>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <div class="max-w-4xl mx-auto p-4">
        <div class="flex mb-6">
            <img alt="ooo" class="w-48 h-32 object-cover mr-4" height="100" src="contents/assets/images/<?= $row['image']; ?>" width="150" />
            <div>
                <div class="text-blue-700 font-normal text-sm">
                    <?=  $row['name']; ?> | <?= $row['date']; ?>
                </div>
                <div class="text-xl font-medium mt-2">
                    <a href="news?id=<?= $row['id']; ?>">
                        <?= $row['title']; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php endwhile; ?>

    <?php else : ?>


    <h1 class="text-center mt-5">Tidak ada hasil</h1>
    
    <?php endif; ?>
    </div>
</main>