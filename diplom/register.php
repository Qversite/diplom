<?php
session_start();

// Подключение к базе данных
$db = new mysqli('localhost', 'diary', '', 'users');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $db->real_escape_string($_POST['username']);
    $password = password_hash($db->real_escape_string($_POST['password']), PASSWORD_DEFAULT);

    // Проверка на существующего пользователя
    $result = $db->query("SELECT * FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        echo "Пользователь с таким именем уже существует.";
    } else {
        // Регистрация нового пользователя
        $db->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "Вы успешно зарегистрировались!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
</head>
<body>
    <h2>Регистрация</h2>
    <form method="post" action="register.php">
        <input type="text" name="username" placeholder="Имя пользователя" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>