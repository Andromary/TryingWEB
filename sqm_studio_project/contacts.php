<?php
    require 'pages_array.php';
    $tytle = $pages_array['contacts.php'];
    require 'components/header.php';
    
?>

<!-- сновной контент страницы -->
<div class="main-block__content contacts">
    <h2>Контактная информация</h2>
    <p><b>Наш адрес: </b> г.Москва.</p>
    <p><b>Телефон для связи: </b> 0(000)000-00-00</p>

</div>



<?php
    require 'components/feedback.php'; 
    require 'components/footer.php'; 
?>


