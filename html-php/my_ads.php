<!DOCTYPE html>
<html>
<head>
    <title>Мои объявления</title>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/my_ads.css">
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
        <h1>Мои объявления</h1>
        <p>Здесь хранятся размещённые Вами объявления.</p>
        <?php
            $mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
            if(mysqli_connect_errno())
            {
                printf("Connect failed: %s\n", mysql_connect_errno());
                exit();
            }

            $user_id = filter_var(trim($_COOKIE['user_id']), FILTER_SANITIZE_STRING);
            $result = $mysql->query("SELECT * FROM `advertisment` WHERE `user_id` = '$user_id' AND `advertisment_type` = 1 AND DATEDIFF(CURRENT_DATE(), `date`)  < 21");
            
            while($row = $result->fetch_array())
            {
                if($row['file'] == '')
                {
                    if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        $category_id = $row['advertisment_category'];
                        $category = $mysql->query("SELECT `category_name` FROM `categories` WHERE `category_id` = '$category_id'");
                        $category_name = $category->fetch_array();
                        echo 
                        '
                            <form id="user_ad" action="../php/delete_ad_script.php" method="post">  
                                <div class="advert">
                                    <span class="id"> № <input type="hidden" name="advertisment_id" value="'. $row['advertisment_id'] .'">' . $row['advertisment_id'] . '</span>
                                    <span class="category">' . $category_name['category_name'] . '</span>
                                    <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                    <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                    <br>
                                    <p>' . $row['text_content'] . '</p>
                                    <button type="submit" name="action" value="Удалить">Удалить</button>
                                </div>
                            </form>
                        ';
                    }
                    else
                    {
                        $category_id = $row['advertisment_category'];
                        $category = $mysql->query("SELECT `category_name` FROM `categories` WHERE `category_id` = '$category_id'");
                        $category_name = $category->fetch_array();
                        echo 
                        '
                            <form id="user_ad" action="../php/delete_ad_script.php" method="post">  
                                <div class="advert">
                                    <span class="id"> № <input type="hidden" name="advertisment_id" value="'. $row['advertisment_id'] .'">' . $row['advertisment_id'] . '</span>
                                    <span class="category">' . $category_name['category_name'] . '</span>
                                    <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                    <br>
                                    <p>' . $row['text_content'] . '</p>
                                    <button type="submit" name="action" value="Удалить">Удалить</button>
                                </div>
                            </form>
                        ';
                    }
                }
                else
                {
                    if($row['anonymity'] == 2)
                    {
                        $user_id = $row['user_id'];
                        $login = $mysql->query("SELECT `login` FROM `user` WHERE `user_id` = '$user_id'");
                        $category_id = $row['advertisment_category'];
                        $category = $mysql->query("SELECT `category_name` FROM `categories` WHERE `category_id` = '$category_id'");
                        $category_name = $category->fetch_array();
                        echo 
                        '
                            <form id="user_ad" action="../php/delete_ad_script.php" method="post">  
                                <div class="advert">
                                    <span class="id"> № <input type="hidden" name="advertisment_id" value="'. $row['advertisment_id'] .'">' . $row['advertisment_id'] . '</span>
                                    <span class="category">' . $category_name['category_name'] . '</span>
                                    <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                    <span class="user">' . $login->fetch_assoc()['login'] . '</span>
                                    <br>
                                    <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                    <p>' . $row['text_content'] . '</p>
                                    <button type="submit" name="action" value="Удалить">Удалить</button>
                                </div>
                            </form>
                        ';
                    }
                    else
                    {
                        $category_id = $row['advertisment_category'];
                        $category = $mysql->query("SELECT `category_name` FROM `categories` WHERE `category_id` = '$category_id'");
                        $category_name = $category->fetch_array();
                        echo 
                        '
                            <form id="user_ad" action="../php/delete_ad_script.php" method="post">  
                                <div class="advert">
                                    <span class="id"> № <input type="hidden" name="advertisment_id" value="'. $row['advertisment_id'] .'">' . $row['advertisment_id'] . '</span>
                                    <span class="category">' . $category_name['category_name'] . '</span>
                                    <span class="date">' . date("d.m.Y H:i", strtotime($row['date'])) . '</span>
                                    <br>
                                    <a href="' . $row['file'] . '" target="blank"><img style="width: 17%;" src="' . $row['file'] . '"></a>
                                    <p>' . $row['text_content'] . '</p>
                                    <button type="submit" name="action" value="Удалить">Удалить</button>
                                </div>
                            </form>
                        ';
                    }
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
            Мои объявления
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