<!DOCTYPE html PUBLIC>
<body>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.fig {
    text-align: center; /* Выравнивание по центру */
   }
</style>
<form action="validation-form/auth.php" method="post">
  <p class="fig"><img src="/img/logo1.png" width="100" height="70" class="me-3" alt="Bootstrap"></p>
    <!--<img class="mb-4" src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">-->
    <h1 class="h3 mb-3 fw-normal">Пожалуйста, авторизуйтесь</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name ="email" id="floatingInput" placeholder="name@example.com" required>
     <label for="floatingInput"></label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Пароль" required>
      <!--<label for="floatingPassword">Password</label>-->
    </div>

    <br><button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
  </form>
  <form action="regist.php">
<button class="w-100 btn btn-outline-secondary btn-lg px-4" type="submit" >Зарегистрироваться</button>
  <p class="mt-5 mb-3 text-muted">© 2021</p>
  </form>
</body>
</html>
