<?php
require_once 'connect.php'; // "Импорт" содержимого файла со строкой подключения

$email = $_POST['email']; // Взятие значения из POST
$password = $_POST['password'];  // Взятие значения из POST
$password_confirm = $_POST['password_confirm'];  // Взятие значения из POST
$telephone = $_POST['telephone'];  // Взятие значения из POST
$name = $_POST['name'];  // Взятие значения из POST

$error_fields = [];  // Незаполненные поля

if ($email === '') $error_fields[] = 'email'; // Проверка полей на пустоту
if ($password === '') $error_fields[] = 'password1'; // Проверка полей на пустоту
if ($password_confirm === '') $error_fields[] = 'password2'; // Проверка полей на пустоту
if ($telephone === '') $error_fields[] = 'telephone'; // Проверка полей на пустоту
if ($name === '') $error_fields[] = 'username'; // Проверка полей на пустоту

if (!empty($error_fields)) { // Проверка на наличие пустых полей
    $response = [ // Создание JSON
        "status" => false,
        "type" => 1,
        "message" => "Заполните выделенные поля и попробуйте снова",
        "fields" => $error_fields
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){ // Проверка почты на валидность
    $error_fields[] = 'mail'; 
    $response = [ // Создание JSON
        "status" => false,
        "type" => 1,
        "message" => "Укажите существующую почту!",
        "fields" => $error_fields
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}
if ($password !== $password_confirm){
    $error_fields[] = 'password';
    $response = [ // Создание JSON
        "status" => false,
        "type" => 1,
        "message" => "Пароли не совпадают!",
        "fields" => $error_fields
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}
if (strlen($password) < 6){
    $error_fields[] = 'password';
    $response = [ // Создание JSON
        "status" => false,
        "type" => 1,
        "message" => "Длина пароля не может быть меньше 6 символов!",
        "fields" => $error_fields
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}

$check_email = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'");
$check_tel = mysqli_query($connect, "SELECT * FROM `users` WHERE `tel` = '$telephone'");

if (mysqli_num_rows($check_email) > 0) $msg = "Пользователь с такой почтой уже зарегистрирован!";
if (mysqli_num_rows($check_tel) > 0) $msg = "Пользователь с таким номером телефона уже зарегистрирован!";
if (!empty($msg)){
    $response = [ // Создание JSON
        "status" => false,
        "message" => $msg
    ];
    echo json_encode($response); // Отправка JSON на страницу
    die(); // Прекращение выполнения кода
}

$insert_query = "INSERT INTO `users`(`id`, `email`, `tel`, `name`, `password`) VALUES (NULL, '$email','$telephone','$name','$password')";
mysqli_query($connect, $insert_query);

$response = [ // Создание JSON
    "status" => true,
    "message" => "Аккаунт зарегистрирован. Авторизируйтесь"
];
echo json_encode($response); // Отправка JSON на страницу