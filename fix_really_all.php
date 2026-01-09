<?php
require 'db.php';

// Base URL for local images (assuming running on port 8000 from root)
$baseUrl = "http://localhost:8000/images/";

// 1. Precise Map of "Known" Products to "Good" Images
$imageMap = [
    // MOBILES (Local)
    'iPhone 15' => $baseUrl . 'iphone_15.png',
    'Samsung Galaxy S24 Ultra' => $baseUrl . 'samsung_s24_ultra.png',
    'POCO X6 Pro' => $baseUrl . 'poco_x6_pro.png',
    'OPPO Reno 11 Pro' => $baseUrl . 'oppo_reno_11_pro.png',
    'Realme 12 Pro Plus' => $baseUrl . 'realme_12_pro_plus.png',
    'Redmi Note 13 Pro Plus' => $baseUrl . 'redmi_note_13_pro_plus.png',
    'Vivo X100' => $baseUrl . 'vivo_x100.png',
    'iQOO 12' => $baseUrl . 'iqoo_12.png',
    'Realme X' => $baseUrl . 'realme_x.png',
    'Samsung Galaxy S8' => $baseUrl . 'samsung_s8.png',

    // TOYS (Unsplash - Tested)
    'Teddy Bear' => 'https://plus.unsplash.com/premium_photo-1664112065837-56543b3afe56?q=80&w=600&auto=format&fit=crop',
    'Robot Toy' => 'https://images.unsplash.com/photo-1560167016-01582e2feac3?q=80&w=600&auto=format&fit=crop',
    'Toy Car' => 'https://images.unsplash.com/photo-1594787318286-3d835c1d207f?q=80&w=600&auto=format&fit=crop',
    'Building Blocks' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=600&auto=format&fit=crop',
    'Miniature Car' => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?q=80&w=600&auto=format&fit=crop',
    'Plush Toy' => 'https://images.unsplash.com/photo-1559715541-5df4056dc084?q=80&w=600&auto=format&fit=crop',
    'Action Figure' => 'https://images.unsplash.com/photo-1608889175123-8ee362201f81?q=80&w=600&auto=format&fit=crop',
    'Kids Kitchen Set' => 'https://images.unsplash.com/photo-1596464716127-f9a0639b964f?q=80&w=600&auto=format&fit=crop',
    'Giraffe Toy' => 'https://images.unsplash.com/photo-1535572290543-960a8046f5af?q=80&w=600&auto=format&fit=crop',
    'Wooden Train' => 'https://images.unsplash.com/photo-1599623560574-39d485900c95?q=80&w=600&auto=format&fit=crop',

    // SKINCARE (Unsplash - Tested)
    'Attitude Hand Soap' => 'https://images.unsplash.com/photo-1556228720-1957be83f360?q=80&w=600&auto=format&fit=crop',
    'Olay Body Wash' => 'https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=600&auto=format&fit=crop',
    'Vaseline Lotion' => 'https://images.unsplash.com/photo-1608248597279-f99d160bfbc8?q=80&w=600&auto=format&fit=crop',
    'Luxury Serum' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?q=80&w=600&auto=format&fit=crop',
    'Night Cream' => 'https://images.unsplash.com/photo-1611930022073-b7a4ba5fcccd?q=80&w=600&auto=format&fit=crop',
    'Hydrating Mask' => 'https://images.unsplash.com/photo-1596462502278-27bfdd403348?q=80&w=600&auto=format&fit=crop',
    'Body Lotion' => 'https://images.unsplash.com/photo-1556228852-6d35a585d566?q=80&w=600&auto=format&fit=crop',
    'Toner' => 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?q=80&w=600&auto=format&fit=crop',
    'Cleanser' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=600&auto=format&fit=crop',
    'Herbal Cream' => 'https://images.unsplash.com/photo-1629198688000-71f23e745b6e?q=80&w=600&auto=format&fit=crop',

    // GROCERY (Unsplash - Tested)
    'Fresh Apple' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?q=80&w=600&auto=format&fit=crop',
    'Banana Bunch' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?q=80&w=600&auto=format&fit=crop',
    'Whole Milk' => 'https://images.unsplash.com/photo-1563636619-e9143da7973b?q=80&w=600&auto=format&fit=crop',
    'Brown Eggs' => 'https://images.unsplash.com/photo-1516919549054-e08258825f80?q=80&w=600&auto=format&fit=crop',
    'Cheddar Cheese' => 'https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?q=80&w=600&auto=format&fit=crop',
    'Whole Wheat Bread' => 'https://images.unsplash.com/photo-1549931319-a545dcf3bc73?q=80&w=600&auto=format&fit=crop',
    'Basmati Rice' => 'https://images.unsplash.com/photo-1586201375761-83865001e31c?q=80&w=600&auto=format&fit=crop',
    'Orange Juice' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?q=80&w=600&auto=format&fit=crop',
    'Ground Coffee' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=600&auto=format&fit=crop',
    'Green Tea' => 'https://images.unsplash.com/photo-1627435601361-ec2548a1ef0f?q=80&w=600&auto=format&fit=crop'
];

// Fallback images per category (User wanted "Real" images, so using Unsplash generic)
$fallbacks = [
    'Dresses' => 'https://images.unsplash.com/photo-1539008835657-9e8e9680c956?q=80&w=600&auto=format&fit=crop',
    'Toys' => 'https://images.unsplash.com/photo-1558060370-d644479cb673?q=80&w=600&auto=format&fit=crop',
    'Skincare' => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?q=80&w=600&auto=format&fit=crop',
    'Grocery' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=600&auto=format&fit=crop',
    'Mobiles' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=600&auto=format&fit=crop'
];

try {
    echo "Starting aggressive image fix...<br>";
    
    // Get ALL products
    $all = $pdo->query("SELECT id, name, category, image FROM products")->fetchAll();
    
    foreach ($all as $p) {
        $newName = $p['name'];
        $newCat = $p['category'];
        $newImg = $p['image'];
        $needsUpdate = false;
        
        // 1. Is this a known product?
        if (isset($imageMap[$newName])) {
            // Apply exact known image
            if ($newImg !== $imageMap[$newName]) {
                $newImg = $imageMap[$newName];
                $needsUpdate = true;
                echo "Resetting $newName to Known Exact Image.<br>";
            }
        } 
        // 2. Is this NOT a known product, but in a target category?
        // We check if it has a potentially Broken URL (e.g. DummyJSON or random short string)
        // OR simply force fallback if we are paranoid (User said "No Missing Images").
        else if (isset($fallbacks[$newCat])) {
               // If it's a "leftover" product not in our list, use a safe fallback
               // But retain reliable Dresses from dummyjson if they were working?
               // Actually, user complained about "missing images". Safest bet is to Fallback if we aren't 100% sure.
               // Let's fallback if the current URL contains 'dummyjson' (which was unstable for user) OR is empty.
               if (empty($newImg) || strpos($newImg, 'dummyjson') !== false || strlen($newImg) < 10) {
                   $newImg = $fallbacks[$newCat];
                   $needsUpdate = true;
                   echo "Fallback applied for unknown product: $newName ($newCat).<br>";
               }
        }

        if ($needsUpdate) {
            $upd = $pdo->prepare("UPDATE products SET image = ? WHERE id = ?");
            $upd->execute([$newImg, $p['id']]);
        }
    }
    
    echo "Scan complete. All products should now have valid images.";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
