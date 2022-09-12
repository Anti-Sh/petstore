<?php
require_once 'connect.php'; // "Импорт" содержимого файла со строкой подключения

$id = $_POST['id']; // Взятие значения из POST


if(!$_SESSION['cart'][$id]){
    $product = mysqli_fetch_array(mysqli_query($connect, "SELECT `name`,`cost` FROM `catalog` WHERE `id`='$id';"));

    $_SESSION['cart'][$id] = [ // Создание переменной в сессии
        "name" => $product[0],
        "count" => 1,
        "price" => $product[1]
    ];
    $response = [ // Создание JSON
        "status" => true,
        "type" => true,
        "message" => "Товар добавлен в корзину",
        "id" => $id,
        "name" => $product[0],
        "count" => 1,
        "price" => $product[1]
    ];
    
    echo json_encode($response); // Отправка JSON на страницу
    die();
}
else{
    unset($_SESSION['cart'][$id]);
    $response = [ // Создание JSON
        "status" => true,
        "type" => false,
        "message" => "Товар удален из корзины",
        "id" => $id
    ];
    
    echo json_encode($response); // Отправка JSON на страницу
    
}

