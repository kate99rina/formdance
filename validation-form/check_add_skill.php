<?php
// Заботимся о файловой структуре...

header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//Значение выбранное пользователем в поле со списком
$value=filter_var(trim($_POST['sel_value']),FILTER_SANITIZE_STRING);
$mysql = mysqli_connect('localhost:8889','root','root','test');

  $name=$_COOKIE['user'];
//--------------------------------------------------------
//Существующие навыки пользователя
//--------------------------------------------------------
  $result = $mysql->query("SELECT tags_skill.name_skill FROM `users` INNER JOIN `skills`
      ON users.id_user=skills.id_user INNER JOIN `tags_skill`
      ON skills.id_skill=tags_skill.id_skill WHERE users.login='$name'");
  $arr_skl = $result->fetch_all();//представим стили пользователя в виде массива
//  print_r($arr_st);

//--------------------------------------------------------
//ID выбранного навыка для запроса
//--------------------------------------------------------
  $result = $mysql->query("SELECT id_skill FROM `tags_skill` WHERE name_skill='$value'");
  $id_skill= $result->fetch_assoc();
  $id_skill = $id_skill['id_skill'];

  //--------------------------------------------------------
  //ID пользователя для запроса
  //--------------------------------------------------------
  $name=$_COOKIE['user'];
  $result = $mysql->query("SELECT id_user FROM `users` WHERE login='$name'");
  $id_user= $result->fetch_assoc();
  $id_user = $id_user['id_user'];


if(count($arr_skl) == 0){
  //echo "Вставка стиля, когда их 0";
  $mysql->query("INSERT INTO `skills` (`id_user`, `id_skill`) VALUES('$id_user', '$id_skill')");

}else {
  for($i=0; $i<count($arr_skl);$i++){
    if($arr_skl[$i][0] == $value){
      echo "Такой навык уже добавлен.";
      exit;
    }
  }
 $mysql->query("INSERT INTO `skills` (`id_user`, `id_skill`) VALUES('$id_user', '$id_skill')");// code...
}
header("Location:/experience.php");
?>
