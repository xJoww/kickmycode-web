<?php
  require 'database/connect.php';

  if (isset($_COOKIE['user_email']) && isset($_COOKIE['user_pass'])) {

      $user = $_COOKIE['user_email'];
      $pass = $_COOKIE['user_pass'];

      $result = mysqli_query($db, "SELECT * FROM auto_auth WHERE user = '$user'");

      if (mysqli_num_rows($result)) {

          $row = mysqli_fetch_assoc($result);

          if (password_verify($user, $row['user_hash']) && password_verify($pass, $row['pass_hash'])) {

              if (date('d/m/Y, H:i') >= $row['expire']) {

                  mysqli_query($db, "DELETE FROM auto_auth WHERE user = '$user'");
              }
              $_SESSION['auth'] = true;
          }
      }
      else {

          $autofill_value = true;

          setcookie('user_email', '', time() - 1);
          setcookie('user_pass', '', time() - 1);
      }
  }
  if (isset($_SESSION['auth'])) {

      header ("Location: index.php?page=dashboard");
      exit;
  }
  if (isset($_POST['sign_in'])) {

    if (isset($_POST['email']) && $_POST['password']) {

      $email = $_POST['email'];
      $password = $_POST['password'];
      
      $query = "SELECT * FROM akun WHERE email = '$email'";
      $result = mysqli_query($db, $query);

      if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

          if (isset($_POST['remember_me'])) {

              $user_hash = password_hash($email, PASSWORD_DEFAULT);
              $pass_hash = password_hash($password, PASSWORD_DEFAULT);

              setcookie('user_email', $email, time() + (60*60*24)*7);
              setcookie('user_pass', $password, time() + (60*60*24)*7);

              $date_7d = date('d/m/Y, H:i', strtotime('+168 hours'));
              mysqli_query($db, "INSERT INTO auto_auth (user, user_hash, pass_hash, expire) VALUES ('$email', '$user_hash', '$pass_hash', '$date_7d')");
          
              if (mysqli_affected_rows($db)) {

                  $_SESSION['user'] = $_POST['email'];
              }
          }
          $_SESSION['user'] = $email;
          $_SESSION['auth'] = true;

          header ("Location: index.php?page=dashboard");
          exit;
        }
        else $wrong_pw = true;
      }
      else $invalid_email = true;
    }
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>KickMyCode - Sign In</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <script type="text/javascript" src="jQuery/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="assets/js/login.js?v=1"></script>

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="assets/css/sign-in.css" rel="stylesheet">
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

    
<main class="form-signin w-100 m-auto border border-dark rounded-2 p-4">
  <form action="" method="post" id="form_login">
    <h1 class="h3 mb-1 fw-semibold text-center text-green-500">KickMyCode</h1>
    <p class="text-xs mb-4 text-center" style="letter-spacing: 5px">by xJoww</p>

    <div class="form-floating mb-3">
      <?php if (!isset($autofill_value)) : ?>
        <input type="email" name="email" class="form-control focus-ring rounded focus-ring-dark border border-dark" id="email" placeholder="name@example.com" aria-describedby="email_desc">
        <label for="email">Email address</label>
        <?php if (isset($invalid_email)) : ?>
          <div id="email_desc" class="form-text text-xs text-red-500">* The email was not found.</div>
        <?php else : ?>
          <div id="email_desc" class="form-text text-xs text-red-500"></div>
        <?php endif; ?>
      <?php else : ?>
        <input type="email" name="email" class="form-control focus-ring rounded focus-ring-dark border border-dark" id="email" placeholder="name@example.com" aria-describedby="email_desc" value="<?= $_COOKIE['user_email']; ?>">
        <label for="email">Email address</label>
        <?php if (isset($invalid_email)) : ?>
          <div id="email_desc" class="form-text text-xs text-red-500">* The email was not found.</div>
        <?php else : ?>
          <div id="email_desc" class="form-text text-xs text-red-500"></div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="form-floating mb-2">
      <?php if (!isset($autofill_value)) : ?>
        <input type="password" name="password" class="form-control focus-ring rounded focus-ring-dark border border-dark mb-0" id="password" placeholder="Password" aria-describedby="password_desc">
        <label for="password">Password</label>
        <button id="reveal_btn" class="text-xs" type="button"><i class="bi bi-eye-fill me-1" id="reveal-eye"></i>Reveal password</button>
        <?php if (isset($wrong_pw)) : ?>
          <div id="password_desc" class="form-text text-xs text-red-500">* Incorrect password.</div>
        <?php else : ?>
          <div id="password_desc" class="form-text text-xs text-red-500"></div>
        <?php endif; ?>
      <?php else : ?>
        <input type="password" name="password" class="form-control focus-ring rounded focus-ring-dark border border-dark mb-0" id="password" placeholder="Password" aria-describedby="password_desc" value="<?= $_COOKIE['user_pass']; ?>">
        <label for="password">Password</label>
        <button id="reveal_btn" class="text-xs" type="button"><i class="bi bi-eye-fill me-1" id="reveal-eye"></i>Reveal password</button>
        <?php if (isset($wrong_pw)) : ?>
          <div id="password_desc" class="form-text text-xs text-red-500">* Incorrect password.</div>
        <?php else : ?>
          <div id="password_desc" class="form-text text-xs text-red-500"></div>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="mb-3 form-check">
      <input name="remember_me" type="checkbox" class="form-check-input border border-secondary text-sm active:bg-green-500 focus:bg-green-500 focus:ring focus:ring-white" id="remember_me">
      <label class="form-check-label text-sm relative bottom-0.5" for="remember_me">Remember me for 7 days</label>
    </div>

    <!-- <div class="form-check text-start my-3">
      <input class="form-check-input border-black" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div> -->
    <button class="btn w-100 py-2 text-white bg-green-600 hover:bg-green-700" type="submit" name="sign_in">Sign In</button>
    <p class="mt-1.5 mb-3 text-body-secondary text-xs text-center">Dont have an account? <a href="?page=register"><u>Sign up now!</u></a></p>
  </form>
</main>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
