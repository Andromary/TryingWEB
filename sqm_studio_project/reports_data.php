<!-- https://www.stimulsoft.com/ru/products/reports-web -->
<!-- может вывести в основные страницы и включить:
audits
contracts
suppliers_report
suppliers_types
 -->
<?php
// session_start(); // запускаем сессию

require 'pages_array.php';
$tytle = $pages_array['reports_data.php'];
require 'components/header.php';
require 'components/db_connect.php';

// require 'components/suppliers_types.php';
// require 'components/contracts_requirements.php';
// require 'components/suppliers_report.php';
// require 'components/audits_results.php';
?>

        <section class="main-block main-block__content reports_data">
            <h3>Для проведения комплексной оценки деятельности поставщиков рекомендуется использовать следующие данные:</h3>
            <ul>
                <li><b>Типы поставщиков</b>, принятые в организации. <span><b>Источник: Классификатор поставщиков</b>, утвержденный в организации.</span></li><!-- в будущем можно добавлять ссылки на свои статьи, приведенные в разделе study (смотря что можно использовать!) -->
                <li><b>Требования контрактов </b>с поставщиками. <span><b>Источник: Требования по качеству(ТК), </b>приведенные в контрактах с поставщиками.</span></li>
                <li><b>Результаты аудитов </b>поставщиков. <span><b>Источник: Отчеты по аудитам поставщиков </b>и план корректирующих мероприятий с их статусом.</span></li>
                <li><b>Отчеты по качеству, </b> полученные от поставщиков. <span><b>Источник: Отчеты по качеству, </b>предусмотренные требованиями контракта (ТК).</span></li>
                <li><b>Данные по качеству поставок </b> - несоответствия, выявленные на входном контроле, в производстве и эксплуатации.<span><b>Источник: Записи о несоответствиях, рекламации </b>- обычно - данные, полученные из автоматизированной(ых) системы(-) организации или Базы данных.</span></li>
            </ul>
            <p class="notice">Полный набор источников данных для анализа и их наполнение зависит от требований нормативных документов Вашей организации.</p>

            <h3>В РАЗРАБОТКЕ!!! Форма для прикрепления файлов с данными для анализа В РАЗРАБОТКЕ!!!</h3>
            <form action="">
                <label for=""></label>
                <input type="text">
            </form>
        </section>

<?php
require 'components/footer.php';
?>