<?php
require 'db.php';

function checkImage($url) {
    if (empty($url)) return false;
    // Simple check: is it a valid URL format?
    if (!filter_var($url, FILTER_VALIDATE_URL)) return false;
    
    // Check headers for 200 OK
    $headers = @get_headers($url);
    return $headers && strpos($headers[0], '200');
}

$stmt = $pdo->query("SELECT id, category, name, image FROM products");
$products = $stmt->fetchAll();

$broken = [];
foreach ($products as $p) {
    if (!checkImage($p['image'])) {
        $broken[] = [
            'id' => $p['id'],
            'category' => $p['category'],
            'name' => $p['name'],
            'image' => $p['image']
        ];
    }
}

echo json_encode($broken, JSON_PRETTY_PRINT);
?>
