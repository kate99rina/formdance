<!DOCTYPE html PUBLIC>
<body>
  <script
		src="https://code.jquery.com/jquery-1.12.3.min.js"
		integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ="
		crossorigin="anonymous"></script>
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
  <div class="container-fluid">
  <?php
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
    <option value="-1"></option>
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
<button class="btn btn-outline-success" type="submit">Найти</button><br><br>
</form>
</div>
        <div class="container-fluid">

      <!--  <main>-->
        <?php
        //
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
         <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
            <?php for($i=0; $i<count($users);$i++){ ?>

            <form action="show_personal.php" method="post">

            <div class="col">

              <div class="card mb-4 rounded-3 shadow-sm">

                <div class="card-header py-3">
                  <h4 class="my-0 fw-normal" name="name_user_search"><?php print_r($users[$i][1]); ?></h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled mt-3 mb-4">
                    <h6>Стиль:</h6><li><?php for($j=0;$j<count($styles);$j++){if($styles[$j][0]==$users[$i][1]){echo $styles[$j][2]." ";}} ?></li>
                    <h6>Навыки:</h6><li><?php for($j=0;$j<count($skills);$j++){if($skills[$j][0]==$users[$i][1]){echo $skills[$j][1]." ";}} ?></li>
                  </ul>
                  <button value="<?php print_r($users[$i][1]); ?>" name="button_v" type="submit" id="submit_search" class="w-100 btn btn-lg btn-outline-primary">Подробнее</button>
                </div>

              </div>

            </div>
          </form>
          <?php } ?>
          </div>
      </div>
<?php require "blocks/footer.php"?>
</body>
</html>
