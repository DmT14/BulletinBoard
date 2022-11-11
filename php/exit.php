<?php
	setcookie('user_id', $user['user_id'], time() - 60 * 60, "/");
	setcookie('login', $user['login'], time() - 60 * 60, "/");
	setcookie('surname', $user['surname'], time() - 60 * 60, "/");
	setcookie('name', $user['name'], time() - 60 * 60, "/");
	setcookie('last_name', $user['last_name'], time() - 60 * 60, "/");
	setcookie('email', $user['email'], time() - 60 * 60, "/");
	setcookie('phone_number', $user['phone_number'], time() - 60 * 60, "/");

	$get_address_ads = 'http://localhost:81/php/get_address_ads.php';
	if($_SERVER['HTTP_REFERER'] == $get_address_ads)
		header('Location: ' . 'http://localhost:81/html-php/auto_moto.php');
	else
		header('Location: ' . $_SERVER['HTTP_REFERER']);
?>