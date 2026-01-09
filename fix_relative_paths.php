<?php
require 'db.php';

try {
    echo "Converting absolute paths to relative...<br>";

    // Convert 'http://localhost:8000/images/...' -> 'images/...'
    $sql = "UPDATE products SET image = REPLACE(image, 'http://localhost:8000/', '') WHERE image LIKE 'http://localhost:8000/%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    echo "Fixed localhost:8000 paths (Count: " . $stmt->rowCount() . ")<br>";

    // Also catch 'http://localhost/fucku/images/...' if any exist from previous scripts
    $sql2 = "UPDATE products SET image = REPLACE(image, 'http://localhost/fucku/', '') WHERE image LIKE 'http://localhost/fucku/%'";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();
    echo "Fixed localhost/fucku paths (Count: " . $stmt2->rowCount() . ")<br>";

    echo "All local paths converted to relative!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
