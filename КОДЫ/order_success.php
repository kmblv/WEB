<?php
session_start();
$contract_id = $_SESSION['last_contract_id'] ?? null;
if (!$contract_id) {
    header("Location: index.php");
    exit();
}
include "setup.php";
include "menu.php";

if (!isset($_GET['contract_id'])) {
    header("Location: index.php");
    exit();
}

$contract_id = $_GET['contract_id'];

// Получаем данные о заказе
$query = "SELECT * FROM dogovori WHERE КодДоговора = '$contract_id'";
$order = mysqli_query($conn, $query);
$order_data = mysqli_fetch_assoc($order);

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Успешное оформление заказа</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: white;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
        }

        .order-success {
            background-color: white;
            color: black;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 60%;
        }

        .order-success h2 {
            text-align: center;
        }

        .order-details {
            margin-top: 20px;
        }

        .order-details p {
            font-size: 18px;
        }

    </style>
</head>
<body>

<div class="container">
<div class="order-success">
    <h2 style="text-align: center;">Ваш заказ успешно оформлен!</h2>
    <div class="order-details">
        <p><strong>Номер договора:</strong> <?= $order_data['Номердоговора'] ?></p>
        <p><strong>Дата заключения:</strong> <?= $order_data['Датазаключения'] ?></p>
        <p><strong>Адрес объекта:</strong> <?= $order_data['Адресобъекта'] ?></p>
        <p><strong>Площадь объекта:</strong> <?= $order_data['Площадьобъекта'] ?> м²</p>
        <p><strong>Статус:</strong> В процессе</p>
    </div>
    <a href="index.php" class="add-to-cart">Вернуться на главную</a>
</div>
</div>

</body>
</html>