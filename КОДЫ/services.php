<?php 
include "setup.php";
include "menu.php";
include "styles.php";
session_start();
if (isset($_SESSION['cart_message'])) {
    echo "<div class='cart-message'>{$_SESSION['cart_message']}</div>";
    unset($_SESSION['cart_message']);
}
if (isset($_SESSION['cart_error'])) {
    echo "<div class='cart-error'>{$_SESSION['cart_error']}</div>";
    unset($_SESSION['cart_error']);
}
if (isset($_GET['add_to_cart']) && !isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
	
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги</title>
    <style>
	.cart-message {
    padding: 15px;
    background: #333;
    color: white;
    text-align: center;
    margin: 20px auto;
    width: 80%;
    border-radius: 8px;
}

.cart-error {
    padding: 15px;
    background: #f2dede;
    color: #a94442;
    text-align: center;
    margin: 20px auto;
    width: 80%;
    border-radius: 8px;
}
	 .add-to-cart {
            background-color: #333;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        .add-to-cart:hover {
            background-color: #121212;
        }

        .service-card {
            position: relative;
        }
        .filter-container {
            display: flex; 
            justify-content: center; 
            gap: 20px;
            margin-bottom: 15px;
            width: 50%; 
            margin: 0 auto; 
        }

        .filter-box {
            background-color: #fff; 
            color: #000; 
            border-radius: 8px;
            padding: 15px;
            flex: 1;
            min-width: 150px;
            border: 1px solid #ccc;
        }

        .filter-box label {
            display: block;
            margin-bottom: 8px;
            color: #000;
        }

        .filter-box select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc; 
            border-radius: 5px;
            background-color: #f0f0f0; 
            color: #000; 
        }

        .filter-submit {
            display: flex;
            justify-content: center; 
            margin-top: 15px;
            width: 100%; 
        }

        .filter-submit button {
            background-color: #fff; 
            color: #000;
            padding: 10px 25px;
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            width: 50%;
        }

        .filter-submit button:hover {
            background-color: #f0f0f0;
        }
		
		    .cards-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
    }

    .service-card {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 12px;
        padding: 20px;
        width: 300px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .service-card:hover {
        transform: scale(1.02);
    }

    .service-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .service-price {
        font-size: 18px;
        color: #555;
        margin-bottom: 10px;
    }

    .service-description {
        font-size: 15px;
        color: #666;
        margin-bottom: 10px;
    }

    .service-type {
        font-size: 14px;
        color: #888;
    }
    </style>
</head>
<body>
<br><br>
<form method="GET">
    <div class="filter-container">
        <div class="filter-box">
            <label>Выберите тип услуги:</label>
            <select name="type">
                <option value="">Все типы</option>
                <?php
                $typeSql = mysqli_query($conn, "SELECT * FROM типуслуг");
                while ($type = mysqli_fetch_array($typeSql)) {
                    $selected = (isset($_GET['type']) && $_GET['type'] == $type['КодТипаУслуги']) ? 'selected' : '';
                    echo "<option value='".$type['КодТипаУслуги']."' $selected>".$type['Вид услуги']."</option>";
                }
                ?>
            </select>
        </div>
		

        <div class="filter-box">
            <label>Сортировать по стоимости:</label>
            <select name="sort">
                <option value="ASC" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'ASC') echo 'selected'; ?>>По возрастанию</option>
                <option value="DESC" <?php if (isset($_GET['sort']) && $_GET['sort'] == 'DESC') echo 'selected'; ?>>По убыванию</option>
            </select>
        </div>
    </div>

    <div class="filter-submit">
        <button type="submit">Применить</button>
    </div>
</form>
<div class="solid-divider"></div>

    
<h2 style="text-align: center; margin-top: 30px;">Список Услуг</h2>
<div class="cards-container">
<?php
$typeFilter = isset($_GET['type']) ? $_GET['type'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ASC';

$sql = "SELECT услуги.*, типуслуг.`Вид услуги` AS Тип
        FROM услуги 
        JOIN типуслуг ON услуги.КодТипаУслуги = типуслуг.КодТипаУслуги";

if ($typeFilter) {
    $sql .= " WHERE услуги.КодТипаУслуги = '$typeFilter'";
}

$sql .= " ORDER BY услуги.Стоимость $sort";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<div class='service-card'>
                <div class='service-title'>{$row['Название']}</div>
                <div class='service-price'>Стоимость: {$row['Стоимость']} ₽</div>
                <div class='service-description'>{$row['Описание']}</div>
                <div class='service-type'>Тип: {$row['Тип']}</div>
				<a href='add_to_cart.php?service_id={$row['КодУслуги']}' class='add-to-cart'>
                    Добавить в корзину
                </a>
              </div>";
    }
} else {
    echo "<p style='text-align: center;'>Нет доступных услуг</p>";
}
?>
</div>

    <?php $conn->close(); ?>
</body>
</html>
