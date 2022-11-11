<?php
	$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	
	$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
	if(mysqli_connect_errno())
	{
		printf("Connect Database failed: %s\n", mysql_connect_errno());
		exit();
	}

	$result = $mysql->query("SELECT * FROM `user` WHERE `login` = '$login' AND `password` = '$password'");
	$user = $result->fetch_assoc();
	
	if(count($user) == 0)
	{
		print
		("
			<script language=javascript>
				window.alert('Пользователь не найден!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}

	setcookie('user_id', $user['user_id'], time() + 60 * 60 * 3, "/");
	setcookie('login', $user['login'], time() + 60 * 60 * 3, "/");
	setcookie('surname', $user['surname'], time() + 60 * 60 * 3, "/");
	setcookie('name', $user['name'], time() + 60 * 60 * 3, "/");
	setcookie('last_name', $user['last_name'], time() + 60 * 60 * 3, "/");
	setcookie('email', $user['email'], time() + 60 * 60 * 3, "/");
	setcookie('phone_number', $user['phone_number'], time() + 60 * 60 * 3, "/");

	$mysql->close();

	$get_address_ads = 'http://localhost:81/php/get_address_ads.php';
	if($_SERVER['HTTP_REFERER'] == $get_address_ads)
		header('Location: /');
	else
		header('Location: ' . $_SERVER['HTTP_REFERER']);
?>