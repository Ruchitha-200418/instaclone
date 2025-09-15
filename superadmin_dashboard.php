<?php
require 'config.php';
if($_SESSION['role']!=='SuperAdmin') exit("Access Denied");
echo "<h1>Super Admin Dashboard</h1>";
echo '<a href="register_user.php">Create User</a> | <a href="activity_log.php">View Activity Logs</a>';
?>