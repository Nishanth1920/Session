<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./session.css">
</head>
<body>
<div class="login-box">
 
  <form method="post" action="">
    <div class="user-box">
      <input type="text" name="username" required="">
      <label>Username</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="">
      <label>Password</label>
    </div><center>
    <button class="animated-button" name="login" >
  <span>Register</span>
  <span></span>
</button></center>
  </form>
</div>

<?php
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $myFile = "users.txt";
    $myFileLink = fopen($myFile, 'a');
    fwrite($myFileLink, " $username : $password\n");
    fclose($myFileLink);
}
?>

</body>
</html>