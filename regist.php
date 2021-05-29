<!DOCTYPE html PUBLIC>
<body>
  <!--<link rel="stylesheet" href="css/style.css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
  form {
    margin: 0 auto;
    width: 800px;
  }
  </style>
<!--<form class="needs-validation" novalidate="" >-->

  <form action="validation-form/check.php" method="post">
          <h1> Регистрация</h1>
            <div class="col-12">
              <label for="login" class="form-label">Ваше имя</label>
            <!--  <div class="input-group has-validation">
                <span class="input-group-text">@</span>-->
                <input type="text" class="form-control" name = "login" id="login" placeholder="Анита или Anita" required>
            <!--  <div class="invalid-feedback">
                  Your username is required.
                </div>
              </div>-->
           </div>

            <div class="col-12">
              <label for="email" class="form-label">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control" name = "email" id="email" placeholder="you@example.com" required>


          <!--  <div class="col-12">-->
              <label for="password" class="form-label">Пароль <span class="text-muted"></span></label>
              <input type="password" class="form-control" name = "password" id="password" placeholder="Введите пароль" required>


          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Зарегистрироваться</button>
        </div>
        </form>
        <form action="index.php">
        <div class="col-12">
        <button class="w-100 btn btn-outline-secondary btn-lg px-4" type="submit" >У меня есть аккаунт</button>
          <p class="mt-5 mb-3 text-muted">© 2021</p>
        </div>
          </form>

</body>
</html>
