<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
  $login=filter_var(trim($_POST['login']),FILTER_SANITIZE_STRING);
  $password=filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
  $email=filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);

  if(mb_strlen($login) < 5 || mb_strlen($login) > 90){
    echo "Недопустимая длина логина";
    exit();
  }else if(mb_strlen($email) < 9 || mb_strlen($email) > 50){
    echo "Недопустимая длина имени";
    exit();
  }else if(mb_strlen($password) < 4 || mb_strlen($password) > 8){
    echo "Недопустимая длина пароля (от 4 до 8 символов)";
    exit();
  }
  $role='user';
  $password = md5($password."bjbvui5eb598");
  $mysql = new mysqli('localhost:8889','root','root','test');
  $mysql->query("INSERT INTO `users` (`login`, `password`, `email`,`role`)
  VALUES('$login', '$password', '$email','$role')");
  $mysql->close();
//  echo "\nPDOStatement::errorInfo():\n";
//$arr = $mysql->errorInfo();
//print_r($arr);
header("Location:/");
?>
