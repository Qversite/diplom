<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Получение данных пользователя
$db = new mysqli('localhost', 'diary', '', 'users');
$user_id = $_SESSION['user_id'];
$result = $db->query("SELECT * FROM users WHERE id = $user_id");
$user = $result->fetch_assoc();

// Отображение дневника
echo "Добро пожаловать, " . $user['username'] . "!";

// Здесь можно добавить функционал для создания и просмотра записей в дневнике
?>

<!DOCTYPE html>
<html>
<head>
    <title>Электронный дневник</title>
</head>
<body>
    <h2>Мой дневник</h2>
    <!-- Здесь можно добавить форму для создания записей и список существующих записей -->
</body>
</html>