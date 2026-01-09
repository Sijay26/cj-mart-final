<?php
require 'db.php';

$imagesDir = __DIR__ . '/images';
if (!file_exists($imagesDir)) {
    mkdir($imagesDir, 0777, true);
}

function downloadImage($url, $savePath) {
    echo "Downloading $url to $savePath ... ";
    $ch = curl_init($url);
    $fp = fopen($savePath, 'wb');
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    // Mimic browser to avoid blocking
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $success = curl_exec($ch);
    $error = curl_error($ch);
    curl_close($ch);
    fclose($fp);
    
    if ($success) {
        echo "OK\n";
        return true;
    } else {
        echo "FAILED: $error\n";
        return false;
    }
}

$mobiles = [
    [
        'name' => 'Samsung Galaxy S24 Ultra',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/samsung-galaxy-s24-ultra-5g-sm-s928-stylus.jpg',
        'filename' => 's24_ultra.jpg'
    ],
    [
        'name' => 'Apple iPhone 15',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/apple-iphone-15.jpg',
        'filename' => 'iphone_15.jpg'
    ],
    [
        'name' => 'POCO X6 Pro 5G',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/xiaomi-poco-x6-pro.jpg',
        'filename' => 'poco_x6_pro.jpg'
    ],
    [
        'name' => 'OPPO Reno 11 Pro 5G',
        'url' => 'https://fdn2.gsmarena.com/vv/pics/oppo/oppo-reno11-pro-international-2.jpg',
        'filename' => 'reno_11_pro.jpg'
    ],
    [
        'name' => 'Realme 12 Pro+ 5G',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/realme-12-pro-plus.jpg',
        'filename' => 'realme_12_pro_plus.jpg'
    ],
    [
        'name' => 'Redmi Note 13 Pro+ 5G',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/xiaomi-redmi-note-13-pro-plus-int.jpg',
        'filename' => 'redmi_note_13_pro_plus.jpg'
    ],
    [
        'name' => 'Vivo X100',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/vivo-x100.jpg',
        'filename' => 'vivo_x100.jpg'
    ],
    [
        'name' => 'iQOO 12 5G',
        'url' => 'https://fdn2.gsmarena.com/vv/bigpic/vivo-iqoo12.jpg',
        'filename' => 'iqoo_12.jpg'
    ]
];

// Re-defining data to ensure we have the correct prices/desc as well if needed, 
// but here we just update images for existing entries created by previous script.
// Actually, it's safer to just UPDATE the image column where name matches.

foreach ($mobiles as $mobile) {
     $localPath = 'images/' . $mobile['filename'];
     $fullPath = $imagesDir . '/' . $mobile['filename'];
     
     if (downloadImage($mobile['url'], $fullPath)) {
         $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name LIKE ?");
         // usage of LIKE to match variations (e.g. '5G' suffix)
         $stmt->execute([$localPath, $mobile['name'] . '%']); 
         echo "Updated database for " . $mobile['name'] . "\n";
     }
}

echo "Done downloading and updating images.";
?>
