<?php
require 'db.php';

$baseUrl = "http://localhost:8000/images/";

$dresses = [
    'Classic White Shirt' => $baseUrl . 'white_shirt.png',
    'Blue Denim Jeans' => $baseUrl . 'blue_jeans.png',
    'Traditional Kurti' => $baseUrl . 'kurti.png',
    'Salwar Kameez Set' => $baseUrl . 'salwar_kameez.png',
    'Silk Saree' => $baseUrl . 'silk_saree.png',
    'Casual T-Shirt' => $baseUrl . 'casual_tshirt.png',
    'Denim Shorts' => $baseUrl . 'denim_shorts.png',
    'Black Velvet Dress' => $baseUrl . 'black_velvet_dress.png',
    'Leather Skirt' => $baseUrl . 'leather_skirt.png',
    'Designer Summer Dress' => $baseUrl . 'summer_dress.png'
];

try {
    foreach ($dresses as $name => $url) {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name = ? AND category = 'Dresses'");
        $stmt->execute([$url, $name]);
        if ($stmt->rowCount() > 0) {
            echo "Updated Dress: $name<br>";
        } else {
            echo "Dress not found (or already updated): $name<br>";
        }
    }
    echo "Dresses updated successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
