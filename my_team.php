<!DOCTYPE html PUBLIC>
<body>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <?php require "blocks/header.php"?>
  <style type="text/css">
  form {
  margin: 0 auto;
  margin-top: 5%;
  width:800px;
  }</style>

  <div class="container-fluid">

  <!--  <main>-->
  <?php
  //
    $mysql = new mysqli('localhost:8889','root','root','test');
  $name=$_COOKIE['user'];
  //имена всех добавленных в команду
  $result = $mysql->query("SELECT members_team.login_member FROM `users` inner join `members_team` on users.id_user=members_team.id_user
  WHERE users.login='$name'");
  $users_from_team =$result->fetch_all();

  $result = $mysql->query("SELECT users.login, users.email, tags_style.name_style FROM `users` INNER JOIN `styles_con`
      ON users.id_user=styles_con.id_us INNER JOIN `tags_style`
      ON styles_con.id_st=tags_style.id_style");
  $styles=$result->fetch_all();

  $result = $mysql->query("SELECT users.login, tags_skill.name_skill FROM `users` INNER JOIN `skills`
      ON users.id_user=skills.id_user INNER JOIN `tags_skill`
      ON skills.id_skill=tags_skill.id_skill");
  $skills=$result->fetch_all();
  $text="";
  if(count($users_from_team)==0){
    $text="Здесь будут отображаться анкеты участников Вашей команды после добавления.\n Это можно сделать в разделе поиска.\n В разделе навыков Вы можете заполнить анкету и редактировать личные данные.\n В разделе подтверждения можно создать мероприятия для увеличения процента подтверждения своих навыков.";
  }
   ?>
   <h2>Моя команда</h2><br>
   <h6 align="center"><?php print_r($text); ?></h6>
   <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">

      <?php for($i=0; $i<count($users_from_team);$i++){ ?>

      <form action="show_personal.php" method="post">

      <div class="col">

        <div class="card mb-4 rounded-3 shadow-sm">

          <div class="card-header py-3">
            <h4 class="my-0 fw-normal" name="name_user_search"><?php print_r($users_from_team[$i][0]); ?></h4>
          </div>
          <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
              <h6>Стиль:</h6><li><?php for($j=0;$j<count($styles);$j++){if($styles[$j][0]==$users_from_team[$i][0]){echo $styles[$j][2]." ";}} ?></li>
              <h6>Навыки:</h6><li><?php for($j=0;$j<count($skills);$j++){if($skills[$j][0]==$users_from_team[$i][0]){echo $skills[$j][1]." ";}} ?></li>
            </ul>
            <button value="<?php print_r($users_from_team[$i][0]); ?>" name="button_v" type="submit" id="submit_search" class="w-100 btn btn-lg btn-outline-primary">Подробнее</button>
          </div>

        </div>

      </div>
    </form>
    <?php } ?>
    </div>


  <!--  </main>-->


  </div>

  <?php require "blocks/footer.php"?>
  </body>
  </html>
