<?php
if (!isset($pageTitle)) {
    $pageTitle = 'FoodNest';
}

if (!isset($currentPage)) {
    $currentPage = '';
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo escapeHtml($pageTitle); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="announcement">
        Fresh picks, delivered to your kitchen · Free delivery over ₹999
    </div>

    <header class="site-header">
        <a class="brand" href="index.php">FoodNest</a>

        <form class="search" action="categories.php" method="get">
            <input
                type="search"
                name="q"
                placeholder="Search products..."
                aria-label="Search products"
            >
            <button type="submit">Search</button>
        </form>

        <a class="cart-link" href="cart.php">
            Cart (<?php echo cartCount(); ?>)
        </a>
    </header>

    <nav class="navigation">
        <a href="index.php">Home</a>
        <a href="categories.php">Categories</a>
        <a href="recipes.php">Cook Tonight</a>
        <a href="cart.php">Cart</a>
    </nav>

    <main class="container">