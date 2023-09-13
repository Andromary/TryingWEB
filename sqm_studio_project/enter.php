<?php

require 'components/functions.php';
require 'pages_array.php';
$tytle = $pages_array['enter.php'];
require 'components/header.php';
require 'components/db_connect.php';
// require 'components/header.php';
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['password'])){
    header('Location: personal_account.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // если изменены данные и отправлена форма
    $errors = []; // ошибки 
    $inputs = []; // данные
    $inputs['enter'] = htmlspecialchars( trim( $_POST['enter'] ) );
    $inputs['password'] = htmlspecialchars( trim( $_POST['password'] ) );
    
    $query = "SELECT *
                FROM users
                WHERE login=? or email=?;";
    $select_query = $pdo->prepare($query);
    $select_query->execute([$inputs['enter'], $inputs['enter']]);
    $logname = $select_query->fetch(PDO::FETCH_ASSOC);

    if(empty($inputs['password'])){
        $errors['password'] = 'Поле не может быть пустым!';
    }
    if (empty($inputs['enter'] )){
        $errors['enter'] = 'Поле не может быть пустым!';
    }elseif (($inputs['enter'] === $logname['login']) || ($inputs['enter'] === $logname['email'])){
        if ($inputs['password'] !== $logname['password']){
            $errors['password'] = 'Введён неверный пароль!';
        }
    }else{
        $errors['enter'] = 'Пользователь с такими данными не зарегистрирован!';
    }
    
    // list($inputs, $errors) = validate_enter(); // запускается проверка введенных данных
    // d($errors);
    $haveErrors = false;
    foreach ($errors as $key => $value) {
        if ($value !== '') {
            $haveErrors = true;
        }
    }
    if ($haveErrors) { // если есть ошибки, выводит ошибки и эту же форму.
        show_enter($inputs, $errors);
    }else{
        $_SESSION['first_name'] = $logname['first_name'];
        $_SESSION['patronymic'] = $logname['patronymic'];
        $_SESSION['last_name'] = $logname['last_name'];
        $_SESSION['login'] = $logname['login'];
        $_SESSION['email'] = $logname['email'];
        $_SESSION['company'] = $logname['company'];
        $_SESSION['project'] = $logname['project'];
        $_SESSION['role'] = $_POST['role']; // не нужно регулировать этот пунт, выбирается из двух: buyer/supplier
        $_SESSION['password'] = $logname['password'];
        $_SESSION['password_check'] = $logname['password_check'];
        // перезагружаем страницу для установки данных сессии
        header('Location: personal_account.php');
    }
}else{
    show_enter();
}


?>

<?php
// require 'components/footer.php';
?>