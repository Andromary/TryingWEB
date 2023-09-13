<?php

require 'components/functions.php';
require 'pages_array.php';
$tytle = $pages_array['registration.php'];
require 'components/header.php';
require 'components/db_connect.php';

$query = "CREATE TABLE IF NOT EXISTS users( 
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(255) NOT NULL,
    patronymic VARCHAR(255),
    last_name VARCHAR(255) NOT NULL,
    login VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    company VARCHAR(255),
    project VARCHAR(255),
    role VARCHAR(255),
    password VARCHAR(255) NOT NULL);";

$pdo->exec($query);
// error_reporting(E_ALL);
session_start(); // запускаем сессию
$isset_session = true; // флаг, установлена ли сессия

if ($_SESSION === []) { // если для какого-либо из обязательных элементов сессия не установлена 
        $isset_session = false; // изменяем значение флага на $isset_session на false 
        // d($isset_session);
    
        
} 

foreach ($_SESSION as $key => $value){
    if ($key === 'patronymic' or $key === 'company' or $key ==='project' or $key === 'role'){ // исключаем необязательные элементы
        continue;
    }elseif(!isset($_SESSION[$key])){
        $isset_session = false; // изменяем значение флага на $isset_session на false 
        d($isset_session);
    }
}

// d($isset_session);
// d($_POST);
if ($isset_session) {// если сессия установлена           
    // будем выводить приветствие пользователю
    succeeded_registration_form($_SESSION);
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // если отправлена форма
        // d($_POST);
        // Проверяем введенные пользователем данные 
        list($inputs, $errors) = validate_registration_form(); // разделяем возвращенный массив на два одноименных массива
        // d($errors);
        $haveErrors = false;
        foreach ($errors as $key => $value) {
            if ($value !== '') {
                $haveErrors = true;
            }
        }
        if ($haveErrors) {
            show_form($inputs, $errors);
        } else {
            // устанавливаем данные сессии
            // забираем данные из массива $_POST, экранируем и кладем в $_SESSION
            $_SESSION['first_name'] = htmlspecialchars(trim($_POST['first_name']));
            $_SESSION['patronymic'] = htmlspecialchars(trim($_POST['patronymic']));
            $_SESSION['last_name'] = htmlspecialchars(trim($_POST['last_name']));
            $_SESSION['login'] = htmlspecialchars(trim($_POST['login']));
            $_SESSION['email'] = htmlspecialchars(trim($_POST['email']));
            $_SESSION['company'] = htmlspecialchars(trim($_POST['company']));
            $_SESSION['project'] = htmlspecialchars(trim($_POST['project']));
            $_SESSION['role'] = $_POST['role']; // не нужно регулировать этот пунт, выбирается из двух: buyer/supplier
            $_SESSION['password'] = htmlspecialchars(trim($_POST['password']));
            $_SESSION['password_check'] = htmlspecialchars(trim($_POST['password_check']));
            // // перезагружаем страницу для установки данных сессии
            $insert_query = $pdo->prepare("INSERT INTO users VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert_query->execute([null, $inputs['first_name'], $inputs['patronymic'], $inputs['last_name'], $inputs['login'], $inputs['email'], $inputs['company'], $inputs['project'], $input['role'], $inputs['password'] ]); // подготовленный запрос можно выполнять несколько раз, даже в цыкле
            header('Location: registration.php');

            succeeded_registration_form($inputs); // изменение данных после регистрации пользователя php - в личном кабинете!
        }
    } else {
        show_form();
    }
}



// $maxlifetime = ini_get("session.gc_maxlifetime");
// $cookielifetime = ini_get("session.cookie_lifetime");
// $maxlifetime = 86400;
// echo $maxlifetime .'<br>';
// echo $cookielifetime;

?>
<?php
require 'components/footer.php';
?>