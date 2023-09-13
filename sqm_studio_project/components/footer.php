
    <footer>

        <a class="footer-logo" href="index.php">
            <p >SQMstudio</p>
        </a>

        <div>
            <ul class="footer-link">
                <?php
                foreach ($pages_array as $key => $value) {
                    if($value === 'Регистрация' || $value === 'Войти' || $value === 'Личный кабинет'){
                        continue;
                    }else{
                    echo "<li class='$key'><a href='$key'>$value</a></li>";
                    }
                }
                ?>
            </ul>
        </div>

        <!-- <div class="nets">

        <a href="https://www.facebook.com/">
            <img src="images/icon-facebook.svg" alt="Facebook logo">
        </a>

        <a href="https://instagram.com/">
            <img src="images/icon-instagram.svg" alt="Instagram logo">
        </a>

        <a href="https://twitter.com/">
            <img src="images/icon-twitter.svg" alt="Twitter logo"></a>
        </a>

        <a href="https://www.pinterest.ru/">
            <img src="images/icon-pinterest.svg" alt="Pinterest logo">
        </a>

        </div> -->

    </footer>
  </div>


  <div class="attribution">
    Challenge by <a href="https://www.frontendmentor.io?ref=challenge" target="_blank">Frontend Mentor</a>. 
    Coded by <a href="#">Andreeva Maria V.</a>.
  </div>

</body>
</html>