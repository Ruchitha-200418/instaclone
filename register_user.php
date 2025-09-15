<?php
require 'config.php';
if(!in_array($_SESSION['role'], ['SuperAdmin','Admin'])) exit("Access Denied");
if(isset($_POST['register'])){
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];
  $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
  $stmt->execute([$username, $password, $role]);
  echo "User created!";
}
?>
<form method="post">
  <input name="username" required>
  <input name="password" type="password" required>
  <select name="role">
    <option>User</option>
    <option>Admin</option>
    <option>SuperAdmin</option>
  </select>
  <button name="register">Create User</button>
</form>