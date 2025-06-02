<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>LOGIN MULTI USER</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/dist/css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    
    <form class="form-signin" action="proses2.php?action=login" method="post">
  <div class="text-center mb-4">
    <img class="mb-4" src="assets/brand/kue-balok.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Form Login</h1>
    <p>Masukkan Username dan Password dengan benar ! </p>
  </div>

  <div class="form-label-group">
    <input type="text" class="form-control" name="username" placeholder="username/email" required autofocus>
    <label for="inputEmail">Masukkan Username</label>
  </div>

  <div class="form-label-group">
    <input type="password"  class="form-control" name="password" placeholder="Masukkan Password" required>
    <label>Masukkan Password</label>
  </div>


  <!-- <div class="form-label-group">
    <select class = "form-control" name="tipe_user">
      <option value="customer">customer</option>
      <option value="admin">admin</option>
      <option value="kasir">kasir</option>
      <option value="owner">owner</option>
    </select>
  </div> -->

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" >Sign in</button>
  <p class="mt-5 mb-3 text-muted text-center">&copy; Kue Balok Mang Wiro 2025</p>
</form>

</body>
</html>
