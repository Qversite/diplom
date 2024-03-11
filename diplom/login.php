<?php
session_start();

// Подключение к базе данных
$db = new mysqli('localhost', 'diary', '', 'diary');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);

    // Поиск пользователя в базе данных
    $result = $db->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Авторизация пользователя
            $_SESSION['user_id'] = $user['id'];
            header('Location: diary.php');
        } else {
            echo "Неверный пароль.";
        }
    } else {
        echo "Пользователь не найден.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Авторизация</title>
</head>
<body>
    <h2>Авторизация</h2>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
    </form>
</body>
</html>