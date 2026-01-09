<?php
require 'db.php';
$stmt = $pdo->query("SELECT id, category, name, image FROM products ORDER BY category");
echo json_encode($stmt->fetchAll(), JSON_PRETTY_PRINT);
?>
