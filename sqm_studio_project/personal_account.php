<?php
// session_start(); // запускаем сессию

require 'components/functions.php';
require 'pages_array.php';
$tytle = $pages_array['personal_account.php'];
require 'components/header.php';
require 'components/db_connect.php';
$form_tytle = $tytle;
// show_registration_info($_SESSION);
$submit_value = "Сохранить изменения"; // значение кнопки на странице регистрации
// получаем данные из сессии


// echo '_SESSION:';
// d($_SESSION);
// echo '_POST:';
// d($_POST);
// // // отображаем их в форме с изменяемыми полями
// d($_SERVER['REQUEST_METHOD']);

// получаем данные пользователя из БД
$query = "SELECT * 
                FROM users
                WHERE login=? and password=?;";
$select_query = $pdo->prepare($query);
$select_query->execute([$_SESSION['login'], $_SESSION['password']]);
$user = $select_query->fetch(PDO::FETCH_ASSOC);
// echo '$user';
// d($user);

// if (!isset($_SESSION['login'])){
//     header('Location: exit.php');    
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // если изменены данные и отправлена форма
    // Проверяем введенные пользователем данные 
    list($inputs, $errors) = validate_registration_form(); // запускается проверка введенных данных
    // d($errors);
    $haveErrors = false;
    foreach ($errors as $key => $value) {
        if ($value !== '') {
            $haveErrors = true;
        }
    }
    if ($haveErrors) { // если есть ошибки, выводит ошибки и эту же форму.
        show_form($inputs, $errors, $submit_value, $form_tytle);
    }else{ // если все хорошо, выводит сообщение, что данные успешно изменены.
        // echo '$inputs';
        // d($inputs);
        $query = "UPDATE users
                    SET first_name=?, patronymic=?, last_name=?, login=?, email=?, company=?, project=?, role=?, password=?
                    WHERE id=?;";
        $update_query = $pdo->prepare($query);
        $update_query->execute([$inputs['first_name'], $inputs['patronymic'], $inputs['last_name'], $inputs['login'], $inputs['email'], $inputs['company'], $inputs['project'], $inputs['role'], $inputs['password'], $user['id']]);
        $form_tytle = "Данные успешно сохранены!<br>Личный кабинет пользователя: $inputs[first_name] $inputs[patronymic]";
        header('Location: personal_account.php');
        $query = "SELECT * 
                    FROM users
                    WHERE id=?;";
        $select_query = $pdo->prepare($query);
        $select_query->execute([$user['id']]);
        $user = $select_query->fetch(PDO::FETCH_ASSOC);
        $errors = [];
        show_form($user, $errors, $submit_value, $form_tytle);
        
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
        // перезагружаем страницу для установки данных сессии
        // header('Location: personal_account.php');
    }
}else{
    
    $errors = [];
    show_form($user, $errors, $submit_value, $form_tytle);

}
echo '<h3><a class="to-page" href="exit.php">Выйти</a></h3>';


// попробовать обработать радио с помощью JS
// JS: регистрация,вход, лк


require 'components/footer.php';

?>




