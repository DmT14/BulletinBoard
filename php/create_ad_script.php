<?php
	require('ObsceneCensorRus.php');

	if($_COOKIE['login'] == '')
	{
        header('Location: ../html-php/auth.html');
        exit();
	}

	$radio_button = $_POST['anonymity'];
	$for_who = $_POST['for_who'];
	$chosen_category = $_POST['categories'];
	$user_id = $_COOKIE['user_id'];
	$description = filter_var(trim($_POST['description']), FILTER_SANITIZE_STRING);
	if(mb_strlen($description) < 1)
	{
		print
		("
			<script language=javascript>
				window.alert('Текст объявления не может быть пустым!');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
		exit();
	}

	$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
	if(mysqli_connect_errno())
	{
		printf("Connect Database failed: %s\n", mysql_connect_errno());
		exit();
	}


	// ПРОВЕРКА НА НАЛИЧИЕ НЕЦЕНЗУРНОЙ ЛЕКСИКИ

	if(ObsceneCensorRus::isAllowed($description))
	{
		$advertisment_type = 1;
	}
	else
	{
		ObsceneCensorRus::filterText($description);
		$advertisment_type = 2;
		print
		("
			<script language=javascript>
				window.alert('Объявление не может содеражать в себе нецензурную лексику, поэтому не будет размещено и отправится в архив.');
				window.location = '$_SERVER[HTTP_REFERER]';
			</script>
		");
	}
    
	// --------------------------------------


	date_default_timezone_set('Europe/Moscow');
	$current_date = date("Y-m-d H:i:s");
	$date_for_file = date("Y-m-d_H-i-s");

	$category_number = $mysql->query("SELECT `category_id` FROM `categories` WHERE `category_name` = '$chosen_category'");
	$array = $category_number->fetch_array();

	if (!empty($_FILES['file']['name']) && $advertisment_type != 2) 
    {
	  	if(move_uploaded_file($_FILES['file']['tmp_name'], '../user_images/' . $user_id . '_' . $date_for_file . '_' . $_FILES['file']['name'])) //вторым параметром каталог, куда загружаем файл
	  		$server_path = '../user_images/' . $user_id . '_' . $date_for_file . '_' . $_FILES['file']['name'];
		else
		{
			echo "Файл не загружен.<br><br>";
			print_r(error_get_last());
			exit();
		}

		$result = $mysql->query("INSERT INTO `advertisment` (`advertisment_type`, `advertisment_category`, `anonymity`, `for_who`, `user_id`, `text_content`, `file`, `date`) VALUES('$advertisment_type', '$array[0]', '$radio_button', '$for_who', '$user_id', '$description', '$server_path', '$current_date')");

	}
	else
		$result = $mysql->query("INSERT INTO `advertisment` (`advertisment_type`, `advertisment_category`, `anonymity`, `for_who`, `user_id`, `text_content`, `date`) VALUES('$advertisment_type', '$array[0]', '$radio_button', '$for_who', '$user_id', '$description', '$current_date')");

	$mysql->close();

	if($advertisment_type == 1)
		header('Location: ' . $_SERVER['HTTP_REFERER']);
?>