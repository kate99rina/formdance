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

  <form action="validation-form/change_personal_info.php" method="post">
    <?php $name=$_COOKIE['user'];
      $mysql = new mysqli('localhost:8889','root','root','test');
    $result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$name'");
    $user = $result->fetch_all(); ?>
            <div class="col-12">
              <label for="login" class="form-label">Ваше имя</label>
              <input type="text" class="form-control" name = "changed_login" id="login" placeholder="<?php print_r($name);?>">
           </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" name = "changed_email" id="email" placeholder="<?php print_r($user[0][3]); ?>">
              <label for="password" class="form-label">Пароль <span class="text-muted"></span></label>
              <input type="password" class="form-control" name = "changed_password" id="password" placeholder="********">
            </div>
              <br><button class="w-100 btn btn-primary btn-lg" type="submit">Сохранить изменения</button>
            </form>


<form action="validation-form/check_add_style.php" method="post">
          <hr class="my-4">
          <div class="col-md-8">
            <?php
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', true);
            ini_set('display_startup_errors', 1);
            ini_set('error_reporting', E_ALL);
            //  получение данных о стилях пользователя из бд
            $mysql = new mysqli('localhost:8889','root','root','test');
            $name=$_COOKIE['user'];
            $result = $mysql->query("SELECT tags_style.name_style FROM `users` INNER JOIN `styles_con`
                ON users.id_user=styles_con.id_us INNER JOIN `tags_style`
                ON styles_con.id_st=tags_style.id_style WHERE users.login='$name'");
            $style=$result->fetch_all();
            $res_st = $mysql->query("SELECT tags_style.name_style FROM  `tags_style`");
            $st_bd = $res_st->fetch_all();
            $comma_separated = "";
            for($i=0; $i<count($style);$i++){
              $comma_separated = $comma_separated . "   " . $style[$i][0] ;
            }// $mysql->close();
            ?>
            <label for="style" class="form-label">Ваши стили:  <?php print_r($comma_separated); ?>  </label><br>
              <label for="style" class="form-label">Стиль\направление</label>

<!-- низпадающий список с позициями-->
              <select name="selected_value"  class="form-select" id="selected_value" required="">
                <option value="-1">Стиль...</option>
                <?php
                for($i=0; $i<count($st_bd);$i++){?>
                <option value="<?php print_r($st_bd[$i][0]);?>"><?php print_r($st_bd[$i][0]); ?></option>
              <?php }?>
              </select>
              <button type="submit" id ="send" name="add" class="btn btn-primary">Добавить</button><br>

                <!--<label for="style" class="form-label">Добавить удаление!!!!!!: <?php //print_r($comma_separated); ?> </label><br>
              <form class="card p-2">-->
          </form>


          <form action="validation-form/create_new_style.php" method="post">
            <span class="text-muted">Если в списке нет Вашего стиля, то можете его создать ниже:</span>
                <div class="input-group">
                  <input type="text" name = "created" class="form-control" placeholder="Новый стиль">
                  <ul class="nav nav-pills">

                  <button type="submit" name="add" class="btn btn-primary">Создать</button><br>
                </div>
              <div class="invalid-feedback">
                Please select a valid country.
              </div>
        </form></div>


        <form action="validation-form/check_add_skill.php" method="post">
                  <hr class="my-4">
                  <div class="col-md-8">
                    <?php

                    $result = $mysql->query("SELECT tags_skill.name_skill FROM `users` INNER JOIN `skills`
                        ON users.id_user=skills.id_user INNER JOIN `tags_skill`
                        ON skills.id_skill=tags_skill.id_skill WHERE users.login='$name'");
                    $skill=$result->fetch_all();//массив с навыками текущего пользователя
                    $res_skl = $mysql->query("SELECT tags_skill.name_skill FROM  `tags_skill` Group by name_skill");
                    $skl_bd = $res_skl->fetch_all();// массив со всеми навыками из бд
                    $comma_separated = "";
                    for($i=0; $i<count($skill);$i++){
                      $comma_separated = $comma_separated . "   " . $skill[$i][0] ;
                    }// $mysql->close();?>
                    <label for="style" class="form-label">Ваши навыки:  <?php print_r($comma_separated); ?>  </label><br>
                      <label for="style" class="form-label">Навык:</label>

        <!-- низпадающий список с позициями-->
                      <select name="sel_value"  class="form-select" id="style" required="">
                        <option value="-1">Навык...</option>
                        <?php
                        for($i=0; $i<count($skl_bd);$i++){?>
                        <option value="<?php print_r($skl_bd[$i][0]);?>"><?php print_r($skl_bd[$i][0]); ?></option>
                      <?php }?>
                      </select>
                      <button type="submit" name="addK" class="btn btn-primary">Добавить</button><br>
                      <!--  <label for="style" class="form-label">Добавить удаление!!!!!!: <?php //print_r($comma_separated); ?> </label><br>
                      <form class="card p-2">-->
                  </div></form>


                  <form action="validation-form/create_new_skill.php" method="post">
                    <span class="text-muted">Если в списке нет Вашего навыка, то можете его создать ниже:</span>
                        <div class="input-group">
                          <input type="text" name = "creatSK" class="form-control" placeholder="Новый навык">
                          <ul class="nav nav-pills">

                          <button type="submit" name="addCrSk" class="btn btn-primary">Создать</button><br>
                        </div>
                      <div class="invalid-feedback">
                        Please select a valid country.
                      </div>
                      </form>
  <?php
 $mysql->close();
  require "blocks/footer.php"?>
  </body>
  </html>
