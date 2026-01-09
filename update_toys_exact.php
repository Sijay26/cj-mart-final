<?php
require 'db.php';

$toys = [
    'Teddy Bear' => 'https://images.unsplash.com/photo-1559454403-b8fb879ea276?q=80&w=600&auto=format&fit=crop',
    'Robot Toy' => 'https://images.unsplash.com/photo-1546776310-51d655abbce8?q=80&w=600&auto=format&fit=crop',
    'Toy Car' => 'https://images.unsplash.com/photo-1594787318286-3d835c1d207f?q=80&w=600&auto=format&fit=crop',
    'Building Blocks' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?q=80&w=600&auto=format&fit=crop',
    'Miniature Car' => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?q=80&w=600&auto=format&fit=crop',
    'Plush Toy' => 'https://images.unsplash.com/photo-1555454796-ee64605c6fd5?q=80&w=600&auto=format&fit=crop',
    'Action Figure' => 'https://images.unsplash.com/photo-1608889175123-8ee362201f81?q=80&w=600&auto=format&fit=crop',
    'Kids Kitchen Set' => 'https://images.unsplash.com/photo-1596464716127-f9a0639b964f?q=80&w=600&auto=format&fit=crop',
    'Giraffe Toy' => 'https://images.unsplash.com/photo-1535572290543-960a8046f5af?q=80&w=600&auto=format&fit=crop',
    'Wooden Train' => 'https://images.unsplash.com/photo-1599623560574-39d485900c95?q=80&w=600&auto=format&fit=crop'
];

try {
    foreach ($toys as $name => $url) {
        $stmt = $pdo->prepare("UPDATE products SET image = ? WHERE name = ? AND category = 'Toys'");
        $stmt->execute([$url, $name]);
        if ($stmt->rowCount() > 0) {
            echo "Updated Toy: $name<br>";
        } else {
            echo "Toy not found (or already updated): $name<br>";
        }
    }
    echo "Toys updated successfully.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
