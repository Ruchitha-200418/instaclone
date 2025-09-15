<?php
// generate_hash.php
if (PHP_SAPI === 'cli') {
    // CLI usage: php generate_hash.php YourPlainPassword
    $plain = $argv[1] ?? null;
} else {
    // Web usage: visit generate_hash.php?pw=YourPlainPassword
    $plain = $_GET['pw'] ?? null;
}

if (!$plain) {
    echo "Usage (CLI): php generate_hash.php YourPlainPassword\n";
    echo "Usage (Web): /generate_hash.php?pw=admin@123\n";
    exit;
}

$hash = password_hash($plain, PASSWORD_DEFAULT);
echo "Plain: " . htmlspecialchars($plain) . PHP_EOL;
echo "Hash : " . $hash . PHP_EOL;
