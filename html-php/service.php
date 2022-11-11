<!DOCTYPE html>
<html>
<head>
    <title>Услуги</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/categories.css">
    <link rel="shortcut icon" href="../img/bulletin_board.ico" type="image/x-icon">
</head>
<body>
    <?php if(!isset($_COOKIE['login'])): ?>
    <div id="categories">
        <div id="title"><b>Категории</b></div><br>
        <a href="auto_moto.php"><div class="categories"><p>Авто/мото</p></div></a>
        <a href="job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <div id="chosen" class="categories"><p>Услуги</p></div>
        <a href="other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="content">
        <h1>Услуги</h1>
        <form id="for_who" action="../php/get_address_ads.php" method="post">
            <input type="hidden" name="category" value="6">
            <input type="text" placeholder="(имя для адресных объявлений)" name="for_who">
            <button type="submit">Показать</button>
        </form>

        <?php
            $mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
            if(mysqli_connect_errno())
            {
                printf("Connect failed: %s\n", mysql_connect_errno());
                exit();
            }

            $result = $mysql->query("SELECT * FROM `advertisment` WHERE `advertisment_category` = 6 AND `advertisment_type` = 1 AND DATEDIFF(CURRENT_DATE(), `date`)  < 21 AND  (`for_who` = '' OR `for_who` IS NULL)");
            
            while($row = $result->fetch_array())
            {
                if($row['file'] == '')
                {
                   if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                <br>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                    } 
                    else
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <br>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                }
                else
                {
                    if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                <br>
                                <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                    }
                    else
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <br>
                                <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                }
            }
        ?>
    </div>

    <div id="right">
        <form action="../php/auth.php" method="post">
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
            <a href="sign_up.php">Зарегистрироваться</a>
            <br>
        </form>
        <p>
            <a href="rools.php">Правила использования сервиса</a>
            <br>
            <a href="../index.php"><b>Главная страница</b></a>
            <br>
        </p>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>

    <?php else: ?>
    <div id="categories">
        <div id="title"><b>Категории</b></div><br>
        <a href="auto_moto.php"><div class="categories"><p>Авто/мото</p></div></a>
        <a href="job.php"><div class="categories"><p>Вакансии</p></div></a>
        <a href="animals_plants.php"><div class="categories"><p>Животные и растения</p></div></a>
        <a href="property.php"><div class="categories"><p>Недвижимость</p></div></a>
        <a href="clothes.php"><div class="categories"><p>Одежда</p></div></a>
        <div id="chosen" class="categories"><p>Услуги</p></div>
        <a href="other.php"><div class="categories"><p>Другое</p></div></a>
    </div>

    <div id="content">
        <h1>Услуги</h1>
        <form id="for_who" action="../php/get_address_ads.php" method="post">
            <input type="hidden" name="category" value="6">
            <input type="text" placeholder="(имя для адресных объявлений)" name="for_who">
            <button type="submit">Показать</button>
        </form>
    
        <?php
            $mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
            if(mysqli_connect_errno())
            {
                printf("Connect failed: %s\n", mysql_connect_errno());
                exit();
            }

            $result = $mysql->query("SELECT * FROM `advertisment` WHERE `advertisment_category` = 6 AND `advertisment_type` = 1 AND DATEDIFF(CURRENT_DATE(), `date`)  < 21 AND  (`for_who` = '' OR `for_who` IS NULL)");
            
            while($row = $result->fetch_array())
            {
                if($row['file'] == '')
                {
                   if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                <br>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                    } 
                    else
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <br>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                }
                else
                {
                    if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                <br>
                                <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                    }
                    else
                        echo 
                        '
                            <div class="advert">
                                <span class="id"> № ' . $row['advertisment_id'] . '</span>
                                <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                <br>
                                <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                <p>'
                                    . $row['text_content'] .
                                '</p>
                            </div>
                        ';
                }
            }
        ?>
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
        <a href="create_ad.php"><button id="add_advert">Разместить объявление</button></a><br>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>
    
    <?php endif;?>
</body>
</html>