<?php
require 'config.php';
if($_SESSION['role']!=='Admin') exit("Access Denied");

if(isset($_GET['approve'])){
  $post_id = $_GET['approve'];
  $pdo->prepare("UPDATE posts SET status='approved' WHERE id=?")->execute([$post_id]);
  $pdo->prepare("INSERT INTO activity_logs (user_id, action, target_type, target_id) VALUES (?, 'approve', 'post', ?)")->execute([$_SESSION['user_id'], $post_id]);
  header('Location: admin_dashboard.php');
  exit;
}

$stmt = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id=users.id WHERE status='pending'");
$pending = $stmt->fetchAll();
?>
<h1>Pending Posts</h1>
<table>
<tr><th>User</th><th>Image</th><th>Caption</th><th>Action</th></tr>
<?php foreach($pending as $row): ?>
<tr>
  <td><?=htmlspecialchars($row['username'])?></td>
  <td><img src="uploads/<?=$row['image']?>" width="50"></td>
  <td><?=htmlspecialchars($row['caption'])?></td>
  <td><a href="?approve=<?=$row['id']?>">Approve</a></td>
</tr>
<?php endforeach; ?>
</table>
<a href="activity_log.php">View All User Activity</a>