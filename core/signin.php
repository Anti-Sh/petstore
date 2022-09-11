<?php
require_once 'connect.php'; // "Импорт" содержимого файла со строкой подключения

$email = $_POST['email']; // Взятие значения из POST
$password = $_POST['password'];  // Взятие значения из POST

$error_fields = [];  // Незаполненные поля

if ($email === '') {
    $error_fields[] = 'email_login';
}
if ($password === '') {
    $error_fields[] = 'password_login';
}
if (!empty($error_fields)) {
    $response = [ // Создание JSON
        "status" => false,
        "type" => 1,
        "message" => "Заполните выделенные поля и попробуйте снова",
        "fields" => $error_fields
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");
if (mysqli_num_rows($check_user) > 0) { // Проверка на соответствие введенных данных
    $user = mysqli_fetch_assoc($check_user); // массив полей, полученный в результате выполнения запроса
    $id = $user['id'];
    $orders_count = mysqli_query($connect, "SELECT * FROM `orders` WHERE `user_id`='$id'");
    mysqli_num_rows($orders_count) > 0 ? $result = mysqli_num_rows($orders_count) : $result = 0;
    $_SESSION['user'] = [ // Создание переменной в сессии
        "id" => $user['id'],
        "email" => $user['email'],
        "tel" => $user['tel'],
        "name" => $user['name'],
        "orders" => $result,
        "date" => $user['reg_date']
    ];

    $response = [ // Создание JSON
        "status" => true
    ];
    echo json_encode($response); // Отправка JSON на страницу

} 
else {
    $response = [
        "status" => false,
        "message" => 'Неверный логин или пароль'
    ];

    echo json_encode($response);
}