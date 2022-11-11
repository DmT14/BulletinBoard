<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/cabinet.css">
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

    <div id="content">
        <h1>Личный кабинет</h1>
        <table>
            <tr>
                <td class="head_cell">Идентификатор</td>
                <td><?=$_COOKIE['user_id']?></td>
            </tr>
            <tr>
                <td class="head_cell">Логин</td>
                <td><?=$_COOKIE['login']?></td>
            </tr>
            <tr>
                <td class="head_cell">Фамилия</td>
                <td><?=$_COOKIE['surname']?></td>
            </tr>
            <tr>
                <td class="head_cell">Имя</td>
                <td><?=$_COOKIE['name']?></td>
            </tr>
            <tr>
                <td class="head_cell">Отчество</td>
                <td><?=$_COOKIE['last_name']?></td>
            </tr>
            <tr>
                <td class="head_cell">E-mail</td>
                <td><?=$_COOKIE['email']?></td>
            </tr>
            <tr>
                <td class="head_cell">№ телефона</td>
                <td><?=$_COOKIE['phone_number']?></td>
            </tr>
            <tr>
                <td id="change_data_cell" rowspan="2"><a href="change_data.php"><button>Изменить данные</button></a></td>
            </tr>
        </table>
    </div>

    <div id="right">
        <p>
            Вы авторизованы как <b><?=$_COOKIE['login']?></b>
            <br>
            <br>
            Личный кабинет
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
        <a href="create_ad.php"><button id="add_advert">Разместить объявление</button></a><br>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>
    
    <?php endif;?>
</body>
</html>