<!-- https://reportkey.ru/ -->
<!-- может вывести в основные страницы и включить: 
templates
example
instruction -->
<?php
require 'pages_array.php';
$tytle = $pages_array['report_example.php'];
require 'components/header.php';
// require 'components/example.php'; // переместила в другую папку
// require 'components/templates.php';
// require 'components/instruction.php';
?>

        <section class="main-block main-block__content report_example ">
            <h2>!!!Раздел на стадии разработки!!!</h2>
            <div class="in_process">
                <h3>Здесь будут:</h3>
                <h3>Примеры отчетов</h3>
                <h3>Предлагаемые шаблоны</h3>
                <h3>Инструкция по составлению отчета</h3>
            </div>

        </section>

<?php
require 'components/footer.php';
?>