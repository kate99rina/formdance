<?php
// Заботимся о файловой структуре...

header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//Значение выбранное пользователем в поле со списком
$value=filter_var(trim($_POST['selected_value']),FILTER_SANITIZE_STRING);
$mysql = mysqli_connect('localhost:8889','root','root','test');

header("Location:/experience.php");
?>
