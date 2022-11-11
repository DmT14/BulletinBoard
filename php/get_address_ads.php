<?php
	if(!isset($_POST['for_who']))
	{
		header('Location: /');
		exit();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<?php if($_POST['category'] == 1): ?>
		<title>Авто/мото</title>
	<?php elseif($_POST['category'] == 2): ?>
		<title>Вакансии</title>
	<?php elseif($_POST['category'] == 3): ?>
		<title>Животные и растения</title>
	<?php elseif($_POST['category'] == 4): ?>
		<title>Недвижимость</title>
	<?php elseif($_POST['category'] == 5): ?>
		<title>Одежда</title>
	<?php elseif($_POST['category'] == 6): ?>
		<title>Услуги</title>
	<?php elseif($_POST['category'] == 7): ?>
		<title>Другое</title>
	<?php endif;?>
    <link rel="stylesheet" type="text/css" href="../styles/style.css">
    <link rel="stylesheet" type="text/css" href="../styles/categories.css">
    <link rel="shortcut icon" href="../img/bulletin_board.ico" type="image/x-icon">
</head>
<body>
    <?php if($_COOKIE['login'] == ''): ?>
	    <?php if($_POST['category'] == 1): ?>
	    	<?php include ("../html-php/auto_moto_part.php");?>
	    <?php elseif($_POST['category'] == 2): ?>
			<?php include ("../html-php/job_part.php");?>
	    <?php elseif($_POST['category'] == 3): ?>
			<?php include ("../html-php/animals_plants_part.php");?>
	    <?php elseif($_POST['category'] == 4): ?>
			<?php include ("../html-php/property_part.php");?>
	    <?php elseif($_POST['category'] == 5): ?>
			<?php include ("../html-php/clothes_part.php");?>
	    <?php elseif($_POST['category'] == 6): ?>
			<?php include ("../html-php/service_part.php");?>
	    <?php elseif($_POST['category'] == 7): ?>
	    	<?php include ("../html-php/other_part.php");?>
	    <?php endif;?>

		<?php if($_POST['for_who'] != ''):?>
	    	<p>Объявления для: <b><?=$_POST['for_who']?></b></p>
	    <?php endif;?>

		<?php
			$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
		    if(mysqli_connect_errno())
		    {
		        printf("Connect failed: %s\n", mysql_connect_errno());
		        exit();
		    }

		    $for_who = $_POST['for_who'];
		    $category = $_POST['category'];

		    $result = $mysql->query("SELECT * FROM `advertisment` WHERE `advertisment_category` = '$category' AND `advertisment_type` = 1 AND DATEDIFF(CURRENT_DATE(), `date`)  < 21 AND `for_who` = '$for_who'");

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
		                $user_id = $row[user_id];
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

		    $mysql->close();
		?>
	</div>

    <div id="right">
        <form action="auth.php" method="post">
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
            <a href="../html-php/sign_up.php">Зарегистрироваться</a>
            <br>
        </form>
        <p>
            <a href="../html-php/rools.php">Правила использования сервиса</a>
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
    	<?php if($_POST['category'] == 1): ?>
	    	<?php include ("../html-php/auto_moto_part.php");?>
	    <?php elseif($_POST['category'] == 2): ?>
			<?php include ("../html-php/job_part.php");?>
	    <?php elseif($_POST['category'] == 3): ?>
			<?php include ("../html-php/animals_plants_part.php");?>
	    <?php elseif($_POST['category'] == 4): ?>
			<?php include ("../html-php/property_part.php");?>
	    <?php elseif($_POST['category'] == 5): ?>
			<?php include ("../html-php/clothes_part.php");?>
	    <?php elseif($_POST['category'] == 6): ?>
			<?php include ("../html-php/service_part.php");?>
	    <?php elseif($_POST['category'] == 7): ?>
	    	<?php include ("../html-php/other_part.php");?>
	    <?php endif;?>

	    <?php if($_POST['for_who'] != ''):?>
	    	<p>Объявления для: <b><?=$_POST['for_who']?></b></p>
	    <?php endif;?>

        <?php
			$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
		    if(mysqli_connect_errno())
		    {
		        printf("Connect failed: %s\n", mysql_connect_errno());
		        exit();
		    }

		    $for_who = $_POST['for_who'];
		    $category = $_POST['category'];

		    $result = $mysql->query("SELECT * FROM `advertisment` WHERE `advertisment_category` = '$category' AND `advertisment_type` = 1 AND DATEDIFF(CURRENT_DATE(), `date`)  < 21 AND `for_who` = '$for_who'");

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

		    $mysql->close();
		?>
	</div>

    <div id="right">
        <p>
            Вы авторизованы как <b><?=$_COOKIE['login']?></b>
            <br>
            <br>
            <a href="../html-php/cabinet.php">Личный кабинет</a>
            <br>
            <a href="../html-php/my_ads.php">Мои объявления</a>
            <br>
            <a href="../html-php/archive.php">Архив объявлений</a>
            <br>
            <a href="../html-php/rools.php">Правила использования сервиса</a>
            <br>
            <a href="../index.php"><b>Главная страница</b></a>
            <br>
            <a href="exit.php">Выход</a>
        </p>
        <a href="../html-php/create_ad.php"><button id="add_advert">Разместить объявление</button></a><br>
    </div>

    <div id="footer">
        <p>Веб-приложение разработано в рамках курсовой работы по дисциплине &laquo;Разработка клиент-серверных приложений&raquo;.</p>
        <p>Автор: студент группы ИКБО-17-18 ИИТ РТУ МИРЭА Терентьев Дмитрий Константинович.</p>
    </div>
    
    <?php endif;?>
</body>
</html>