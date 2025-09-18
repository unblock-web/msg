<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Подключение к базе
$servername = "localhost";
$username = "root";   // у XAMPP/MAMP по умолчанию root
$password = "";       // пароль пустой, если не менял
$dbname = "FormBase1";

// Создаём подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получаем данные из формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $pass = trim($_POST["password"]);

    // Хешируем пароль
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    // SQL для вставки
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $user, $email, $hash);

    if ($stmt->execute()) {
        echo "✅ Регистрация прошла успешно!<br>";
        echo "<a href='/index.html'>Войти</a>";
    } else {
        echo "❌ Ошибка: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>