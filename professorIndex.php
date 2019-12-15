<?php
include('login.php');

if(isset($_SESSION['login_user'])){
    header("location : professorIndex.php");
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="./professorLogin.css">
    <meta charset="utf-8">
    <title>Professor Homepage</title>
  </head>
  <body>
    <form action="login.php" method="post">
      <div class="container">
        <b>Email</b>
        <input type="text" placeholder="Please enter valid SYR email" name="uname" required>

        <b>Password</b>
        <input type="password" placeholder="Enter Password" name="psw" required>

        <button type="submit">Login</button>
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </body>
</html>
