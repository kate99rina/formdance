<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  $login=filter_var(trim($_POST['changed_login']),FILTER_SANITIZE_STRING);
  $password=filter_var(trim($_POST['changed_password']),FILTER_SANITIZE_STRING);
  $email=filter_var(trim($_POST['changed_email']),FILTER_SANITIZE_STRING);
  $mysql = new mysqli('localhost:8889','root','root','test');
  $name=$_COOKIE['user'];
//print_r($login);
if($login!=""){
  if(mb_strlen($login) < 3 || mb_strlen($login) > 90){
    echo "Недопустимая длина логина";
    exit();
  }else{
    $mysql->query("UPDATE `users` SET `login`='$login' WHERE users.login='$name'");
  }
  setcookie('user'/*название куки*/,
  $login/*значение куки имя пользователя*/,
  time() + 3600/*секунд=1 час*/,
  "/"/*действует на всех страницах сайта*/);
}
if($email!=""){
  if(mb_strlen($email) < 9 || mb_strlen($email) > 50){
    echo "Недопустимая длина имени";
    exit();
  } else {
    $mysql->query("UPDATE `users` SET `email`='$email' WHERE users.login='$name'");
  }
}
if($password!="") {
  if(mb_strlen($password) < 4 || mb_strlen($password) > 8){
    echo "Недопустимая длина пароля (от 4 до 8 символов)";
    exit();
} else {
  $password = md5($password."bjbvui5eb598");
  $mysql->query("UPDATE `users` SET `password`='$password' WHERE users.login='$name'");// code...
}
}
$mysql->close();
header("Location:/experience.php");
?>
