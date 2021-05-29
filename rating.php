<!DOCTYPE html PUBLIC>
<body>
  <script
		src="https://code.jquery.com/jquery-1.12.3.min.js"
		integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
		crossorigin="anonymous"></script>
	<script src="add_to_team.js"></script>
<!--<link rel="stylesheet" href="css/style.css">-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <?php require "blocks/header.php"?>
  <style type="text/css">
  form {
  margin: 0 auto;
  margin-top: 5%;
  width:1000px;
  }
  </style>

  <main>
    <form action="validation-form/create_new_event.php" method="post">
              <!--<hr class="my-4">
              <div class="col-md-8">-->
                <?php
                /*ini_set('error_reporting', E_ALL);
                ini_set('display_errors', true);
                ini_set('display_startup_errors', 1);
                ini_set('error_reporting', E_ALL);*/
                //  получение данных о стилях пользователя из бд
                $mysql = new mysqli('localhost:8889','root','root','test');
                $user_rate=$_POST['button_rate'];
                //типы мероприятий
                $res_ev = $mysql->query("SELECT type_events.name_type FROM  `type_events`");
                $ev_bd = $res_ev->fetch_all();
                //для вывода в столбик навыков
                $result = $mysql->query("SELECT tags_skill.name_skill FROM `users` INNER JOIN `skills`
                    ON users.id_user=skills.id_user INNER JOIN `tags_skill`
                    ON skills.id_skill=tags_skill.id_skill WHERE users.login='$user_rate'");
                $skill=$result->fetch_all();//массив с навыками текущего пользователя
                //print_r($skill);
                ?>

  <hr class="my-4">
    <div class="container" id="1">

    <p class="lead">Вы оцениваете <?php print_r($user_rate);?></p>
  <form>
      <div class="row mb-3">
        <div class="col-4 themed-grid-col"><code>Навык</code></div>
        <div class="col-4 themed-grid-col"><code>Кто Вы?</code></div>
        <div class="col-4 themed-grid-col"><code>Ваша оценка в %</code></div>
      </div>
  </form>

  <?php for($i=0; $i<count($skill);$i++){?>
    <form action="validation-form/rating_by_user.php" method="post">
      <div class="row mb-3">

        <div class="col-sm-4 themed-grid-col" id="skill_user"><?php print_r($skill[$i][0]);?></div>
        <div class="col-sm-4 themed-grid-col"><select name="selected_role_rate"  class="form-select" id="selected_event" required="">
          <option value="-1"> </option>
          <option value="Тренер">Тренер</option>
          <option value="Коллега из команды">Коллега из команды</option>
      </select></div>
        <div class="col-sm-4 themed-grid-col">
          <input type="text" class="form-control" name = "percent" id="percent">
          <button type="submit" id ="send" value="<?php print_r($skill[$i][0].":".$user_rate);?>" name="button_rate_skill" class="btn btn-primary">Оценить</button><br></div>

      </div>
    </form>
  <?php }?>
    </div>
  <?php require "blocks/footer.php"?>
  </body>
  </html>
