<?php
session_start();
include "setup.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fio = mysqli_real_escape_string($conn, $_POST['fio']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $update_query = "
        UPDATE customers
        SET ФИО = '$fio', Почта = '$email', Номертелефона = '$phone'
        WHERE КодЗаказчика = '$user_id'
    ";
	

    if (mysqli_query($conn, $update_query)) {
		$_SESSION['user_name'] = $_POST['fio'];
    } else {
        $_SESSION['profile_error'] = "Ошибка при обновлении данных.";
    }

    header("Location: account.php");
    exit();
}
?>