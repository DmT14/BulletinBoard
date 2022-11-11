<?php
	$id = filter_var(trim($_COOKIE['user_id']), FILTER_SANITIZE_STRING);
	$current_login = filter_var(trim($_COOKIE['login']), FILTER_SANITIZE_STRING);
	$current_email = filter_var(trim($_COOKIE['email']), FILTER_SANITIZE_STRING);
	$current_phone_number = filter_var(trim($_COOKIE['phone_number']), FILTER_SANITIZE_STRING);

	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$old_pass = filter_var(trim($_POST['old_pass']), FILTER_SANITIZE_STRING);
	$new_pass = filter_var(trim($_POST['new_pass']), FILTER_SANITIZE_STRING);
	$new_pass_repeat = filter_var(trim($_POST['new_pass_repeat']), FILTER_SANITIZE_STRING);
	$surname = filter_var(trim($_POST['surname']), FILTER_SANITIZE_STRING);
	$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
	$last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
	$phone_number = filter_var(trim($_POST['phone_number']), FILTER_SANITIZE_STRING);

	$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
	if(mysqli_connect_errno())
	{
		printf("Connect Database failed: %s\n", mysql_connect_errno());
		exit();
	}

	$current_pass = $mysql->query("SELECT `password` FROM `user` WHERE `user_id` = '$id'");
	$occupied_login = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login'");
	$occupied_email = $mysql->query("SELECT * FROM `user` WHERE `email` = '$email'");
	$occupied_phone_number = $mysql->query("SELECT * FROM `user` WHERE `phone_number` = '$phone_number'");

	if(count($occupied_login->fetch_assoc()) != 0 && $login != $current_login)
	{
		print
		("
			<script language=javascript>
				window.alert('Введённый логин уже занят!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($login) < 4 || mb_strlen($login) > 20)
	{
		print
		("
			<script language=javascript>
				window.alert('Логин должен иметь длину от 4 до 20 символов!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(($current_pass->fetch_assoc())['password'] != $old_pass)
	{
		print
		("
			<script language=javascript>
				window.alert('Неверный пароль!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if($new_pass != $new_pass_repeat && mb_strlen($new_pass) != 0)
	{
		print
		("
			<script language=javascript>
				window.alert('Пароли не совпадают!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if((mb_strlen($new_pass) < 4 || mb_strlen($new_pass) > 15) && mb_strlen($new_pass) != 0)
	{
		print
		("
			<script language=javascript>
				window.alert('Пароль должен иметь длину от 4 до 15 символов!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($surname) < 1)
	{
		print
		("
			<script language=javascript>
				window.alert('Поле «Фамилия» не заполнено!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($name) < 1)
	{
		print
		("
			<script language=javascript>
				window.alert('Поле «Имя» не заполнено!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($last_name) < 1)
	{
		print
		("
			<script language=javascript>
				window.alert('Поле «Отчество» не заполнено!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($email) < 1)
	{
		("
			<script language=javascript>
				window.alert('Поле «E-mail» не заполнено!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(mb_strlen($phone_number) < 1)
	{
		print
		("
			<script language=javascript>
				window.alert('Поле «Номер телефона» не заполнено!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(count($occupied_email->fetch_assoc()) != 0 && $email != $current_email)
	{
		print
		("
			<script language=javascript>
				window.alert('Введённый E-mail уже занят!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(count($occupied_phone_number->fetch_assoc()) != 0 && $phone_number != $current_phone_number)
	{
		print
		("
			<script language=javascript>
				window.alert('Введённый номер телефона уже занят!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}
	else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		print
		("
			<script language=javascript>
				window.alert('E-mail введён некорректно!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}

	if(mb_strlen($new_pass) != 0)
	{
		if($mysql->query("UPDATE `user` SET `login` = '$login', `password` = '$new_pass', `surname` = '$surname', `name` = '$name', `last_name` = '$last_name', `email` = '$email', `phone_number` = '$phone_number' WHERE `user_id` = '$id'"))
		{
			setcookie('login', $login, time() + 60 * 60 * 3, "/");
			setcookie('surname', $surname, time() + 60 * 60 * 3, "/");
			setcookie('name', $name, time() + 60 * 60 * 3, "/");
			setcookie('last_name', $last_name, time() + 60 * 60 * 3, "/");
			setcookie('email', $email, time() + 60 * 60 * 3, "/");
			setcookie('phone_number', $phone_number, time() + 60 * 60 * 3, "/");
		}
		else
		{
			echo "Ошибка!";
			exit();
		}
	}
	elseif(mb_strlen($new_pass) == 0)
	{
		if($mysql->query("UPDATE `user` SET `login` = '$login', `surname` = '$surname', `name` = '$name', `last_name` = '$last_name', `email` = '$email', `phone_number` = '$phone_number' WHERE `user_id` = '$id'"))
		{
			setcookie('login', $login, time() + 60 * 60 * 3, "/");
			setcookie('surname', $surname, time() + 60 * 60 * 3, "/");
			setcookie('name', $name, time() + 60 * 60 * 3, "/");
			setcookie('last_name', $last_name, time() + 60 * 60 * 3, "/");
			setcookie('email', $email, time() + 60 * 60 * 3, "/");
			setcookie('phone_number', $phone_number, time() + 60 * 60 * 3, "/");
	}
	else
		{
			echo "Ошибка!";
			exit();
		}
	}
	
	$mysql->close();
	header('Location: /html-php/cabinet.php');
?>