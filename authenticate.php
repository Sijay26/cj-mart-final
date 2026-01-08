<?php
session_start();
require 'db.php';

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'register') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        if (strlen($password) < 6) {
            die("Password must be at least 6 characters.");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);
            
            // Redirect to Login on success
            header("Location: login.php?msg=registered");
            exit;
            
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Integrity constraint violation (duplicate entry)
                header("Location: register.php?error=exists");
            } else {
                echo "Error: " . $e->getMessage();
            }
        }
    } 
    elseif ($action === 'login') {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Storing username
            header("Location: index.php");
            exit;
        } else {
            header("Location: login.php?error=invalid");
            exit;
        }
    }
}

if ($action === 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
