<?php
session_start();
include "setup.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$order_id = $_GET['id'] ?? null;

if ($order_id) {
    // Проверим статус
    $status_query = "
        SELECT содержат.Статус 
        FROM содержат 
        INNER JOIN dogovori ON содержат.КодДоговора = dogovori.КодДоговора 
        WHERE dogovori.КодДоговора = '$order_id' AND dogovori.КодЗаказчика = '$user_id'
    ";
    $status_result = mysqli_query($conn, $status_query);
    $status = mysqli_fetch_assoc($status_result);

    if ($status && $status['Статус'] === 'Завершен') {
        $delete_query = "DELETE FROM dogovori WHERE КодДоговора = '$order_id'";
        if (mysqli_query($conn, $delete_query)) {
            $_SESSION['cart_message'] = "Заказ успешно удален.";
        } else {
            $_SESSION['cart_error'] = "Ошибка при удалении заказа.";
        }
    } else {
        $_SESSION['cart_error'] = "Невозможно удалить заказ, так как его статус не завершен.";
    }
}

header("Location: account.php");
exit();
?>