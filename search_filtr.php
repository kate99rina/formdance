<!DOCTYPE html PUBLIC>
<body>
  <script
		src="https://code.jquery.com/jquery-1.12.3.min.js"
		integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
		crossorigin="anonymous"></script>
	<script src="add_to_team.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <?php require "blocks/header.php"?>
  <style type="text/css">
  form {
  margin: 0 auto;
  margin-top: 5%;
  width:1000px;
  }</style>

  <div class="container-fluid">
    <?php
    ///////////////////////////////////////////////
    //принимаем данные метода пост чтобы отфильтроывать анкеты
    /////////////////////////////////////////////////////////
    $value_style=filter_var(trim($_POST['selected_value_style']),FILTER_SANITIZE_STRING);
    $value1=filter_var(trim($_POST['sel_value1']),FILTER_SANITIZE_STRING);
    $value2=filter_var(trim($_POST['sel_value2']),FILTER_SANITIZE_STRING);
    $value3=filter_var(trim($_POST['sel_value3']),FILTER_SANITIZE_STRING);
    $value4=filter_var(trim($_POST['sel_value4']),FILTER_SANITIZE_STRING);
    $value5=filter_var(trim($_POST['sel_value5']),FILTER_SANITIZE_STRING);
    $mysql = new mysqli('localhost:8889','root','root','test');
    //для фильтра по стилям
    $result = $mysql->query("SELECT tags_style.name_style FROM `tags_style`");
    $skill=$result->fetch_all();
    //для фильтра по навыкам
    $res_skl = $mysql->query("SELECT tags_skill.name_skill FROM  `tags_skill` Group by name_skill");
    $skl_bd = $res_skl->fetch_all();
     ?>
  <form name="form" action="search_filtr.php" method="post">
  <label for="style" class="form-label">Стиль\направление</label>
  <select name="selected_value_style"  class="form-select" id="selected_value_style" required="">
    <option value="-1">Стиль...</option>
    <?php
    for($i=0; $i<count($skill);$i++){?>
    <option value="<?php print_r($skill[$i][0]);?>"><?php print_r($skill[$i][0]); ?></option>
  <?php }?>
  </select><br>

  <span class="text-muted">Укажите важные навыки</span><br>
  <select name="sel_value1"  class="form-select" id="style" required="">
    <option value="-1"></option>
    <?php
    for($i=0; $i<count($skl_bd);$i++){?>
    <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
  <?php }?>
  </select>
  <select name="sel_value2"  class="form-select" id="style" required="">
    <option value="-1"></option>
    <?php
    for($i=0; $i<count($skl_bd);$i++){?>
    <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
  <?php }?>
  </select>
  <select name="sel_value3"  class="form-select" id="style" required="">
    <option value="-1"></option>
    <?php
    for($i=0; $i<count($skl_bd);$i++){?>
    <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
  <?php }?>
  </select>
  <select name="sel_value4"  class="form-select" id="style" required="">
    <option value="-1"></option>
    <?php
    for($i=0; $i<count($skl_bd);$i++){?>
    <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
  <?php }?>
  </select>
  <select name="sel_value5"  class="form-select" id="style" required="">
    <option value="-1"></option>
    <?php
    for($i=0; $i<count($skl_bd);$i++){?>
    <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
  <?php }?>
  </select>
  <!--<input class="form-control" type="text" placeholder="Search" aria-label="Search">
  <p align="right">-->
  <button class="btn btn-outline-success" type="submit">Найти</button><br><br>
  </form>
</div>
<?php

$sql="SELECT DISTINCT users.login FROM `users`INNER JOIN `skills`
  ON users.id_user=skills.id_user INNER JOIN `tags_skill`
  ON skills.id_skill=tags_skill.id_skill";
  $array= array($value1,$value2,$value3,$value4,$value5);
  $comma="";
  $condition="tags_skill.name_skill=";
  for($i=0;$i<5;$i++){
    if($comma!="" and $array[$i]!="-1"){
      //echo "1";
      $comma=$comma . " and ". $condition . "'".$array[$i]."'";
    }elseif ($comma=="" and $array[$i]!="-1") {
      $comma=" WHERE ".$condition ."'". $array[$i]."'";
      //echo "2";// code...
    }
  }
$sql=$sql.$comma;
if($value_style!="-1" and $comma!=""){
  //echo "3";
  $sql=$sql." AND users.login IN (Select users.login from users inner join styles_con
    on users.id_user=styles_con.id_us inner join tags_style on styles_con.id_st=tags_style.id_style
    WHERE tags_style.name_style='$value_style')";
}elseif ($value_style!="-1" and $comma=="") {
//  echo "4";
$sql="Select users.login from users inner join styles_con
  on users.id_user=styles_con.id_us inner join tags_style on styles_con.id_st=tags_style.id_style
  WHERE tags_style.name_style='$value_style'";// code...
}
$result = $mysql->query($sql);
$filtr_users=$result->fetch_all();
$name=$_COOKIE['user'];
$result = $mysql->query("SELECT * FROM `users` WHERE users.login!='$name'");
$users =$result->fetch_all();
$result = $mysql->query("SELECT users.login, users.email, tags_style.name_style FROM `users` INNER JOIN `styles_con`
    ON users.id_user=styles_con.id_us INNER JOIN `tags_style`
    ON styles_con.id_st=tags_style.id_style");
$styles=$result->fetch_all();

$result = $mysql->query("SELECT users.login, tags_skill.name_skill FROM `users` INNER JOIN `skills`
    ON users.id_user=skills.id_user INNER JOIN `tags_skill`
    ON skills.id_skill=tags_skill.id_skill");
$skills=$result->fetch_all();
?>
<div class="container-fluid">
<main>
  <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

    <?php for($i=0; $i<count($users);$i++){
      for($k=0;$k<count($filtr_users);$k++){
        if($filtr_users[$k][0]==$users[$i][1]){
      ?>
      <form action="show_personal.php" method="post">
    <div class="col">
      <div class="card mb-4 rounded-3 shadow-sm">
        <div class="card-header py-3">
          <h4 class="my-0 fw-normal" id="name_user_search"><?php print_r($users[$i][1]); ?></h4>
        </div>
        <div class="card-body">
          <!--<img src="img/1.jpg" height=200px width=250px>
          <h1 class="card-title pricing-card-title"><?php //print_r($users[$i][1]); ?><small class="text-muted fw-light"></small></h1>-->
          <ul class="list-unstyled mt-3 mb-4">
            <h6>Стиль:</h6><li><?php for($j=0;$j<count($styles);$j++){if($styles[$j][0]==$users[$i][1]){echo $styles[$j][2]." ";}} ?></li>
            <h6>Навыки:</h6><li><?php for($j=0;$j<count($skills);$j++){if($skills[$j][0]==$users[$i][1]){echo $skills[$j][1]." ";}} ?></li>
          </ul>
          <button type="submit" name="button_v" value="<?php print_r($users[$i][1]); ?>" id="submit_search" class="w-100 btn btn-lg btn-outline-primary">Подробнее</button>
        </div>
      </div>
    </div>
  </form>
  <?php }
}
} ?>
  </div>
</main>
</div>
</body>
