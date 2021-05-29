<?php
// Заботимся о файловой структуре...

header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//Значение выбранное пользователем в поле со списком
$value=filter_var(trim($_POST['selected_value']),FILTER_SANITIZE_STRING);
$mysql = mysqli_connect('localhost:8889','root','root','test');

  $name=$_COOKIE['user'];
  //--------------------------------------------------------
  //Существующие стили пользователя
  //--------------------------------------------------------
  $result = $mysql->query("SELECT tags_style.name_style FROM `users` INNER JOIN `styles_con`
      ON users.id_user=styles_con.id_us INNER JOIN `tags_style`
      ON styles_con.id_st=tags_style.id_style WHERE users.login='$name'");
  $arr_st = $result->fetch_all();//представим стили пользователя в виде массива
///print_r($arr_st);

//--------------------------------------------------------
//ID выбранного стиля для запроса
//--------------------------------------------------------
  $result = $mysql->query("SELECT id_style FROM `tags_style` WHERE name_style='$value'");
  $id_style= $result->fetch_all();
  $id_style = $id_style[0][0];


  //--------------------------------------------------------
  //ID пользователя для запроса
  //--------------------------------------------------------
  $result = $mysql->query("SELECT id_user FROM `users` WHERE login='$name'");
  $id_user= $result->fetch_assoc();
  $id_user = $id_user['id_user'];


if(count($arr_st) == 0){
  //echo "Вставка стиля, когда их 0";
  $mysql->query("INSERT INTO `styles_con` (`id_us`, `id_st`) VALUES('$id_user', '$id_style')");

}else {
  for($i=0; $i<count($arr_st);$i++){
    if($arr_st[$i][0] == $value){
      echo "fail";
      //exit;
    }
  }
 $mysql->query("INSERT INTO `styles_con` (`id_us`, `id_st`) VALUES('$id_user', '$id_style')");// code...
}
header("Location:/experience.php");
?>
