<?php
require 'db_connect.php';

// *******************************************
// Функции для формы регистрации!!!!!!!!!!
// *******************************************

/**
 * 
 * функция для проверки полей ввода
 * 
 */
function validate_registration_form(){
    // d($_POST);
    $errors = []; // ошибки 
    $inputs = []; // данные
    foreach ($inputs as $key => $value) {
        if (!$value) {
            $inputs[$key] = '';
        }
    }
    // забираем данные из массива $_POST? экранируем и кладем в массив $input
    $inputs['first_name'] = htmlspecialchars( trim( $_POST['first_name'] ) );
    $inputs['patronymic'] = htmlspecialchars( trim( $_POST['patronymic'] ) );
    $inputs['last_name'] = htmlspecialchars( trim( $_POST['last_name'] ) );
    $inputs['login'] = htmlspecialchars(trim($_POST['login']));
    $inputs['email'] = htmlspecialchars(trim($_POST['email']));
    $inputs['company'] = htmlspecialchars(trim($_POST['company']));
    $inputs['project'] = htmlspecialchars(trim($_POST['project']));
    $inputs['role'] = $_POST['role']; // не нужно регулировать этот пунт, выбирается из двух: buyer/supplier
    $inputs['password'] = htmlspecialchars( trim( $_POST['password'] ) );
    $inputs['password_check'] = htmlspecialchars(trim($_POST['password_check']));

    // foreach ($inputs as $input => $value){ // function validate_inputs($value)
    //     function ($value){
    //         $reg_exp = [
    //         'first_name' => "/^[-а-яёa-z]+$/ui",
    //         'last_name' => "/^[-а-яёa-z]+$/ui",
    //         'login' => "/^[A-Z][a-z0-9._]+$/",
    //         'email' => "/^[^@ ]+[@][^@ ]+\.[^@ ]$/",
    //         'company' => "/^[-а-яёa-z&0-9]+$/ui", // без "'
    //         'project' => "/^.$/",
    //         'password' => "/^.{6,}$/",
    //         'password_check' => "/^.{6,}$/",
    //         ];
    //         if ($input !== 'project'){
    //             if(empty($value)){
    //                 return $error = 'Поле не может быть пустым';
    //             }elseif ( !preg_match( $reg_exp[$input], $value ) ){ // похоже не работают проверки
    //                 return $error = 'Введен неверный формат данных';
    //             }
    //         }

    //         if ($error){ // если выводит какое-то значение
    //             $errors[$input] = $error;
    //         }
    //     }
    // }

    /**
     * 
     * функция для проверки имени 
     * 
     */
    function validate_first_name($first_name){
        $reg_exp = "/^[-а-яёa-z]+$/ui";
        if (empty($first_name)) { 
            return 'Введите имя!';
        } elseif (!preg_match($reg_exp, $first_name)) {
            return 'Имя может содержать только русские и латинские буквы и '-'!';
        }
    }
    
    if (validate_first_name($inputs['first_name'])) {
        $errors['first_name'] = validate_first_name($inputs['first_name']);
    } else {
        $errors['first_name'] = '';
    }
    // конец блока проверки имени

    /**
     * 
     * функция для проверки отчества 
     * 
     */
    function validate_patronymic($patronymic){
        $reg_exp = "/^[-а-яёa-z]*$/ui";
        if (!preg_match($reg_exp, $patronymic)) {
            return 'Отчество может содержать только русские и латинские буквы и '-'!';
        }
    }

    if (validate_patronymic($inputs['patronymic'])) {
        $errors['patronymic'] = validate_patronymic($inputs['patronymic']);
    } else {
        $errors['patronymic'] = '';
    }
    // конец блока проверки имени

    /**
     * 
     * функция для проверки фамилии 
     * 
     */
    function validate_last_name($last_name){
        $reg_exp = "/^[-а-яёa-z]+$/ui";
        if (empty($last_name)) {
            return 'Введите фамилию!';
        } elseif (!preg_match($reg_exp, $last_name)) {
            return 'Фамилия может содержать только русские и латинские буквы и '-'!';
        }
    }
    
    if (validate_last_name($inputs['last_name'])){ 
        $errors['last_name'] = validate_last_name($inputs['last_name']);
    } else {
        $errors['last_name'] = '';
    }
    // конец блока проверки фамилии
   
    /**
     * 
     * функция для проверки логина 
     * 
     */
    function validate_login($login){
        $reg_exp = "/^[A-Z][a-zA-Z0-9._-]+$/";
        if (empty($login)) {
            return 'Введите логин';
        } elseif (strlen($login) < 2) {
            return 'Логин должен быть не короче двух символов!';
        } elseif (!preg_match($reg_exp, $login)) {
            return "Логин должен начинаться с заглавной буквы, содержать только латинские буквы, цифры, знаки: . - _";
        }
    }

    if (validate_login($inputs['login'])) {
        $errors['login'] = validate_login($inputs['login']);
    } else {
        $errors['login'] = '';
    }
    // конец блока проверки логина

     /**
     * 
     * функция для проверки наименования организации 
     * 
     */
    function validate_company($company){
        $reg_exp = "/^[-_.&\sа-яёa-z0-9]*$/ui";
        if (!preg_match($reg_exp, $company)) {
            return "Наименование компании может содержать только буквы, цифры, знаки: . - _ &";
        }
    }

    if (validate_company($inputs['company'])) {
        $errors['company'] = validate_company($inputs['company']);
    } else {
        $errors['company'] = '';
    }
    // конец блока проверки наименования организации 
 
    /**
     * 
     * функция для проверки email 
     * 
     */
    function validate_email($email){
        $reg_exp = "/^[^@ ]+[@][^@ ]+\.[^@ ]+$/";
        if (empty($email)) {
            return 'Введите адрес электронной почты!';
        } elseif (!preg_match($reg_exp, $email)) {
            return 'Адрес электронной почты введен в неверном формате!';
        }
    }
    
    if (validate_email($inputs['email'])) {
        $errors['email'] = validate_email($inputs['email']);
    } else {
        $errors['email'] = '';
    }
    // конец блока проверки e-mail

    // /**
    //  * Дебаг role, project
    //  */
    // if($inputs['role'] === null){
    //     $inputs['role'] = '';
    // }
    // if(empty($inputs['project'])){
    //     $inputs['project'] = '';
    // }

    /**
     * 
     * функции для проверки пароля
     * 
     */
    function validate_password($password){
        $reg_exp = "/^.{6,}$/"; 
        if (empty($password)) {
            return 'Введите пароль!';
        } elseif (!preg_match($reg_exp, $password)) {
            return 'Пароль не может быть короче шести символов!';
        }
        return $password;
    }
    
    if (validate_password($inputs['password'])) {
        if (validate_password($inputs['password']) !== $inputs['password']){
        $errors['password'] = validate_password($inputs['password']);
        } else {
            $errors['password'] = '';
        }
    } 

    function validate_password_check($password_check, $password){
        if (empty($password_check)) {
            return 'Подтвердите пароль!';
        } elseif ($password_check !== $password) {
            return 'Пароли не совпадают!';
        }
    }

    if (validate_password_check($inputs['password_check'], validate_password($inputs['password']))) {
        $errors['password_check'] = validate_password_check($inputs['password_check'], validate_password($inputs['password']));
    } else {
        $errors['password_check'] = '';
    }
    // конец блока проверки пароля
    return [$inputs, $errors]; // возвращаем массив с введеными данными и ошибками
}// конец блока функций проверки полей ввода   


    /**
     * 
     * функция для отображения данных об успешной регистрации
     * 
     */
function succeeded_registration_form($inputs){
    echo <<<_HTML_
        <section class="main-block main-block__content succeeded_registration">
            <h2>Приветствуем Вас, $inputs[first_name] $inputs[patronymic], <br> Вы успешно зарегистрированы!</h2>
            <h3>Ваши данные:</h3>
            <table class="registration-data">
                <tr>
                    <th>Имя: </th>
                    <td>$inputs[first_name]</td>
                </tr>
                <tr>
                    <th>Отчество: </th>
                    <td>$inputs[patronymic]</td>
                </tr>
                <tr>
                    <th>Фамилия: </th>
                    <td>$inputs[last_name]</td>
                </tr>
                <tr>
                    <th>Организация: </th>
                    <td>$inputs[company]</td>
                </tr>
                <tr>
                    <th>Проект: </th>
                    <td>$inputs[project]</td>
                </tr>
                <tr>
                    <th>Логин: </th>
                    <td>$inputs[login]</td>
                </tr>
                <tr>
                    <th>E-mail: </th>
                    <td>$inputs[email]</td>
                </tr>
                <tr>
                    <th>Пароль: </th>
                    <td type="password">$inputs[password]</td>
                </tr>
            </table>
            <div class="references">
                <h3>Для изменения информации перейдите в <a class="to-page" href="personal_account.php">Личный кабинет</a>.</h3>
                <h3><a class="to-page" href="index.php">На главную</a></h3>
                <h3><a class="to-page" href="exit.php">Выйти</a></h3>
            </div>
        </section>
_HTML_;
}

/**
 * 
 * функция для отображения формы регистрации
 * 
 */
function show_form($inputs = [], $errors = [], $submit_value = "Зарегистрироваться", $form_tytle = "Регистрация пользователей"){ // ввод данных, ошибки, значение кнопки в форме, наименование заголовка
    if ($errors === [] or $errors === null) {
        $errors['first_name'] = '';
        $errors['patronymic'] = '';
        $errors['last_name'] = '';
        $errors['company'] = '';
        $errors['project'] = '';
        $errors['login'] = '';
        $errors['email'] = '';
        $errors['password'] = '';
        $errors['password_check'] = '';
        $errors['role'] = '';
    }
    if ($inputs === []) {
        $inputs['first_name'] = '';
        $inputs['patronymic'] = '';
        $inputs['last_name'] = '';
        $inputs['company'] = '';
        $inputs['project'] = '';
        $inputs['login'] = '';
        $inputs['email'] = '';
        $inputs['password'] = '';
        $inputs['password_check'] = '';
        $inputs['role'] = '';
    }
    
    echo <<<_HTML_
        <section class="main-block main-block__content registration_info">
            <h2>$form_tytle</h2>
            <form action="" method="POST">
                <div class="first_name"> <!-- имя -->
                    <label for="first_name">Имя:</label><br>
                    <input type="text" name="first_name" value="$inputs[first_name]" placeholder ="Только буквы и '-'"><br>
                    <span class="errors">$errors[first_name]</span>
                </div>


                <div class="patronymic"> <!-- имя -->
                    <label for="patronymic">Отчество:</label><br>
                    <input type="text" name="patronymic" value="$inputs[patronymic]" placeholder ="Только буквы и '-'"><br>
                    <span class="errors">$errors[patronymic]</span>
                </div>

                <div class="last_name"> <!-- фамилия -->
                    <label for="last_name">Фамилия:</label><br>
                    <input type="text" name="last_name" value="$inputs[last_name]" placeholder ="Только буквы и '-'"><br>
                    <span class="errors">$errors[last_name]</span>
                </div>

                <div class="radio--role">
                    <label for="role">Роль:</label><br>
                    <label for="role">Заказчик</label>
                    <input type="radio" name="role" value="buyer"><br>
                    <label for="role">Поставщик</label>
                    <input type="radio" name="role" value="supplier"><br>
                    <label for="role">Другое</label>
                    <input type="radio" name="role" value="other"><br>
                </div>

                <div class="company"> <!-- организация -->
                    <label for="company">Организация:</label><br>
                    <input type="text" name="company" value="$inputs[company]" placeholder ="Буквы, цифры, знаки: . - _ & ''"><br>
                    <span class="errors">$errors[company]</span>
                </div>

                <div class="project"> <!-- проект -->
                    <label for="project">Проект:</label><br>
                    <input type="text" name="project" value="$inputs[project]" placeholder ="Необязательное поле"><br>
                </div>

                <div class="login"> <!-- логин -->
                    <label for="login">Логин:</label><br>
                    <input type="text" name="login" value="$inputs[login]" placeholder ="Например: A_123bc"><br>
                    <span class="errors">$errors[login]</span>
                </div>

                <div class="email"> <!-- электронная почта -->
                    <label for="email">E-mail:</label><br>
                    <input type="text" name="email" value="$inputs[email]" placeholder ="В формате abc@def.gh"><br>
                    <span class="errors">$errors[email]</span>
                </div>

                <div class="password"> <!-- пароль два поля для него -->
                    <label for="password">Пароль:</label><br>
                    <input type="password" name="password" value="$inputs[password]" placeholder ="Не менее 6-ти символов"><br>
                    <span class="errors">$errors[password]</span>
                </div>

                <div class="password_check"> 
                    <label for="password_check">Подтвердите пароль:</label><br>
                    <input type="password" name="password_check" value="$inputs[password_check]" placeholder ="Повторите пароль"><br>
                    <span class="errors">$errors[password_check]</span>
                </div>

                <button type="submit" name="action">$submit_value</button>

            </form>
        </section>
_HTML_;
}

/**
 * 
 * функция для проверки ввода данных при входе
 * 
 */
// проверяем введенные данные
// сравниваем $inputs[enter] с логинами и e-mail в БД
// выводим запрос из БД:
// "Выбрать логин, email, пароль из базы данных
        // где логин = ? or email = ?
    // выполняем подготовлен.запр. и клад.в переменн. ассоц.массив
    // сравниваем введеное пользов-м с данными из бд
// если 
// function validate_enter(){
//     $errors = []; // ошибки 
//     $inputs = []; // данные
//     foreach ($inputs as $key => $value) {
//         if (!$value) {
//             $inputs[$key] = '';
//         }
//     }
//     // забираем данные из массива $_POST? экранируем и кладем в массив $inputs
//     $inputs['enter'] = htmlspecialchars( trim( $_POST['enter'] ) );
//     $inputs['password'] = htmlspecialchars( trim( $_POST['password'] ) );

//     $query = "SELECT login, email, password
//                 FROM users
//                 WHERE login=? or email=?;";

//     $select_query = $pdo->prepare($query);
//     $logname = $select_query->execute($inputs['enter'], $inputs['enter']);

//     if (($inputs['enter'] === $logname['login']) || ($inputs['enter'] === $logname['email'])){
//         if ($inputs['password'] !== $logname['password']){
//             $errors['password'] = 'Введён неверный пароль!';
//         }
//     }else{
//         $errors['enter'] = 'Пользователь с такими данными не зарегистрирован!';
//     }
//     return [$inputs, $errors]; // возвращаем массив с введеными данными и ошибками
// }// конец блока проверки входных данных

/**
 * 
 * функция для отображения формы входа
 * 
 */
function show_enter($inputs = [], $errors = []){
    if ($errors === [] or $errors === null) {
        $errors['enter'] = '';
        $errors['password'] = '';
    }
    if ($inputs === []) {
        $inputs['enter'] = '';
        $inputs['password'] = '';
    }
    echo <<<_HTML_
        <section class="main-block enter">
            <h1>Рады видеть вас снова! Пожалуйста, введите Ваш e-mail или логин, чтобы войти.</h1>
            <form action="" method="POST">
                <div class="login"> 
                    <label for="login">Имя пользователя (Логин или e-mail):</label><br>
                    <input type="text" name="enter" value="$inputs[enter]" placeholder ="Введите логин"><br>
                    <span class="errors"> $errors[enter]</span>
                </div>

                <div class="password"> 
                    <label for="password">Пароль:</label><br>
                    <input type="password" name="password" value="$inputs[password]" placeholder ="Введите пароль"><br>
                    <span class="errors">$errors[password]</span>
                </div>

                <button type="submit" name="action">Войти</button><br>
                <a class="to-page" href="registration.php">Зарегистрироваться</a>
            </form>

        </section>
_HTML_;

}
/**
 * 
 * функция для отображения формы обратной связи
 * 
 */
function show_feedback_form($inputs = [], $errors = []){
    if ($errors === [] or $errors === null) {
        $errors['first_name'] = '';
        $errors['last_name'] = '';
        $errors['email'] = '';
        $errors['comment'] = '';
        $errors['checkbox'] = '';

    }
    if ($inputs === []) {
        $inputs['first_name'] = '';
        $inputs['last_name'] = '';
        $inputs['email'] = '';
        $inputs['comment'] = '';
        $inputs['checkbox'] = '';

    }

    echo <<<_HTML_
        <aside class="main-block main-block__content feedback">
            <h2>Свяжитесь с нами</h2>
            <div class="feedback__form">
                <h2 class="feedback__form--title">Форма обратной связи</h2> 
                <p class="feedback__form--description">Поделитесь мнением о нашей работе или задайте нам любой интересующий вас вопрос в поле комментарий</p>
                
                <form action="" method="POST">

                    <div class="first_name"> <!-- имя -->
                        <label for="first_name">Имя:</label><br>
                        <input type="text" name="first_name" value="$inputs[first_name]" placeholder="Только буквы и '-'" size=40><br>
                        <span class="errors">$errors[first_name]</span>
                    </div> 
                    <div class="last_name"> <!-- фамилия -->
                        <label for="last_name">Фамилия:</label><br>
                        <input type="text" name="last_name" value="$inputs[last_name]" placeholder="Только буквы и '-'" size=40><br>
                        <span class="errors">$errors[last_name]</span>
                    </div>
                    <div class="email"> <!-- электронная почта -->
                        <label for="email">E-mail:</label><br>
                        <input type="text" name="email" value="$inputs[email]" placeholder="В формате abc@def.gh"size=40><br>
                        <span class="errors">$errors[email]</span>
                    </div>
                    <div class="comment">
                        <label for="comment">Комментарий:</label><br>
                        <input type="text" name="comment" value="$inputs[comment]" placeholder="Введите комментарий" size=40></textarea> 
                        <span class="errors">$errors[comment]</span>
                    </div> 
                    
                    <button type="submit" name="action">Отправить</button>
                    
                </form>
                
            </div>
        </aside>
_HTML_;
}





function d($arr)
{ // displayArray
    echo '<pre>';
    var_export($arr); // print_r($arr);
    echo '</pre>';
}