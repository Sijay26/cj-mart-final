<?php
require 'db.php';

try {
    // 1. Delete existing mobiles
    $stmt = $pdo->prepare("DELETE FROM products WHERE category = 'Mobiles'");
    $stmt->execute();
    echo "Deleted old mobile products.\n";

    // 2. Insert new specific mobiles
    // Using Flipkart/Amazon/Official/Wikimedia CDNs for stability
    $mobiles = [
        [
            'category' => 'Mobiles',
            'name' => 'Samsung Galaxy S23',
            'price' => 54999.00,
            'description' => 'Snapdragon 8 Gen 2, 50MP Camera.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/1/i/x/-original-imagmg6gz4ahgh8p.jpeg',
            'rating' => 4.5
        ],
        [
            'category' => 'Mobiles',
            'name' => 'Apple iPhone 15',
            'price' => 70999.00,
            'description' => 'Dynamic Island, 48MP Main Camera.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/h/d/9/-original-imagtc2qzgnn8038.jpeg',
            'rating' => 4.7
        ],
        [
            'category' => 'Mobiles',
            'name' => 'POCO X6 Pro 5G',
            'price' => 26999.00,
            'description' => 'Dimensity 8300 Ultra, 67W Turbo Charging.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/y/e/2/-original-imagw65gyq6gzh.jpeg', // Verified pattern
            'rating' => 4.3
        ],
        [
            'category' => 'Mobiles',
            'name' => 'OPPO Reno 11 Pro 5G',
            'price' => 39999.00,
            'description' => 'Portrait Expert, MediaTek Dimensity 8200.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/x/v/4/-original-imagxhd5gqgqhqsz.jpeg',
            'rating' => 4.4
        ],
        [
            'category' => 'Mobiles',
            'name' => 'Realme 12 Pro+ 5G',
            'price' => 29999.00,
            'description' => 'Periscope Portrait Camera, Luxury Watch Design.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/r/q/e/-original-imagx69d2f2k2z2.jpeg',
            'rating' => 4.5
        ],
        [
            'category' => 'Mobiles',
            'name' => 'Redmi Note 13 Pro+ 5G',
            'price' => 31999.00,
            'description' => '200MP Main Camera, 120W HyperCharge.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/u/5/f/-original-imagwu894ygz9h6.jpeg',
            'rating' => 4.2
        ],
        [
            'category' => 'Mobiles',
            'name' => 'Vivo X100',
            'price' => 63999.00,
            'description' => 'ZEISS Co-engineered Camera, Dimensity 9300.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/w/s/y/-original-imagwzy6s28zhg8.jpeg',
            'rating' => 4.6
        ],
        [
            'category' => 'Mobiles',
            'name' => 'iQOO 12 5G',
            'price' => 52999.00,
            'description' => 'Snapdragon 8 Gen 3, Q1 Chip.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/9/e/3/-original-imagwxu4kzga6h32.jpeg',
            'rating' => 4.8
        ],
        [
            'category' => 'Mobiles',
            'name' => 'Samsung Galaxy S24 Ultra',
            'price' => 129999.00,
            'description' => 'Galaxy AI, Titanium Frame, 200MP.',
            'image' => 'https://rukminim2.flixcart.com/image/416/416/xif0q/mobile/5/i/7/-original-imagxtnqs44hgg5.jpeg',
            'rating' => 4.9
        ]
    ];

    $stmt = $pdo->prepare("INSERT INTO products (category, name, price, description, image, rating) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($mobiles as $mobile) {
        $stmt->execute([
            $mobile['category'],
            $mobile['name'],
            $mobile['price'],
            $mobile['description'],
            $mobile['image'],
            $mobile['rating']
        ]);
        echo "Inserted: " . $mobile['name'] . "\n";
    }

    echo "Successfully updated mobile products!";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
