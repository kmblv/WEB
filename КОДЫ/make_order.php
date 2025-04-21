<?php
session_start();
include "setup.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include "menu.php";

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $address = $_POST['address'];
    $square = $_POST['square'];
    $contractNumber = rand(100, 999) . '-' . rand(100, 999);
    $date = date("Y-m-d");

    $createContract = mysqli_query($conn, "INSERT INTO dogovori (Номердоговора, Датазаключения, Площадьобъекта, Адресобъекта, КодЗаказчика) 
        VALUES ('$contractNumber', '$date', $square, '$address', $client_id)");

    if (!$createContract) {
        echo "Ошибка при создании договора.";
        exit();
    }

    $contract_id = mysqli_insert_id($conn);
	foreach (array_keys($_SESSION['cart']) as $service_id) {
		mysqli_query($conn, "INSERT INTO содержат (КодДоговора, КодУслуги, Статус) 
			VALUES ($contract_id, $service_id, 'В процессе')");
	}
    unset($_SESSION['cart']);
$_SESSION['last_contract_id'] = $contract_id;
header("Location: order_success.php");
exit();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <style>
	<link rel="stylesheet" href="styles.css">
        .container {
            width: 80%;
            margin: 50px auto;
        }

        .order-form {
            background-color: white;
            color: black;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            width: 60%;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
			background-color: #f2f2f2;
			color: black;
        }

        .total-cost {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }

        .submit-btn {
            background-color: #000;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #121212;
        }

        .cart-item-list {
            margin-bottom: 20px;
        }

        .cart-item {
            margin: 10px 0;
            padding: 10px;
            background-color: #f2f2f2;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="order-form">
        <h2 style="text-align: center;">Оформление заказа</h2>
        <div class="cart-item-list">
            <?php
            mysqli_data_seek($services, 0);
            while ($row = mysqli_fetch_assoc($services)) :
            ?>
                <div class="cart-item">
                    <p><strong><?= $row['Название'] ?></strong> - <?= $row['Стоимость'] ?> ₽</p>
                </div>
            <?php endwhile; ?>
        </div>

        <form action="make_order.php" method="POST">
            <label for="address">Адрес объекта:</label>
            <input type="text" name="address" class="form-input" required>

            <label for="square">Площадь объекта (м²):</label>
            <input type="number" name="square" class="form-input" required>
				<div class="total-cost">
            Итоговая стоимость: <?= $total_cost ?> ₽
        </div>
            <button type="submit" class="submit-btn">Оформить заказ</button>
        </form>

    </div>
</div>

</body>
</html>