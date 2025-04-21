<?php
$server = "localhost";
$user = "root";
$password = "";
$DB = "bd33";

$conn = mysqli_connect($server, $user, $password, $DB);
if (!$conn) {
    die("Ошибка подключения: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
?>
