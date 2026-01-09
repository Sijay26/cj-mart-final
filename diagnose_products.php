<?php
require 'db.php';

function checkImage($url) {
    if (empty($url)) return false;
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200');
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY category, id");
$products = $stmt->fetchAll();

$results = [];
foreach ($products as $product) {
    $category = $product['category'];
    if (!isset($results[$category])) {
        $results[$category] = [];
    }
    
    $status = checkImage($product['image']) ? 'OK' : 'BROKEN';
    
    $results[$category][] = [
        'id' => $product['id'],
        'name' => $product['name'],
        'image' => $product['image'],
        'status' => $status
    ];
}

echo json_encode($results, JSON_PRETTY_PRINT);
?>
