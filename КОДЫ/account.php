<?php
session_start();
include "setup.php";
include "menu.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Получаем ID текущего пользователя
mysqli_query($conn, "UPDATE customers SET VisitsCount = VisitsCount + 1 WHERE КодЗаказчика = '$user_id'");
// Получаем данные пользователя
$user_query = "SELECT * FROM customers WHERE КодЗаказчика = '$user_id'";
$user_result = mysqli_query($conn, $user_query);

if (!$user_result || mysqli_num_rows($user_result) == 0) {
    die("Пользователь не найден");
}

$user = mysqli_fetch_assoc($user_result);


$order_query = "SELECT * FROM dogovori WHERE КодЗаказчика = '$user_id'";
$order_result = mysqli_query($conn, $order_query);

if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    $status_query = "SELECT содержат.Статус FROM содержат INNER JOIN dogovori ON содержат.КодДоговора = dogovori.КодДоговора WHERE dogovori.КодДоговора = '$order_id' AND dogovori.КодЗаказчика = '$user_id'";
    $status_result = mysqli_query($conn, $status_query);
    $status = mysqli_fetch_assoc($status_result);
    
    if ($status['Статус'] == 'Завершен') {
        $delete_order_query = "DELETE FROM dogovori WHERE КодДоговора = '$order_id'";
        if (mysqli_query($conn, $delete_order_query)) {
            $_SESSION['cart_message'] = "Заказ успешно удален.";
        } else {
            $_SESSION['cart_error'] = "Ошибка при удалении заказа.";
        }
    } else {
        $_SESSION['cart_error'] = "Невозможно удалить заказ, так как его статус не завершен.";
    }
    header("Location: account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - Студия дизайна интерьера</title>
    <style>
.form-input {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
}

.form-input label {
    width: 150px;
    text-align: left;
    font-weight: bold;
}

.form-input span, .form-input input {
    padding: 8px 10px;
    border-radius: 4px;
    min-width: 250px;
    background-color: #f2f2f2;
    color: black;
}

.form-input input {
    border: 1px solid #ccc;
}

.form-button {
    padding: 10px 20px;
    margin-top: 10px;
    background-color: white;
    color: black;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
}

.form-button:hover {
    background-color: #f2f2f2;
}

.success-message {
    color: green;
    font-weight: bold;
    margin-bottom: 10px;
}

.error-message {
    color: red;
    font-weight: bold;
    margin-bottom: 10px;
}
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
            font-family: Arial, sans-serif;
        }

        .menu {
            display: flex;
            justify-content: space-around;
            background-color: #121212;
            padding: 10px;
            border-bottom: 2px solid #444;
        }

        .menu a {
            text-decoration: none;
            color: white;
            flex: 1;
            text-align: center;
            padding: 10px;
        }

        .menu a:hover {
            background-color: #333;
            border-radius: 5px;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background-color: #333;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .card p {
            font-size: 16px;
            margin-bottom: 10px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .order-table th, .order-table td {
            padding: 10px;
            border: 1px solid #444;
        }

        .order-table th, tr {
            background-color: #222;
        }


        .order-table td {
            text-align: center;
        }

        .order-table td a {
            color: red;
            text-decoration: none;
        }

        .order-table td a:hover {
            text-decoration: underline;
        }


    </style>


</head>
<body>
<div class="container">
<div class="card">
    <h2>Личные данные</h2>


<form id="profile-form" method="POST" action="update_profile.php">
    <div class="form-input">
        <label>ФИО</label>
        <span id="fio-text"><?= htmlspecialchars($user['ФИО']) ?></span>
        <input type="text" id="fio" name="fio" value="<?= htmlspecialchars($user['ФИО']) ?>" style="display:none;" required>
    </div>
    <div class="form-input">
        <label>Почта</label>
        <span id="email-text"><?= htmlspecialchars($user['Почта']) ?></span>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['Почта']) ?>" style="display:none;" required>
    </div>
    <div class="form-input">
        <label>Телефон</label>
        <span id="phone-text"><?= htmlspecialchars($user['Номертелефона']) ?></span>
        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['Номертелефона']) ?>" style="display:none;" required>
    </div>
	<div class="form-input"><p>Количество посещений: <?= $user['VisitsCount'] ?></p></div>
    <div>
        <button type="button" id="edit-button" class="form-button">Изменить</button>
        <button type="submit" name="update_profile" id="save-button" class="form-button" style="display:none;">Сохранить</button>
    </div>
</form>
</div>
    <div class="card">
        <h2>Ваши заказы</h2>
<table class="order-table">
    <thead>
        <tr>
            <th>Номер заказа</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Услуги</th>
            <th>Итоговая стоимость</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php
while ($order = mysqli_fetch_assoc($order_result)) {
    $order_id = $order['КодДоговора'];
    
    // Получаем услуги, статус и стоимость
    $services_query = "
        SELECT услуги.Название, услуги.Стоимость, содержат.Статус
        FROM содержат
        INNER JOIN услуги ON содержат.КодУслуги = услуги.КодУслуги
        WHERE содержат.КодДоговора = '$order_id'
    ";
    $services_result = mysqli_query($conn, $services_query);

    $services_list = "";
    $total_cost = 0;
    $delivery_status = ""; // статус доставки из содержат

    while ($service = mysqli_fetch_assoc($services_result)) {
        $services_list .= htmlspecialchars($service['Название']) . " (" . $service['Стоимость'] . "₽)<br>";
        $total_cost += $service['Стоимость'];
        $delivery_status = htmlspecialchars($service['Статус']); // можно перезаписывать, если одинаковый
    }

    echo "<tr>
        <td>{$order['Номердоговора']}</td>
        <td>{$order['Датазаключения']}</td>
        <td>{$delivery_status}</td>
        <td>{$services_list}</td>
        <td>{$total_cost} ₽</td>
        <td>";

    if ($delivery_status === 'Завершен') {
        echo "<a href='?delete_order={$order['КодДоговора']}'>Удалить</a>";
    }

    echo "</td></tr>";
}
        ?>
    </tbody>
</table>
    </div>
</div>
<script>
  document.getElementById('edit-button').addEventListener('click', function () {
    ['fio', 'email', 'phone'].forEach(function(field) {
      document.getElementById(field + '-text').style.display = 'none';
      document.getElementById(field).style.display = 'inline-block';
    });

    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('save-button').style.display = 'inline-block';
  });
</script>
</body>
</html>