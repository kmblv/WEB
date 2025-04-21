<?php
session_start();
session_unset();    // очищает все переменные сессии
session_destroy();  // уничтожает сессию

header("Location: index.php");
exit();
?>