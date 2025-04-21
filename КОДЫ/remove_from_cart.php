<?php
session_start();
if (isset($_GET['service_id'])) {
    $service_id = $_GET['service_id'];

    if (isset($_SESSION['cart'][$service_id])) {
        unset($_SESSION['cart'][$service_id]);

        $_SESSION['cart_message'] = "Услуга успешно удалена из корзины.";
    } else {
        $_SESSION['cart_error'] = "Ошибка: услуга не найдена в корзине.";
    }
} else {
    $_SESSION['cart_error'] = "Ошибка: не указан ID услуги.";
}

header("Location: cart.php");
exit();