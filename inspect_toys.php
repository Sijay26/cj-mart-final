<?php
require 'db.php';
$stmt = $pdo->query("SELECT id, name, image FROM products WHERE category = 'Toys'");
$toys = $stmt->fetchAll(PDO::FETCH_ASSOC);

$results = [];
foreach ($toys as $t) {
    // Check if image is empty
    if (empty($t['image'])) {
        $status = "EMPTY";
    } else {
        // Check if 404
        $headers = @get_headers($t['image']);
        if ($headers && strpos($headers[0], '200')) {
            $status = "OK";
        } else {
            $status = "BROKEN";
        }
    }
    $results[] = [
        'name' => $t['name'],
        'image' => $t['image'],
        'status' => $status
    ];
}
echo json_encode($results, JSON_PRETTY_PRINT);
?>
