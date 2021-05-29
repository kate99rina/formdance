<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$type_event=filter_var(trim($_POST['selected_event']),FILTER_SANITIZE_STRING);
$name_event=filter_var(trim($_POST['event']),FILTER_SANITIZE_STRING);
$link=filter_var(trim($_POST['link']),FILTER_SANITIZE_STRING);


$mysql = new mysqli('localhost:8889','root','root','test');
$name=$_COOKIE['user'];
//--------------------------------------------------------
//ID типа мероприятия для запроса
//--------------------------------------------------------
  $result = $mysql->query("SELECT id_type FROM `type_events` WHERE name_type='$type_event'");
  $id_type= $result->fetch_assoc();
  $id_type = $id_type['id_type'];

  //--------------------------------------------------------
  //ID пользователя для запроса
  //--------------------------------------------------------
  $result = $mysql->query("SELECT id_user FROM `users` WHERE login='$name'");
  $id_user= $result->fetch_assoc();
  $id_user = $id_user['id_user'];

$mysql->query("INSERT INTO `events` (`id_type`, `id_user`, `name_event`, `link_event`)
VALUES('$id_type', '$id_user', '$name_event', '$link')");
//$mysql->close();
header("Location:/confirm.php");
?>
