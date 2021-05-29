<?php
$new_member=$_POST['button_add_member'];
$mysql = new mysqli('localhost:8889','root','root','test');
$name=$_COOKIE['user'];
$result = $mysql->query("SELECT users.id_user FROM `users` WHERE users.login='$name'");
$id_user= $result->fetch_assoc();
$id_user=$id_user['id_user'];
$mysql->query("INSERT INTO `members_team` (`id_user`, `login_member`) VALUES('$id_user', '$new_member')");
header("Location:/search.php");
?>
