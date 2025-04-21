<?php
session_start();
include "setup.php";

function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $login = mysqli_real_escape_string($conn, $login);
    $query = "SELECT * FROM customers WHERE Логин = '$login'";
    
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if ($password == $user['Пароль']) {
            $_SESSION['user_id'] = $user['КодЗаказчика'];
            $_SESSION['user_name'] = $user['ФИО'];
            $_SESSION['logged_in'] = true;
            header("Location: index.php");
            exit();
        }
    }
    
    $_SESSION['login_error'] = "Неверный логин или пароль";
    header("Location: login.php");
    exit();
}?>