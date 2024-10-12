<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'db_news';

try {
 $conn = mysqli_connect($host,$username,$password,$db_name);

} catch (\Error $th) {
    throw $th;
}

?>