<?php
require 'config.php';
if($_SESSION['role']!=='User') exit("Access Denied");

$stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id=? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll();
?>
<a href="create_post.php">+ Create New Post</a>
<table>
  <tr><th>Image</th><th>Caption</th><th>Status</th><th>Actions</th></tr>
  <?php foreach($posts as $post): ?>
    <tr>
      <td><img src="uploads/<?=htmlspecialchars($post['image'])?>" width="50"></td>
      <td><?=htmlspecialchars($post['caption'])?></td>
      <td><?=$post['status']?></td>
      <td>
        <a href="edit_post.php?id=<?=$post['id']?>">Edit</a>
        <a href="delete_post.php?id=<?=$post['id']?>">Delete</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>