<?php
require_once 'connect.php'; // "Импорт" содержимого файла со строкой подключения

$user_id = $_SESSION["user"]["id"];
$timestamp_now = time() + 4*60*60;
$date = date("Y-m-d H:i:s", $timestamp_now);

$order_insert = mysqli_query($connect, "INSERT INTO `orders`(`id`, `user_id`, `datetime`, `status`) VALUES (NULL, '$user_id', '$date', '0')");
$order_id = mysqli_insert_id($connect);

foreach($_SESSION['cart'] as $item_id => $item){
    $count = $item["count"];
    $item_insert = mysqli_query($connect, "INSERT INTO `orders_products`(`product_id`, `order_id`, `count`) VALUES ('$item_id','$order_id','$count')");
}

unset($_SESSION['cart']);

// $response = [ // Создание JSON
//     "status" => true
// ];

// echo json_encode($response); // Отправка JSON на страницу
header('Location: ../index.php');