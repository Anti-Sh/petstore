<?php
require_once 'connect.php'; // "Импорт" содержимого файла со строкой подключения

$id = $_POST['id']; // Взятие значения из POST
$incr = $_POST['increment']; // Взятие значения из POST


if(trim($incr) === "true"){
    if($_SESSION['cart'][$id]["count"] < 8){
        $_SESSION['cart'][$id]["count"]++;
    }
    $response = [ // Создание JSON
        "status" => true,
        "count" => $_SESSION['cart'][$id]["count"],
        "price" => $_SESSION['cart'][$id]["count"] * $_SESSION['cart'][$id]["price"]
    ];
    
    echo json_encode($response); // Отправка JSON на страницу
    die();
}
else{
    if($_SESSION['cart'][$id]["count"] >= 2){
        $_SESSION['cart'][$id]["count"]--;
    }
    $response = [ // Создание JSON
        "status" => true,
        "count" => $_SESSION['cart'][$id]["count"],
        "price" => $_SESSION['cart'][$id]["count"] * $_SESSION['cart'][$id]["price"]
    ];
    
    echo json_encode($response); // Отправка JSON на страницу
    
}

