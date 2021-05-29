<?php
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//принимаем данные
list($skill_for_rate,$login_user_for_rate)=explode(":",$_POST['button_rate_skill']);
$user_relation=$_POST['selected_role_rate'];
$percent_for_rate=$_POST['percent'];
//print_r($skill_for_rate);
//print_r($login_user_for_rate);
$mysql = new mysqli('localhost:8889','root','root','test');
//login_user_for_rate
//////////////////////////////////////////////
//Узнаем ид пользователя
/////////////////////////////////////////////////
$name_in_system=$_COOKIE['user'];
$result = $mysql->query("SELECT users.id_user  FROM `users` WHERE users.login='$name_in_system'");
$id_user=$result->fetch_assoc();
$id_user_in_system=$id_user['id_user'];
//////////////////////////////////////////////
//Узнаем ид пользователя, которого оцениваем
/////////////////////////////////////////////////
$result = $mysql->query("SELECT users.id_user  FROM `users` WHERE users.login='$login_user_for_rate'");
$id_user=$result->fetch_assoc();
$id_user_for_rate=$id_user['id_user'];
//////////////////////////////////////////////
//Узнаем ид skill
/////////////////////////////////////////////////
$result = $mysql->query("SELECT skills.id_skill_index  FROM `skills` INNER JOIN `tags_skill`
  ON skills.id_skill=tags_skill.id_skill
  WHERE tags_skill.name_skill='$skill_for_rate' and skills.id_user=$id_user_for_rate");
$id_skill_index=$result->fetch_assoc();
$id_skill_index=$id_skill_index['id_skill_index'];
print_r($id_skill_index);
///////////////////////////////////
//узнаем оценивал ли пользователь этот навык
//////////////////////////////////
$result = $mysql->query("SELECT count(*) FROM `rating_from_users` WHERE rating_from_users.id_skill_index=$id_skill_index and rating_from_users.id_user=$id_user_in_system");
$ask_rating=$result->fetch_all();

if($ask_rating[0][0]==0){
  $mysql->query("INSERT INTO `rating_from_users`(`id_user`, `id_skill_index`, `login_user`, `type_relation`, `mark_percent`)
    VALUES ('$id_user_in_system','$id_skill_index','$login_user_for_rate','$user_relation',$percent_for_rate)");
    /////////////////////////////////////////////
    //проверим, есть ли такая запись с подтверждением мероприятием
    /////////////////////////////////////////////
    $result = $mysql->query("SELECT count(*)  FROM `confirm_by_event` WHERE confirm_by_event.id_skill_index=$id_skill_index");
    $confirm_by_event=$result->fetch_all();

    $result = $mysql->query("SELECT AVG(rating_from_users.mark_percent) FROM `rating_from_users`
      WHERE rating_from_users.id_skill_index=$id_skill_index");
    $avg=$result->fetch_all();
    echo "1";
    if($confirm_by_event[0][0]==0){
      $new=intdiv($avg[0][0],2);
      $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
      echo "2";
    }else {
      $result = $mysql->query("SELECT confirm_by_event.percent_event  FROM `confirm_by_event` WHERE confirm_by_event.id_skill_index=$id_skill_index");
      $percent=$result->fetch_all();
      $new=intdiv($percent[0][0],2)+intdiv($avg[0][0],2);
      $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
      echo "3";
    }
}else{
  $mysql->query("UPDATE `rating_from_users` SET `type_relation`='$user_relation',`mark_percent`=$percent_for_rate WHERE rating_from_users.id_user=$id_user_in_system and rating_from_users.id_skill_index=$id_skill_index");
  /////////////////////////////////////////////
  //проверим, есть ли такая запись с подтверждением мероприятием
  /////////////////////////////////////////////
  $result = $mysql->query("SELECT count(*)  FROM `confirm_by_event` WHERE confirm_by_event.id_skill_index=$id_skill_index");
  $confirm_by_event=$result->fetch_all();

  $result = $mysql->query("SELECT AVG(rating_from_users.mark_percent) FROM `rating_from_users`
    WHERE rating_from_users.id_skill_index=$id_skill_index");
  $avg=$result->fetch_all();
  echo "4";
  if($confirm_by_event[0][0]==0){
    $new=intdiv($avg[0][0],2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
    echo "5";
  }else {
    $result = $mysql->query("SELECT confirm_by_event.percent_event  FROM `confirm_by_event` WHERE confirm_by_event.id_skill_index=$id_skill_index");
    $percent=$result->fetch_all();
    $new=intdiv($percent,2)+intdiv($avg[0][0],2);
    $mysql->query("UPDATE `skills` SET `percent`=$new WHERE skills.id_skill_index=$id_skill_index");
    echo "6";
  }
}
$mysql->close();
header("Location:/search.php");
?>
