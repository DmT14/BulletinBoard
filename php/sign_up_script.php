<?php
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
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

	$occupied_login = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login'");
	$occupied_email = $mysql->query("SELECT * FROM `user` WHERE `email` = '$email'");
	$occupied_phone_number = $mysql->query("SELECT * FROM `user` WHERE `phone_number` = '$phone_number'");

	if(count($occupied_login->fetch_assoc()) != 0)
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
	else if(mb_strlen($password) < 4 || mb_strlen($password) > 15)
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
		print
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
	else if(count($occupied_email->fetch_assoc()) != 0)
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
	else if(count($occupied_phone_number->fetch_assoc()) != 0)
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

	$mysql->query("INSERT INTO `user` (`login`, `password`, `surname`, `name`, `last_name`, `email`, `phone_number`) VALUES('$login', '$password', '$surname', '$name', '$last_name', '$email', '$phone_number')");

	$mysql->close();
	header('Location: /');
?>