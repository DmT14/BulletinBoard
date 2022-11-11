<!DOCTYPE html>
<html>
<head>
    <title>Размещение объявления</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/create_ad.css">
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
        <h1>Размещение объявления</h1>
        <form id="adv" enctype="multipart/form-data" action="../php/create_ad_script.php" method="post">    
            <table>
                <tr>
                    <td class="head_cell">Категория</td>
                    <td>
                        <p>
                            <select name="categories">
                                <option>Авто/мото</option>
                                <option>Вакансии</option>
                                <option>Животные и растения</option>
                                <option>Недвижимость</option>
                                <option>Одежда</option>
                                <option>Услуги</option>
                                <option>Другое</option>
                            </select>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="head_cell">Описание</td>
                    <td><textarea name="description"></textarea></td>
                </tr>
                <tr>
                    <td class="head_cell">Анонимность</td>
                    <td id="radio_button">
                        <fieldset>
                            <input type="radio" id="anon" name="anonymity" value="1" checked><label for="anon">Анонимно (Ваше имя (логин) будет скрыто)</label>
                            <br>
                            <br>
                            <input type="radio" id="not_anon" name="anonymity" value="2"><label for="not_anon">Не анонимно (Ваше имя (логин) будет видно всем)</label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <td class="head_cell">Для кого</td>
                    <td><input placeholder="(не обязательно для заполнения)" type="text" name="for_who"></td>
                </tr>
                <tr>
                    <td class="head_cell">Файл</td>
                    <td><input type="file" accept="image/*" name="file"></td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Разместить объявление</button></td>
                </tr>
            </table>
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
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>
    
    <?php endif;?>
</body>
</html>