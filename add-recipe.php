<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/recipes-data.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: recipes.php');
    exit;
}

$recipeId = '';

if (isset($_POST['recipe_id'])) {
    $recipeId = (string) $_POST['recipe_id'];
}

if (!isset($recipes[$recipeId])) {
    header('Location: recipes.php');
    exit;
}

foreach ($recipes[$recipeId]['ingredients'] as $productId => $quantity) {
    if (productById($productId) !== null) {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }

        $_SESSION['cart'][$productId] += (int) $quantity;
    }
}

header('Location: cart.php');
exit;
?>