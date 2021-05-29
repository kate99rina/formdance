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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

  <script>
  /*$(document).ready (function (){
    $("#send").bind("click", function () {
      $.ajax({
        url: "check_confirm_by_event.php",
        type: "POST",
        data: ({skill_user: $("#skill_user").val(), current_percent: $("#$current_percent").val()}),
        dataType: "html",
        beforeSend: function (){
          $("#info").text ("haha");
        },
        success: function (data){
          $("#info").text (data);
          window.alert("Уже подтверждено!");

        };
      });
    });
  });*/
  </script>
  <main>
    <form action="validation-form/create_new_event.php" method="post">
              <!--<hr class="my-4">
              <div class="col-md-8">-->
                <?php
                ini_set('error_reporting', E_ALL);
                ini_set('display_errors', true);
                ini_set('display_startup_errors', 1);
                ini_set('error_reporting', E_ALL);
                //  получение данных о стилях пользователя из бд
                $mysql = new mysqli('localhost:8889','root','root','test');
                $name=$_COOKIE['user'];
                //типы мероприятий
                $res_ev = $mysql->query("SELECT type_events.name_type FROM  `type_events`");
                $ev_bd = $res_ev->fetch_all();
                //для вывода в столбик навыков
                $result = $mysql->query("SELECT tags_skill.name_skill, skills.percent FROM `users` INNER JOIN `skills`
                    ON users.id_user=skills.id_user INNER JOIN `tags_skill`
                    ON skills.id_skill=tags_skill.id_skill WHERE users.login='$name'");
                $skill=$result->fetch_all();//массив с навыками текущего пользователя
                //print_r($skill);
                $result = $mysql->query("SELECT events.name_event FROM `users` INNER JOIN `events`
                    ON users.id_user=events.id_user WHERE users.login='$name'");
                $events_of_user=$result->fetch_all();
                ?>
                <label for="event" class="form-label">Мероприятие</label>
                <input type="text" class="form-control" name = "event" placeholder="Название"><br>

                <label for="style" class="form-label">Выберете тип:</label>

    <!-- низпадающий список с позициями-->
                  <select name="selected_event"  class="form-select" id="selected_event" required="">
                    <option value="-1"> </option>
                    <?php
                    for($i=0; $i<count($ev_bd);$i++){?>
                    <option value="<?php print_r($ev_bd[$i][0]);?>" id="event"><?php print_r($ev_bd[$i][0]); ?></option>
                  <?php }?>
                  </select>
                  <br><label for="link" class="form-label">Ссылка:</label>
                  <input type="text" class="form-control" name = "link" id="link" placeholder="http://....">
                  <span class="text-muted">Это может быть ссылка на грамоту, на официальный список участников и т.д.</span><br>
                  <button type="submit" id ="send" name="add" class="btn btn-primary">Добавить мероприятие</button><br>

                <!--  <label for="style" class="form-label">Добавить удаление!!!!!!: <?php //print_r($comma_separated); ?> </label><br>

                  <form class="card p-2">-->
              </form>
<hr class="my-4">
    <div class="container" id="1">

    <!--  <p class="lead">Написать пояснение !!!</p>-->
  <form action="validation-form/check_confirm_by_event.php" method="post">
      <div class="row mb-3">
        <div class="col-4 themed-grid-col"><code>Навык</code></div>
        <div class="col-4 themed-grid-col"><code>Подтвержден на</code></div>
        <div class="col-4 themed-grid-col"><code>Мероприятие</code></div>
      </div>
</form>

<?php for($i=0; $i<count($skill);$i++){?>
    <form action="validation-form/check_confirm_by_event.php" method="post">
      <div class="row mb-3">

        <div class="col-sm-4 themed-grid-col" id="skill_user"><?php print_r($skill[$i][0]);?></div>
        <div class="col-sm-4 themed-grid-col" id="current_percent"><?php echo $skill[$i][1]."%";?></div>
        <div class="col-sm-4 themed-grid-col"><select name="selected_event"  class="form-select" id="selected_event" required="">
          <option value="-1"> </option>
          <?php
          for($j=0; $j<count($events_of_user);$j++){
            $all_info=$skill[$i][0].":".$skill[$i][1].":".$events_of_user[$j][0]?>
          <option value="<?php print_r($all_info);?>"><?php print_r($events_of_user[$j][0]); ?></option>
        <?php }?>
      </select><button type="submit" id ="send" name="send" class="btn btn-primary">Сохранить</button><br></div>

      </div>
    </form>
<?php }?>
    </div>


  </main>
  <?php require "blocks/footer.php"?>
  </body>
  </html>
