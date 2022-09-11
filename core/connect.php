<?php
    $connect = mysqli_connect('localhost', 'root', '', 'petshop') or die('Не удалось подключиться к базе данных');
    session_start();