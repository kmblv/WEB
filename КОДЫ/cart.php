<?php
session_start();
include "setup.php";
include "menu.php";
include "styles.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$client_id = $_SESSION['user_id'];

if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "Ваша корзина пуста.";
    exit();
}
$service_ids = implode(",", array_keys($_SESSION['cart']));
$query = "SELECT * FROM услуги WHERE КодУслуги IN ($service_ids)";
$services = mysqli_query($conn, $query);

$total_cost = 0;
while ($row = mysqli_fetch_assoc($services)) {
    $total_cost += $row['Стоимость'];
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <style>
        .container {
            width: 80%;
            margin: 50px auto;
        }

        .cart-container {
            background-color: white;
            color: black;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 60%;
        }

        .cart-item {
            margin: 15px 0;
            padding: 15px;
            background-color: #f2f2f2;
            border-radius: 10px;
            border: 1px solid #ddd;
            display: flex;
            justify-content: space-between; /* Выравнивание элементов по краям */
            align-items: center; /* Вертикальное выравнивание */
        }

        .total-cost {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .add-to-cart {
            background-color: #000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin-top: 20px;
            width: 95%;
        }

        .add-to-cart:hover {
            background-color: #121212;
        }

        .cart-item-list {
            margin-bottom: 20px;
        }

        .remove-button {
            color: white;
            text-decoration: none;
            background-color: #333;
            padding: 5px 10px; 
            border-radius: 5px; 
            transition: background-color 0.3s; 
        }

        .remove-button:hover {
            background-color: black;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="cart-container">
        <h2 style="text-align: center;">Корзина</h2>
        <div class="cart-item-list">
            <?php
            mysqli_data_seek($services, 0);
            while ($row = mysqli_fetch_assoc($services)) :
                $service_id = $row['КодУслуги'];
            ?>
                <div class="cart-item">
                    <p><strong><?= $row['Название'] ?></strong> - <?= $row['Стоимость'] ?> ₽</p>
                    <a href='remove_from_cart.php?service_id=<?= $service_id ?>' class='remove-button'>Удалить</a>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="total-cost">
            Итоговая стоимость: <?= $total_cost ?> ₽
        </div>

        <a href="make_order.php" class="add-to-cart">Оформить заказ</a>
    </div>
</div>

</body>
</html>
