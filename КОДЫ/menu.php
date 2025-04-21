<?php 
session_start();
include "setup.php"; 
include "auth.php";
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Студия дизайна интерьера</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
        }
        @font-face {
            font-family: Neutral Face;
            src: url('NeutralFace.otf') format('otf');
        }

        .menu {
            display: flex;
            justify-content: space-around;
            background-color: #121212;
            padding: 10px;
            border-bottom: 2px solid #444;
            font-family: Neutral Face;
            font-size:14px;
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
        .logout-button {
            background-color: #fff;
            border-radius: 5px;
            padding: 5px 10px;
            margin-left: auto;
            transition: background-color 0.3s;
            font-size: 14px;
            text-align: center;
            display: inline-block;
            height: 50px; 
            color: black !important; /* Переопределение цвета для кнопки выхода */
        }

        .logout-button:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>

    <div class="menu">
        <a href="index.php">Главная</a>
        <a href="gallery.php">Галерея</a>
        <a href="services.php">Услуги</a>
        
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
            <a href="cart.php">Корзина</a>
            <a href="account.php">Личный кабинет (<?= htmlspecialchars($_SESSION['user_name']) ?>)</a>
            <a href="logout.php" class="logout-button">Выход</a>
        <?php else: ?>
            <a href="login.php">Вход</a>
        <?php endif; ?>
    </div>

</body>
</html>