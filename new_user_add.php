<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "college81@";
$dbname = "aispk_med";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Захеширование пароля
$newPassword = 'C()llege81@@@';
$hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

// SQL-запрос для добавления нового пользователя
$sql = "INSERT INTO users (id, name, surname, email, password, email_verified_at, is_admin, created_at, updated_at)
VALUES ('1', 'Andrew', 'Gupalo', 'gupalo.av@gmail.com', '$hashedPassword', NOW(), true, NOW(), NOW())";

if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
