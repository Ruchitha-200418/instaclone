<?php
require 'config.php';
if(!in_array($_SESSION['role'], ['SuperAdmin','Admin'])) exit("Access Denied");

$stmt = $pdo->query("SELECT l.*, u.username FROM activity_logs l JOIN users u ON l.user_id=u.id ORDER BY activity_time DESC");
echo "<table><tr><th>User</th><th>Action</th><th>Type</th><th>ID</th><th>At</th></tr>";
foreach($stmt as $log) {
    echo "<tr><td>".htmlspecialchars($log['username'])."</td><td>{$log['action']}</td><td>{$log['target_type']}</td><td>{$log['target_id']}</td><td>{$log['activity_time']}</td></tr>";
}
echo "</table>";
?>