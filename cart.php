<?php
require_once __DIR__ . '/includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = '';
    if (isset($_POST['action'])) {
        $action = (string) $_POST['action'];
    }

    $productId = '';
    if (isset($_POST['product_id'])) {
        $productId = (string) $_POST['product_id'];
    }

    if ($action === 'add' && productById($productId) !== null) {
        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = 0;
        }

        $_SESSION['cart'][$productId]++;
    }

    if ($action === 'remove') {
        unset($_SESSION['cart'][$productId]);
    }

    if ($action === 'update' && productById($productId) !== null) {
        $quantity = (int) $_POST['quantity'];

        if ($quantity < 1) {
            $quantity = 1;
        }

        if ($quantity > 99) {
            $quantity = 99;
        }

        $_SESSION['cart'][$productId] = $quantity;
    }

    header('Location: cart.php');
    exit;
}

$pageTitle = 'FoodNest — Cart';
$currentPage = 'cart';

require_once __DIR__ . '/includes/header.php';

$subtotal = cartSubtotal();
$delivery = deliveryFee();
?>

<section class="page-heading">
    <p class="eyebrow">Your basket</p>
    <h1>Shopping cart</h1>
</section>

<?php if (cartCount() === 0) { ?>

    <p>Your cart is empty.</p>
    <a class="button" href="categories.php">Shop categories</a>

<?php } else { ?>

    <section class="cart-items">
        <?php foreach ($_SESSION['cart'] as $productId => $quantity) { ?>
            <?php
            $product = productById($productId);

            if ($product === null) {
                continue;
            }

            $lineTotal = $product['price'] * (int) $quantity;
            ?>

            <article class="cart-item">
                <img
                    src="<?php echo escapeHtml($product['image']); ?>"
                    alt="<?php echo escapeHtml($product['name']); ?>"
                >

                <div>
                    <h2><?php echo escapeHtml($product['name']); ?></h2>
                    <p><?php echo escapeHtml($product['detail']); ?></p>

                    <form action="cart.php" method="post">
                        <input
                            type="hidden"
                            name="product_id"
                            value="<?php echo escapeHtml($productId); ?>"
                        >

                        <label>
                            Quantity
                            <input
                                type="number"
                                name="quantity"
                                min="1"
                                max="99"
                                value="<?php echo (int) $quantity; ?>"
                            >
                        </label>

                        <button type="submit" name="action" value="update">
                            Update
                        </button>

                        <button
                            type="submit"
                            name="action"
                            value="remove"
                            data-confirm="Remove this product from your cart?"
                        >
                            Remove
                        </button>
                    </form>
                </div>

                <strong>₹<?php echo number_format($lineTotal); ?></strong>
            </article>
        <?php } ?>
    </section>

    <section class="order-summary">
        <h2>Order summary</h2>
        <p>Subtotal: ₹<?php echo number_format($subtotal); ?></p>

        <?php if ($delivery === 0) { ?>
            <p>Delivery: Free</p>
        <?php } else { ?>
            <p>Delivery: ₹<?php echo number_format($delivery); ?></p>
        <?php } ?>

        <p><strong>Total: ₹<?php echo number_format($subtotal + $delivery); ?></strong></p>
        <a class="button" href="register.php">Continue to registration</a>
    </section>

<?php } ?>

<?php
require_once __DIR__ . '/includes/footer.php';
?>