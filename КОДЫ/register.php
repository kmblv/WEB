<?php
session_start();
include "setup.php";
mysqli_set_charset($conn, "utf8mb4");
function Clean($input) {
    return htmlspecialchars(trim($input));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$login = mysqli_real_escape_string($conn, $_POST['login']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$captcha = mysqli_real_escape_string($conn, $_POST['captcha']);

		if (empty($name)  || empty($email)  || empty($phone)  || empty($login) || empty($password) || empty($captcha)) {
			$_SESSION['reg_error'] = "Пожалуйста, заполните все поля.";
			header("Location: login.php");
			exit();
		}

		if ($captcha != $_SESSION['captcha']) {
			$_SESSION['reg_error'] = "Неверный код с картинки.";
			header("Location: login.php");
			exit();
		}

	$check = mysqli_query($conn, "SELECT * FROM customers WHERE Логин = '$login'");
	$insertQuery = "INSERT INTO `customers` (`КодЗаказчика`, `ФИО`, `Почта`, `Номертелефона`, `Логин`, `Пароль`) VALUES (NULL, '$name', '$email', '$phone', '$login', '$password')";

		if (mysqli_query($conn, $insertQuery)) {
			$_SESSION['logged_in'] = true;
			$_SESSION['user_name'] = $name;
			header("Location: index.php");
		} else {
			$_SESSION['reg_error'] = "Ошибка при регистрации: " . mysqli_error($conn);
			header("Location: login.php");
		}
	}
?>

