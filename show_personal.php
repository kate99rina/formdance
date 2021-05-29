<!DOCTYPE html PUBLIC>
<body>

<!--<link rel="stylesheet" href="css/style.css">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <?php require "blocks/header.php";
  $add_user=filter_var(trim($_POST['button_v']),FILTER_SANITIZE_STRING);
  $mysql = new mysqli('localhost:8889','root','root','test');
  $result = $mysql->query("SELECT tags_skill.name_skill, skills.percent FROM `users` INNER JOIN `skills`
      ON users.id_user=skills.id_user INNER JOIN `tags_skill`
      ON skills.id_skill=tags_skill.id_skill WHERE users.login='$add_user'");
  $skill=$result->fetch_all();
  $result = $mysql->query("SELECT tags_style.name_style FROM `users` INNER JOIN `styles_con`
      ON users.id_user=styles_con.id_us INNER JOIN `tags_style`
      ON styles_con.id_st=tags_style.id_style WHERE users.login='$add_user'");
  $style=$result->fetch_all();
  $comma_separated = "";
  for($i=0; $i<count($style);$i++){
    $comma_separated = $comma_separated . "   " . $style[$i][0] ;
  }
  $name=$_COOKIE['user'];
  $result = $mysql->query("SELECT members_team.login_member FROM `users` INNER JOIN `members_team`
      ON users.id_user=members_team.id_user WHERE users.login='$name'");
  $my_team=$result->fetch_all();
  ?>
<main>
    <div class="container" id="1">
  <form action="validation-form/add_to_my_team.php" method="post">
        <div class="col-12">
        <h5><?php print_r($add_user);?></h5><br>
<label for="style" class="form-label">Стили:  <?php print_r($comma_separated); ?>  </label><br>
      </div>
      <hr class="my-4">
      <div class="row mb-3">
        <div class="col-4 themed-grid-col"><code>Навык</code></div>
        <div class="col-4 themed-grid-col"><code>Подтвержден на</code></div>
      </div>
      <?php for($i=0; $i<count($skill);$i++){?>
        <div class="row mb-3">
          <div class="col-sm-4 themed-grid-col" id="skill_user"><?php print_r($skill[$i][0]);?></div>
          <div class="col-sm-4 themed-grid-col" id="current_percent"><?php echo $skill[$i][1]."%";?></div>
        </div>
        <?php }?>
        <br>
        <?php
        $flag=0;
        if(count($my_team)!=0){
          for($j=0;$j<count($my_team);$j++){
            if($my_team[$j][0]==$add_user){
              $flag=1;
              }
            }
            ?>
        <?php
            }?>
            <?php if($flag!=1){ ?>
            <button type="submit" name="button_add_member" value="<?php print_r($add_user);?>" class="btn btn-primary">Добавить в команду</button>
          <?php } ?>
    </form>
  </div>
  <div class="container" id="1">
    <form action="rating.php" method="post">
      <?php if(count($skill)!=0){ ?>
      <label for="style" class="form-label">Оценить навыки <?php  print_r($add_user); ?> можно здесь</label>
      <button type="submit" id ="send" name="button_rate" value="<?php print_r($add_user);?>" class="btn btn-outline-secondary px-4">Оценить</button>
    <?php } ?>
    </form>
  </div>
  </main>
  <?php require "blocks/footer.php"?>
  </body>
  </html>
