<?php
require 'db.php';

$sql = file_get_contents('schema.sql');

try {
    $pdo->exec($sql);
    echo "Database and tables created successfully with sample data!";
} catch (PDOException $e) {
    echo "Error creating database: " . $e->getMessage();
}
?>
