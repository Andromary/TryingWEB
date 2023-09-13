<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?php echo 'SQM Studio /' . $tytle; ?> </title>
    <script defer src="./script.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&family=Barlow:wght@600&family=Fraunces:opsz,wght@9..144,700&family=Inter:wght@400;700&family=Lexend+Deca&family=PT+Sans+Caption&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&family=Barlow:wght@600&family=Fraunces:opsz,wght@9..144,700&family=Inter:wght@400;700&family=Krona+One&family=Lexend+Deca&family=PT+Sans+Caption&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <header>
            <nav>
                <a href="index.php">
                    <p class="logo">SQMstudio</p>
                </a>
                <div>
                    <ul class="nav-link">
                        <?php
                        session_start();
                        if (!isset($_SESSION['login'])){
                            foreach ($pages_array as $key => $value) {
                                if($value === 'Личный кабинет'){
                                    continue;
                                }else{
                                echo "<li><a class='$key' href='$key'>$value</a></li>";
                                }
                            }
                        }else{
                            foreach ($pages_array as $key => $value) {
                                if($value === 'Регистрация' || $value === 'Войти'){
                                    continue;
                                }else{
                                echo "<li><a class='$key' href='$key'>$value</a></li>";
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>