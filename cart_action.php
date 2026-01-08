<?php
session_start();
require 'db.php';

$action = $_POST['action'] ?? $_GET['action'] ?? '';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($action === 'add') {
    $product_id = $_POST['product_id'];
    
    // Check if product exists in cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]++;
    } else {
        $_SESSION['cart'][$product_id] = 1;
    }
    
    // If logged in, sync with DB (Optional enhancement, sticking to session for simplicity as per quick dev)
    // But requirement says "Cart table: user_id, product_id, quantity".
    // So if logged in, we should save to DB.
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $stmt = $pdo->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$user_id, $product_id]);
        $cartItem = $stmt->fetch();
        
        if ($cartItem) {
            $pdo->prepare("UPDATE cart SET quantity = quantity + 1 WHERE id = ?")->execute([$cartItem['id']]);
        } else {
            $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)")->execute([$user_id, $product_id]);
        }
    }
    
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
}

if ($action === 'remove') {
    $product_id = $_POST['product_id']; // or GET
    
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?")->execute([$user_id, $product_id]);
    }
    
    header("Location: cart.php");
    exit;
}

if ($action === 'update') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    if ($quantity > 0) {
        $_SESSION['cart'][$product_id] = $quantity;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $pdo->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?")->execute([$quantity, $user_id, $product_id]);
        }
    } else {
        // remove
        unset($_SESSION['cart'][$product_id]);
         if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $pdo->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?")->execute([$user_id, $product_id]);
        }
    }
    
    header("Location: cart.php");
    exit;
}
?>
