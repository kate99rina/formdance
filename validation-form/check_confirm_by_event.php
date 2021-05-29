<?php
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//Значение выбранное пользователем в поле со списком
list($name_skill_user,$current_percent,$sel_name_event)=explode(":", $_POST['selected_event']);
$mysql = new mysqli('localhost:8889','root','root','test');
//////////////////////////////////////////////
//Узнаем ид пользователя
/////////////////////////////////////////////////
$name_in_system=$_COOKIE['user'];
$result = $mysql->query("SELECT users.id_user  FROM `users` WHERE users.login='$name_in_system'");
$id_user=$result->fetch_assoc();
$id_user_in_system=$id_user['id_user'];
//print_r($id_user);
//////////////////////////////////////////////
//Узнаем ид skill
/////////////////////////////////////////////////
$result = $mysql->query("SELECT skills.id_skill_index  FROM `skills` INNER JOIN `tags_skill`
  ON skills.id_skill=tags_skill.id_skill
  WHERE tags_skill.name_skill='$name_skill_user' and skills.id_user=$id_user_in_system");
$id_skill_index=$result->fetch_assoc();
$id_skill_index=$id_skill_index['id_skill_index'];
//print_r($id_skill);
//////////////////////////////////////////////
//Узнаем новый % для подтверждения мероприятия
/////////////////////////////////////////////////
$result = $mysql->query("SELECT type_events.type_percent FROM `events` INNER JOIN `type_events`
    ON events.id_type=type_events.id_type WHERE events.id_user=$id_user_in_system and events.name_event='$sel_name_event'");
$new_percent=$result->fetch_assoc();
$new_percent=$new_percent['type_percent'];
////////////////////////////////////////////////////
// Проверим есть ли оценка пользователями(запрос)
///////////////////////////////////////////
$result = $mysql->query("SELECT * FROM `rating_from_users` WHERE rating_from_users.id_skill_index=$id_skill_index");
$rating=$result->fetch_all();
/////////////////////////////////////////////
//проверим, есть ли такая запись с подтверждением мероприятием
/////////////////////////////////////////////
$result = $mysql->query("SELECT *  FROM `confirm_by_event` WHERE confirm_by_event.id_skill_index=$id_skill_index");
$confirm_by_event=$result->fetch_all();

///проверка на условия
if(count($confirm_by_event)==0){
  $mysql->query("INSERT INTO `confirm_by_event`(`id_user`, `id_skill_index`, `percent_event`) VALUES ($id_user_in_system,$id_skill_index,$new_percent)");
  ////////////////////////////////////////////////////
  // Обновим общий процент из оценки пользователей и подтверждения мероприятием
  ///////////////////////////////////////////
  if(count($rating)==0){
    $new=intdiv($new_percent,2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");// code...
  }else {
    $result = $mysql->query("SELECT AVG(rating_from_users.mark_percent) FROM `rating_from_users` WHERE rating_from_users.id_skill_index=$id_skill_index");
    $avg=$result->fetch_all();

    $new=intdiv($new_percent,2)+intdiv($avg[0][0],2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
    // code...
  }

}elseif ($new_percent>$current_percent) {
  $mysql->query("UPDATE `confirm_by_event` SET `percent_event`=$new_percent WHERE confirm_by_event.id_skill_index=$id_skill_index");
  ////////////////////////////////////////////////////
  // Обновим общий процент из оценки пользователей и подтверждения мероприятием
  ///////////////////////////////////////////
  if(count($rating)==0){
    $new=intdiv($new_percent,2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");// code...
  }else {
    $result = $mysql->query("SELECT AVG(rating_from_users.mark_percent) FROM `rating_from_users` WHERE rating_from_users.id_skill_index=$id_skill_index");
    $avg=$result->fetch_all();

    $new=intdiv($new_percent,2)+intdiv($avg[0][0],2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
    // code...
  }// code...
}


$mysql->close();
header("Location:/confirm.php");

 ?>
