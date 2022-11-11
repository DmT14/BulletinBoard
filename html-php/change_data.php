<!DOCTYPE html>
<html>
<head>
    <title>Изменение данных</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/sign_up.css">
    <link rel="shortcut icon" href="../img/bulletin_board.ico" type="image/x-icon">
</head>
<body>
    <?php
        if($_COOKIE['login'] == ''):
            header('Location: /');
        else: 
    ?>

    <div id="categories">
        <div id="title"><b>Категории</b></div><br>
        <a href="auto_moto.php"><div class="categories"><p>Авто/мото</p></div></a>
        <a href="job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <a href="service.php"><div class="categories"><p>Услуги</p></div></a>
        <a href="other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="registration_form">
        <h1>Изменение данных</h1>
        <form action="../php/change_data_script.php" method="post">
            <div class="field">
                <label for="login">Логин</label>
                <input id="login" type="text" name="login" value="<?php echo $_COOKIE['login']; ?>">
            </div>
            <br>
            <div class="field">
                <label for="pass">Старый пароль</label>
                <input id="old_pass" type="password" name="old_pass">
            </div> 
            <br>
            <div class="field">
                <label for="pass">Новый пароль</label>
                <input id="new_pass" type="password" name="new_pass">
            </div> 
            <br>
            <div class="field">
                <label for="pass">Повторить пароль</label>
                <input id="new_pass_repeat" type="password" name="new_pass_repeat">
            </div> 
            <br>
            <div class="field">
                <label for="surname">Фамилия</label>
                <input id="surname" type="text" name="surname" value="<?php echo $_COOKIE['surname']; ?>">
            </div>
            <br>
            <div class="field">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" value="<?php echo $_COOKIE['name']; ?>">
            </div> 
            <br>
            <div class="field">
                <label for="last_name">Отчество</label>
                <input id="last_name" type="text" name="last_name" value="<?php echo $_COOKIE['last_name']; ?>">
            </div>
            <br>
            <div class="field">
                <label for="email">E-mail</label>
                <input id="email" type="text" name="email" value="<?php echo $_COOKIE['email']; ?>">
            </div> 
            <br>
            <div class="field">
                <label for="phone_number">Телефон</label>
                <input id="phone_number" placeholder="+7 (___) ___-____" type="text" name="phone_number" value="<?php echo $_COOKIE['phone_number']; ?>">
            </div>
            <br>
            <button id="change_data_button" type="submit">Изменить данные</button>
        </form>
    </div>

    <div id="right">
        <p>
            Вы авторизованы как <b><?=$_COOKIE['login']?></b>
            <br>
            <br>
            <a href="cabinet.php">Личный кабинет</a>
            <br>
            <a href="my_ads.php">Мои объявления</a>
            <br>
            <a href="archive.php">Архив объявлений</a>
            <br>
            <a href="rools.php">Правила использования сервиса</a>
            <br>
            <a href="../index.php"><b>Главная страница</b></a>
            <br>
            <a href="../php/exit.php">Выход</a>
        </p>
        <a href="ad.php"><button id="add_advert">Разместить объявление</button></a><br>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>
    
    <?php endif;?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/src/jquery.maskedinput.js"></script>
    <script>
        $(document).ready(function() 
        {
            $("#phone_number").mask("+7 (999) 999-9999");
        });
    </script>
</body>
</html>