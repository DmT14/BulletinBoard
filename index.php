<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
    <link rel="shortcut icon" href="img/bulletin_board.ico" type="image/x-icon">
</head>
<body>
    <?php if(!isset($_COOKIE['login'])): ?>
    <div id="categories">
        <div id="title"><b>Категории</b></div>
        <br>
        <a href="html-php/auto_moto.php"><div class="categories"><p>Авто/мото</p></div></a>
        <a href="html-php/job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="html-php/animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="html-php/property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="html-php/clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <a href="html-php/service.php"><div class="categories"><p>Услуги</p></div></a>
        <a href="html-php/other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="content">
        <h1>Добро пожаловать на &laquo;Доску объявлений&raquo;!</h1>
        <p>Здесь Вы можете найти объявления по различным категориям.</p>
        <p>Для выбора категории и перехода к объявлениям нажмите на любую категорию в меню слева.</p>
        <p>Для размещения собственного объявления нажмите на кнопку &laquo;Разместить объявление&raquo; в правой части страницы. Разместить объявление можно только после авторизации.</p>
        <p>Вы также можете посмотреть размещённые Вами объявления и объявления, находящиеся в архиве. Ссылки находятся в правой части страницы.</p>
        <p>Не забудьте ознакомиться с <a href="html-php/rools.php">правилами</a> Сервиса, прежде чем работать с ним. Работая с Сервисом, Вы подтверждаете, что ознакомлены с правилами.</p>
        <p>Для просмотра или изменения личных данных перейдите по ссылке &laquo;Личный кабинет&raquo; в правой части страницы.</p>
        <p>Желаем Вам приятной и комфортной работы с Сервисом!</p>
    </div>

    <div id="right">
        <form action="php/auth.php" method="post">
            <b>Авторизация на сайте</b>
            <br>
            <div class="field">
                <label for="inp_login">Логин:</label>
                <input id="inp_login" type="text" name="login">
            </div>
            <br>
            <div class="field">
                <label for="inp_pass">Пароль:</label>
                <input id="inp_pass" type="password" name="password">
            </div>
            <br>
            <button type="submit">Войти</button>
            <br>
            <a href="html-php/sign_up.php">Зарегистрироваться</a>
            <br>
        </form>
        <p>
            <a href="html-php/rools.php">Правила использования сервиса</a>
            <br>
            <b>Главная страница</b>
            <br>
        </p>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>

    <?php else: ?>
    <div id="categories">
        <div id="title"><b>Категории</b></div>
        <br>
        <a href="html-php/auto_moto.php"><div class="categories"><p>Авто/мото</p></div></a>
        <a href="html-php/job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="html-php/animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="html-php/property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="html-php/clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <a href="html-php/service.php"><div class="categories"><p>Услуги</p></div></a>
        <a href="html-php/other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="content">
        <h1>Добро пожаловать на &laquo;Доску объявлений&raquo;!</h1>
        <p>Здесь Вы можете найти объявления по различным категориям.</p>
        <p>Для выбора категории и перехода к объявлениям нажмите на любую категорию в меню слева.</p>
        <p>Для размещения собственного объявления нажмите на кнопку &laquo;Разместить объявление&raquo; в правой части страницы. Разместить объявление можно только после авторизации.</p>
        <p>Вы также можете посмотреть размещённые Вами объявления и объявления, находящиеся в архиве. Ссылки находятся в правой части страницы.</p>
        <p>Не забудьте ознакомиться с <a href="html-php/rools.php">правилами</a> Сервиса, прежде чем работать с ним. Работая с Сервисом, Вы подтверждаете, что ознакомлены с правилами.</p>
        <p>Для просмотра или изменения личных данных перейдите по ссылке &laquo;Личный кабинет&raquo; в правой части страницы.</p>
        <p>Желаем Вам приятной и комфортной работы с Сервисом!</p>
    </div>

    <div id="right">
        <p>
            Вы авторизованы как <b><?=$_COOKIE['login']?></b>
            <br>
            <br>
            <a href="html-php/cabinet.php">Личный кабинет</a>
            <br>
            <a href="html-php/my_ads.php">Мои объявления</a>
            <br>
            <a href="html-php/archive.php">Архив объявлений</a>
            <br>
            <a href="html-php/rools.php">Правила использования сервиса</a>
            <br>
            <b>Главная страница</b>
            <br>
            <a href="php/exit.php">Выход</a>
        </p>
        <a href="html-php/create_ad.php"><button id="add_advert">Разместить объявление</button></a><br>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>    
    
    <?php endif;?>
</body>
</html>