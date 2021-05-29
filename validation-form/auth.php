<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  //$login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
  $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
  $password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

  //$role='user';
  $password = md5($password."bjbvui5eb598");
  $mysql = new mysqli('localhost:8889','root','root','test');

  $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'
    AND `password` = '$password'");
  $user = $result->fetch_assoc();//представим данные пользователя в виде массива

if(count($user) == 0){
  echo "Такого пользователя не существует";
  exit;
}

setcookie('user'/*название куки*/,
$user['login']/*значение куки имя пользователя*/,
time() + 3600/*секунд=1 час*/,
"/"/*действует на всех страницах сайта*/);

  header("Location:/my_team.php");
?>
