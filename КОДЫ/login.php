<?php 
session_start();
include "menu.php"; 
include "styles.php";
mysqli_set_charset($conn, 'utf8');
$captcha_code = rand(1000, 9999);
$_SESSION['captcha'] = $captcha_code;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - Студия дизайна интерьера</title>
<style>
        .form-toggle { text-align: center; margin-bottom: 20px; }
        .hidden { display: none; }
        .error { color: red; margin-top: 10px; }
        input[type="text"], input[type="password"], input[type="email"], input[type="tel"] {
            width: 100%; padding: 8px; margin-bottom: 10px;
        }
    </style>
    <script>
        function toggleForms() {
            document.getElementById('login-form').classList.toggle('hidden');
            document.getElementById('register-form').classList.toggle('hidden');
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="form-toggle">
            <button onclick="toggleForms()">Зарегистрироваться</button>
        </div>

        <!-- Форма входа -->
        <div id="login-form">
            <h2>Авторизация</h2>
            <?php if (isset($_SESSION['login_error'])): ?>
                <div class="error"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
            <?php endif; ?>
            <form action="auth.php" method="post">
                <label>Логин:</label>
                <input type="text" name="login" required>
                <label>Пароль:</label>
                <input type="password" name="password" required>
                <button type="submit">Войти</button>
            </form>
        </div>

        <!-- Форма регистрации -->
        <div id="register-form" class="hidden">
            <h2>Регистрация</h2>
            <?php if (isset($_SESSION['reg_error'])): ?>
                <div class="error"><?= $_SESSION['reg_error']; unset($_SESSION['reg_error']); ?></div>
            <?php endif; ?>
            <form action="register.php" method="post">
                <label>ФИО:</label>
                <input type="text" name="name" required>
                <label>Почта:</label>
                <input type="email" name="email" required>
                <label>Телефон:</label>
                <input type="tel" name="phone" pattern="[0-9]{10,15}" required>
                <label>Логин:</label>
                <input type="text" name="login" required>
                <label>Пароль:</label>
                <input type="password" name="password" required>
                <label>Введите код с картинки: <strong><?= $_SESSION['captcha'] ?></strong></label>
                <input type="text" name="captcha" required>
                <button type="submit" name="add">Регистрация</button>
            </form>
        </div>
    </div>
</body>
</html>