<?php
require 'config.php';
if($_SESSION['role']!=='User') exit("Access Denied");

if(isset($_POST['save'])){
  $caption = $_POST['caption'];
  $img = $_FILES['image'];
  $name = time().'_'.$img['name'];
  move_uploaded_file($img['tmp_name'], "uploads/$name");
  $pdo->prepare("INSERT INTO posts (user_id, image, caption) VALUES (?, ?, ?)")->execute([$_SESSION['user_id'], $name, $caption]);
  $pdo->prepare("INSERT INTO activity_logs (user_id, action, target_type, target_id) VALUES (?, 'create', 'post', LAST_INSERT_ID())")->execute([$_SESSION['user_id']]);
  header('Location: user_dashboard.php');
  exit;
}
?>
<form method="post" enctype="multipart/form-data">
  <input type="file" name="image" required>
  <textarea name="caption" required></textarea>
  <button name="save">Post</button>
</form>