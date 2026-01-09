<?php
require 'db.php';
$stmt = $pdo->query("SELECT name, description FROM products WHERE category = 'Dresses'");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>
