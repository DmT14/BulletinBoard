<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Регистрация</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css">
	<link rel="stylesheet" type="text/css" href="../styles/sign_up.css">
    <link rel="shortcut icon" href="../img/bulletin_board.ico" type="image/x-icon">
</head>
<body>
    <?php
        if(isset($_COOKIE['login'])):
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
        <h1>Регистрация</h1>
        <form action="../php/sign_up_script.php" method="post">
			<b>Чтобы зарегистрироваться, заполните поля</b>
			<br>
			<div class="field">
		        <label for="reg_login">Логин</label>
		        <input id="reg_login" type="text" name="login">
		    </div>
		    <br>
		    <div class="field">
		        <label for="reg_pass">Пароль</label>
		        <input id="reg_pass" type="password" name="password">
		    </div> 
			<br>
			<div class="field">
		        <label for="reg_surname">Фамилия</label>
		        <input id="reg_surname" type="text" name="surname">
		    </div>
		    <br>
		    <div class="field">
		        <label for="reg_name">Имя</label>
		        <input id="reg_name" type="text" name="name">
		    </div> 
			<br>
			<div class="field">
		        <label for="reg_last_name">Отчество</label>
		        <input id="reg_last_name" type="text" name="last_name">
		    </div>
		    <br>
		    <div class="field">
		        <label for="reg_email">E-mail</label>
		        <input id="reg_email" type="text" name="email">
		    </div> 
			<br>
			<div class="field">
		        <label for="reg_phone_number">Телефон</label>
		        <input id="reg_phone_number" placeholder="+7 (___) ___-____" type="text" name="phone_number">
		    </div>
		    <br>
			<button id="signup" type="submit">Зарегистрироваться</button>
		</form>
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
            Зарегистрироваться
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
    
    <?php endif;?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="../js/src/jquery.maskedinput.js"></script>
	<script>
	    $(document).ready(function() 
	    {
	    	$("#reg_phone_number").mask("+7 (999) 999-9999");
	    });
	</script>
</body>
</html>