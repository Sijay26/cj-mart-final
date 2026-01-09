<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'header.php'; ?>

<div class="hero">
    <h1>Smart Shopping, Colorful Living</h1>
    <p>Discover the best products at unbeatable prices.</p>
</div>

<h2 class="section-title">Shop by Category</h2>

<div class="categories">
    <a href="products.php?category=Dresses" class="category-card">
        <span class="category-icon">👗</span>
        <h3>Dresses</h3>
    </a>
    <a href="products.php?category=Mobiles" class="category-card">
        <span class="category-icon">📱</span>
        <h3>Mobiles</h3>
    </a>
    <a href="products.php?category=Skincare" class="category-card">
        <span class="category-icon">🧴</span>
        <h3>Skincare</h3>
    </a>
    <a href="products.php?category=Toys" class="category-card">
        <span class="category-icon">🧸</span>
        <h3>Toys</h3>
    </a>
    <a href="products.php?category=Grocery" class="category-card">
        <span class="category-icon">🛒</span>
        <h3>Grocery</h3>
    </a>
</div>

<div style="margin-top: 50px; text-align: center;">
    <img src="cj_mart_logo.png" style="width: 100px; opacity: 0.5;">
</div>

<?php require 'footer.php'; ?>
