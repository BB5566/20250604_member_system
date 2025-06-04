<?php
// db_connect.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_forum";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("連線失敗: " . $conn->connect_error);
}
?>
