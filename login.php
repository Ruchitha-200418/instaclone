<?php
require 'config.php';

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $stmt = $pdo->prepare('SELECT * FROM users WHERE username=?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();
  if($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    if($user['role']=='SuperAdmin') header('Location: superadmin_dashboard.php');
    else if($user['role']=='Admin') header('Location: admin_dashboard.php');
    else header('Location: user_dashboard.php');
    exit;
  } else {
    $error = "Invalid credentials";
  }
}
?>
<link rel="stylesheet" href="style.css">
<div class="center">
  <img src="instalogo.jpg" style="width:90px;">
  <form method="post">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button name="login">Login</button>
    <div><?php if(isset($error)) echo $error; ?></div>
  </form>
</div>