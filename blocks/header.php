<header class="bd-header bg-dark py-3 d-flex align-items-stretch border-bottom border-dark">
  <div class="container-fluid d-flex align-items-center">
    <h1 class="d-flex align-items-center fs-4 text-white mb-0">
      <img src="/img/logo1.png" width="50" height="30" class="me-3" alt="Bootstrap">
      FormDance
    </h1>
    <style>
    a{
      text-decoration: underline;
      margin-left: auto!important;
      }
    h6{
      margin-left: auto!important;
      }</style>
      <?php $name=$_COOKIE['user']; ?>
    <h6 class="text-white ms-auto link-light" align="right">Вы зашли как <?php print_r($name); ?></h6>
    <a href="/validation-form/exit.php" class="ms-auto link-light" >Выйти</a>
  </div>
</header>
<div class="container">
  <header class="d-flex justify-content-center py-3">
    <ul class="nav nav-pills">
      <li class="nav-item"><a href="search.php" class="nav-link active">Поиск</a></li>
      <li class="nav-item"><a href="experience.php" class="nav-link">Мои навыки</a></li>
      <li class="nav-item"><a href="confirm.php" class="nav-link">Подтверждение</a></li>
      <li class="nav-item"><a href="my_team.php" class="nav-link">Моя команда</a></li>
    <!--  <li class="nav-item"><a href="rating.php" class="nav-link">Оценка</a></li>
    <li class="nav-item"><a href="choice.php" class="nav-link">Меня рассматривают</a></li>-->
    </div>

    </ul>
<script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  </header>
</div>
