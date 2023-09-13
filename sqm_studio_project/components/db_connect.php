<?php
// переменные для подключения к бд
$login = 'a0696370_sqm_studio'; // Имя пользователя
$password = '1l6o1v2e'; // Пароль
$host = 'localhost'; // Имя хоста
$db_name = 'a0696370_sqm_studio'; // имя БД // у меня так называется

// создаем объект подключения к бд
try{ 
    $pdo = new PDO("mysql:host=$host; dbname=$db_name", $login, $password);
}catch(Exception $error){
    echo 'Произошла ошибка при подключении к базе данных <br>';
    echo 'Попробуйте подключиться позже';
}

// echo 'Подключение установлено!';



