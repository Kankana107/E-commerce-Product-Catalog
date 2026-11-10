<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/recipes-data.php';

$pageTitle = 'FoodNest — Cook Tonight';
$currentPage = 'recipes';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-heading">
    <p class="eyebrow">Simple meal ideas</p>
    <h1>Cook Tonight</h1>
    <p>Choose a recipe and add all its ingredients to your cart.</p>
</section>

<div class="product-grid">
    <?php foreach ($recipes as $recipeId => $recipe) { ?>
        <?php
        $ingredientNames = [];

        foreach ($recipe['ingredients'] as $productId => $quantity) {
            $product = productById($productId);

            if ($product !== null) {
                $ingredientNames[] = $product['name'];
            }
        }
        ?>

        <article class="product">
            <img
                class="product-image"
                src="<?php echo escapeHtml($recipe['image']); ?>"
                alt="<?php echo escapeHtml($recipe['name']); ?>"
            >

            <div class="product-info">
                <p class="product-category">Cook Tonight</p>
                <h2><?php echo escapeHtml($recipe['name']); ?></h2>
                <p><?php echo escapeHtml($recipe['description']); ?></p>
                <p>
                    Serves <?php echo (int) $recipe['servings']; ?>
                    · <?php echo escapeHtml($recipe['time']); ?>
                </p>
                <p>
                    <strong>Ingredients:</strong>
                    <?php echo escapeHtml(implode(', ', $ingredientNames)); ?>
                </p>

                <form action="add-recipe.php" method="post">
                    <input
                        type="hidden"
                        name="recipe_id"
                        value="<?php echo escapeHtml($recipeId); ?>"
                    >
                    <button class="button small-button" type="submit">
                        Add all ingredients
                    </button>
                </form>
            </div>
        </article>
    <?php } ?>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>