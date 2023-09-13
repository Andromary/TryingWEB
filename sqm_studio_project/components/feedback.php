<?php
require 'components/functions.php';
require 'components/db_connect.php';


// отображаем форму
// Пользователь заполняет форму
// Экранируем данные
// проверяем заполнение полей
// если все поля заполнены, проверяем корректность данных
// пишем функцию проверки введенных данны
// если данные корректны, высвечиваем пользователю информацию, что данные успешно отправлены
// и кладем данные feedback в базу
// если есть такой логин, то с привязкой к пользователю
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // если изменены данные и отправлена форма
    // Проверяем введенные пользователем данные 
    $errors = []; // ошибки 
    $inputs = []; // данные
    
    // забираем данные из массива $_POST? экранируем и кладем в массив $input
    $inputs['first_name'] = htmlspecialchars( trim( $_POST['first_name'] ) );
    $inputs['last_name'] = htmlspecialchars( trim( $_POST['last_name'] ) );
    $inputs['email'] = htmlspecialchars(trim($_POST['email']));
    $inputs['comment'] = htmlspecialchars(trim($_POST['comment']));

    if(empty($inputs['first_name'])){
        $errors['first_name'] = 'Введите имя!';
    }
    if (empty($inputs['last_name'] )){
        $errors['last_name'] = 'Введите фамилию!';
    }
    $reg_exp = "/^[^@ ]+[@][^@ ]+\.[^@ ]+$/";
    if (empty($inputs['email'])) {
        $errors['email'] = 'Введите адрес электронной почты!';
    } elseif (!preg_match($reg_exp, $inputs['email'])) {
        $errors['email'] = 'Адрес электронной почты введен в неверном формате!';
    }
    if(empty($inputs['comment'])){
        $errors['comment'] = 'Введите комментарий!';
    }
    // d($inputs);
    // d($errors);
    // d($_POST);
    
    $haveErrors = false;
    foreach ($errors as $error => $error_text) {
        if ($error_text !== '') {
            $haveErrors = true;
        }
    }
    if ($haveErrors) { // если есть ошибки, выводит ошибки и эту же форму.
        show_feedback_form($inputs, $errors);
    }else{
        $query = "CREATE TABLE IF NOT EXISTS feedbacks( 
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            comment TEXT NOT NULL)
            ;";
        $pdo->exec($query);

        $insert_query = $pdo->prepare("INSERT INTO feedbacks() VALUES (?, ?, ?, ?, ?)");
        $insert_query->execute([null, $inputs['first_name'], $inputs['last_name'], $inputs['email'], $inputs['comment']]);
        echo '<h3>Сообщение успешно отправлено!</h3>';
        // header('Location: index.php');
    }
}else{
    if (isset($_SESSION['login']) && isset($_SESSION['password'])){
    show_feedback_form($_SESSION);
    }else{
        show_feedback_form();
    }
}
