<?php
	$mysql = new mysqli('localhost:3306', 'root', '', 'bulletin_board');
    if(mysqli_connect_errno())
    {
        printf("Connect failed: %s\n", mysql_connect_errno());
        exit();
    }

	$advertisment_id = filter_var(trim($_POST['advertisment_id']), FILTER_SANITIZE_STRING);

	$server_path = $mysql->query("SELECT `file` FROM `advertisment` WHERE `advertisment_id` = '$advertisment_id'");
	$server_path = $server_path->fetch_assoc();
	unlink($server_path['file']);
	$mysql->query("DELETE FROM `advertisment` WHERE `advertisment_id` = '$advertisment_id'");
	$mysql->close();
	header('Location: ' . $_SERVER['HTTP_REFERER']);
?>