<?php
// Plaintext password to hash
$password = "admin@123";

// Generate the hashed password using bcrypt
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Output the hashed password
echo "Hashed password: " . $hashedPassword;
?>