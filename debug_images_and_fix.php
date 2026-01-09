<?php
require 'db.php';

$imagesDir = __DIR__ . '/images';

// 1. Check file validity
echo "Checking image files in $imagesDir:\n";
$files = scandir($imagesDir);
foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    $path = $imagesDir . '/' . $file;
    $content = file_get_contents($path);
    $header = substr($content, 0, 20);
    echo "  $file: Size " . strlen($content) . " bytes. ";
    
    // Check for HTML (bad download)
    if (strpos($header, '<!DOCTYPE html') !== false || strpos($header, '<html') !== false) {
        echo "[ERROR] File contains HTML (likely 403/404 page). Deleting.\n";
        unlink($path);
    } else {
        echo "[OK] Looks like binary data.\n";
    }
}

// 2. Fix Database Product Names and Paths
echo "\nFixing Database Entries...\n";

// Map of intended Product Name -> Local Filename
$fixes = [
    'Samsung Galaxy S24 Ultra' => 's24_ultra.jpg',
    'Samsung Galaxy S23' => 's24_ultra.jpg', // Fix the S23 -> S24 Ultra rename if needed
    'Apple iPhone 15' => 'iphone_15.jpg',
    'POCO X6 Pro 5G' => 'poco_x6_pro.jpg',
    'OPPO Reno 11 Pro 5G' => 'reno_11_pro.jpg',
    'Realme 12 Pro+ 5G' => 'realme_12_pro_plus.jpg',
    'Redmi Note 13 Pro+ 5G' => 'redmi_note_13_pro_plus.jpg',
    'Vivo X100' => 'vivo_x100.jpg',
    'iQOO 12 5G' => 'iqoo_12.jpg'
];

foreach ($fixes as $dbName => $filename) {
    // Check if product exists with this name (exact or partial)
    // We treat 'Samsung Galaxy S23' specially to rename it to S24 Ultra
    if ($dbName === 'Samsung Galaxy S23') {
        $stmt = $pdo->prepare("UPDATE products SET name = 'Samsung Galaxy S24 Ultra', image = ? WHERE name LIKE 'Samsung Galaxy S23%'");
        $stmt->execute(['images/' . $filename]);
        if ($stmt->rowCount() > 0) echo "  Renamed S23 to S24 Ultra and updated image.\n";
    } else {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name LIKE ?");
        $stmt->execute(['images/' . $filename, $dbName . '%']);
        if ($stmt->rowCount() > 0) echo "  Updated image for $dbName.\n";
    }
}

// 3. List current DB State
echo "\nCurrent Database State (Mobiles):\n";
$stmt = $pdo->query("SELECT id, name, image FROM products WHERE category = 'Mobiles'");
while ($row = $stmt->fetch()) {
    echo "  ID {$row['id']}: {$row['name']} -> {$row['image']}\n";
}
?>
