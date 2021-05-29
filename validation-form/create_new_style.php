<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$new_style=filter_var(trim($_POST['created']),FILTER_SANITIZE_STRING);
//$new_style = ( isset($_POST['new'] ) ) ? $_POST['new'] : '';
//echo "Hello";
//print_r($new_style);
//exit;
$mysql = new mysqli('localhost:8889','root','root','test');
// Создать проверку на существование названия, проверку без регистра тоже можно делать(есть спец функция)

//$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

$mysql->query("INSERT INTO `tags_style` (`name_style`)
VALUES('$new_style')");
//$mysql->close();
header("Location:/experience.php");
?>
