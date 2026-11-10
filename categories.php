<?php
require_once __DIR__ . '/includes/functions.php';

$pageTitle = 'FoodNest — Categories';
$currentPage = 'categories';

$selectedCategory = '';
if (isset($_GET['category'])) {
    $selectedCategory = (string) $_GET['category'];
}

$search = '';
if (isset($_GET['q'])) {
    $search = strtolower(trim((string) $_GET['q']));
}

$categories = [
    'Fish & seafood',
    'Meat',
    'Vegetables',
    'Fruits',
    'Flowers',
    'Oils & masalas'
];

$visibleProducts = [];

foreach ($products as $product) {
    $categoryMatches = ($selectedCategory === '');

    if ($product['category'] === $selectedCategory) {
        $categoryMatches = true;
    }

    $searchText = strtolower(
        $product['name'] . ' ' .
        $product['category'] . ' ' .
        $product['detail']
    );

    $searchMatches = ($search === '');

    if (strpos($searchText, $search) !== false) {
        $searchMatches = true;
    }

    if ($categoryMatches && $searchMatches) {
        $visibleProducts[] = $product;
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-heading">
    <p class="eyebrow">Find your ingredients</p>
    <h1>Shop categories</h1>
    <p>Choose fresh ingredients for your next meal.</p>
</section>

<div class="category-links">
    <a href="categories.php">All products</a>

    <?php foreach ($categories as $category) { ?>
        <a href="categories.php?category=<?php echo urlencode($category); ?>">
            <?php echo escapeHtml($category); ?>
        </a>
    <?php } ?>
</div>

<p class="result-count">
    Products found: <?php echo count($visibleProducts); ?>
</p>

<?php if (count($visibleProducts) === 0) { ?>

    <p>No products found. Try another category or search.</p>

<?php } else { ?>

    <div class="product-grid">
        <?php foreach ($visibleProducts as $product) { ?>
            <article class="product">
                <img
                    class="product-image"
                    src="<?php echo escapeHtml($product['image']); ?>"
                    alt="<?php echo escapeHtml($product['name']); ?>"
                >

                <div class="product-info">
                    <p><?php echo escapeHtml($product['category']); ?></p>
                    <h2><?php echo escapeHtml($product['name']); ?></h2>
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
                                Add to cart
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        <?php } ?>
    </div>

<?php } ?>

<?php
require_once __DIR__ . '/includes/footer.php';
?>