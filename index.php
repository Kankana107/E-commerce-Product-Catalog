<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'FoodNest — Home';
$currentPage = 'home';

require_once __DIR__ . '/includes/header.php';

$categories = [
    'Fish & seafood',
    'Meat',
    'Vegetables',
    'Fruits',
    'Flowers',
    'Oils & masalas'
];
?>

<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Good food starts here</p>
        <h1>Fresh from the source, to your table.</h1>
        <p>Shop fresh vegetables, fish, chicken, fruits, flowers, and pantry essentials.</p>
        <a class="button" href="categories.php">Shop products</a>
    </div>

    <div class="hero-photo" role="img" aria-label="Fresh green vegetables"></div>
</section>

<section class="section">
    <h2>Shop by category</h2>

    <div class="category-links">
        <?php foreach ($categories as $category) { ?>
            <a href="categories.php?category=<?php echo urlencode($category); ?>">
                <?php echo escapeHtml($category); ?>

                <?php if ($category === 'Oils & masalas') { ?>
                <?php } ?>
            </a>
        <?php } ?>
    </div>
</section>

<section class="section">
    <h2>Popular products</h2>

    <div class="product-grid">
        <?php foreach (array_slice($products, 0, 6) as $product) { ?>
            <article class="product">
                <img
                    class="product-image"
                    src="<?php echo escapeHtml($product['image']); ?>"
                    alt="<?php echo escapeHtml($product['name']); ?>"
                >

                <div class="product-info">
                    <p><?php echo escapeHtml($product['category']); ?></p>
                    <h3><?php echo escapeHtml($product['name']); ?></h3>
                    <p><?php echo escapeHtml($product['detail']); ?></p>

                    <div class="product-bottom">
                        <strong>₹<?php echo number_format($product['price']); ?></strong>

                        <form action="cart.php" method="post">
                            <input type="hidden" name="action" value="add">
                            <input
                                type="hidden"
                                name="product_id"
                                value="<?php echo escapeHtml($product['id']); ?>"
                            >
                            <button class="button small-button" type="submit">
                                Add
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>