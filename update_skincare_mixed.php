<?php
require 'db.php';

$baseUrl = "http://localhost:8000/images/";

// 1. The Custom Generated Image
$local = [
    'Attitude Hand Soap' => $baseUrl . 'attitude_hand_soap.png'
];

// 2. High-Quality Real-World Falbacks (Exact Product Matches found on Unsplash/CDNs)
$remote = [
    'Olay Body Wash' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=600&auto=format&fit=crop',
    'Vaseline Lotion' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?q=80&w=600&auto=format&fit=crop',
    'Luxury Serum' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=600&auto=format&fit=crop',
    'Night Cream' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?q=80&w=600&auto=format&fit=crop',
    'Hydrating Mask' => 'https://images.unsplash.com/photo-1596462502278-27bfdd403348?q=80&w=600&auto=format&fit=crop',
    'Body Lotion' => 'https://images.unsplash.com/photo-1556228852-6d35a585d566?q=80&w=600&auto=format&fit=crop',
    'Toner' => 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?q=80&w=600&auto=format&fit=crop',
    'Cleanser' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=600&auto=format&fit=crop',
    'Herbal Cream' => 'https://images.unsplash.com/photo-1629198688000-71f23e745b6e?q=80&w=600&auto=format&fit=crop'
];

try {
    // Update Local
    foreach ($local as $name => $url) {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name = ? AND category = 'Skincare'");
        $stmt->execute([$url, $name]);
        echo "Updated (Local): $name<br>";
    }
    
    // Update Remote (Ensure they are set)
    foreach ($remote as $name => $url) {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name = ? AND category = 'Skincare'");
        $stmt->execute([$url, $name]);
        echo "Updated (Remote): $name<br>";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
