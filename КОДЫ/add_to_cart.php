<?php
session_start();
include "setup.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$client_id = $_SESSION['user_id'];

if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$_SESSION['cart'][$service_id] = true;

    $_SESSION['cart_message'] = "Услуга успешно добавлена в корзину!";
    header("Location: services.php");
    exit();
}
?>