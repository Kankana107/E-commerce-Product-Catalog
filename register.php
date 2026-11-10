<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/database.php';

$name = '';
$phone = '';
$address = '';
$errors = [];
$registered = false;
$orderId = 0;
$orderTotal = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name'])) {
        $name = trim((string) $_POST['name']);
    }

    if (isset($_POST['phone'])) {
        $phone = trim((string) $_POST['phone']);
    }

    if (isset($_POST['address'])) {
        $address = trim((string) $_POST['address']);
    }

    if ($name === '') {
        $errors[] = 'Please enter your name.';
    }

    if (!preg_match('/^[0-9+() -]{8,16}$/', $phone)) {
        $errors[] = 'Please enter a valid phone number.';
    }

    if ($address === '') {
        $errors[] = 'Please enter your delivery address.';
    }

    if (cartCount() === 0) {
        $errors[] = 'Your cart is empty. Add products before registering.';
    }

    if (count($errors) === 0) {
        try {
            $pdo->beginTransaction();

            $registrationQuery = $pdo->prepare(
                'INSERT INTO registrations (name, phone, address)
                 VALUES (:name, :phone, :address)'
            );

            $registrationQuery->execute([
                'name' => $name,
                'phone' => $phone,
                'address' => $address
            ]);

            $registrationId = (int) $pdo->lastInsertId();

            $subtotal = cartSubtotal();
            $delivery = deliveryFee();
            $orderTotal = $subtotal + $delivery;

            $orderQuery = $pdo->prepare(
                'INSERT INTO orders (registration_id, total, status)
                 VALUES (:registration_id, :total, :status)'
            );

            $orderQuery->execute([
                'registration_id' => $registrationId,
                'total' => $orderTotal,
                'status' => 'pending'
            ]);

            $orderId = (int) $pdo->lastInsertId();

            $itemQuery = $pdo->prepare(
                'INSERT INTO order_items
                 (order_id, product_id, product_name, quantity, unit_price)
                 VALUES (:order_id, :product_id, :product_name, :quantity, :unit_price)'
            );

            foreach ($_SESSION['cart'] as $productId => $quantity) {
                $product = productById($productId);

                if ($product !== null) {
                    $itemQuery->execute([
                        'order_id' => $orderId,
                        'product_id' => $product['id'],
                        'product_name' => $product['name'],
                        'quantity' => (int) $quantity,
                        'unit_price' => $product['price']
                    ]);
                }
            }

            $pdo->commit();

            $_SESSION['customer'] = [
                'name' => $name,
                'phone' => $phone,
                'address' => $address
            ];

            $_SESSION['cart'] = [];
            $registered = true;
        } catch (PDOException $error) {
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }

            $errors[] = 'The order could not be saved. Check that the database tables exist.';
        }
    }
}

$pageTitle = 'FoodNest — Registration';
$currentPage = '';

require_once __DIR__ . '/includes/header.php';
?>

<section class="page-heading">
    <p class="eyebrow">One last step</p>
    <h1>Delivery registration</h1>
    <p>Enter your details so we can arrange delivery.</p>
</section>

<?php if ($registered) { ?>

    <section class="confirmation">
        <h2>Order confirmed!</h2>
        <p>
            Thank you, <?php echo escapeHtml($name); ?>.
            Your order number is <?php echo $orderId; ?>.
        </p>
        <p>
            Order total: ₹<?php echo number_format($orderTotal); ?>.
            We’ll contact you at <?php echo escapeHtml($phone); ?> to coordinate delivery.
        </p>
        <a class="button" href="index.php">Continue shopping</a>
    </section>

<?php } elseif (cartCount() === 0) { ?>

    <p>Your cart is empty. Add products before registering your delivery details.</p>
    <a class="button" href="categories.php">Shop categories</a>

<?php } else { ?>

    <?php if (count($errors) > 0) { ?>
        <div class="form-errors">
            <p>Please check these details:</p>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?php echo escapeHtml($error); ?></li>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <form class="registration-form" action="register.php" method="post">
        <label>
            Full name
            <input
                type="text"
                name="name"
                value="<?php echo escapeHtml($name); ?>"
                required
            >
        </label>

        <label>
            Phone number
            <input
                type="tel"
                name="phone"
                value="<?php echo escapeHtml($phone); ?>"
                placeholder="+91 98765 43210"
                required
            >
        </label>

        <label>
            Delivery address
            <textarea name="address" rows="4" required><?php
                echo escapeHtml($address);
            ?></textarea>
        </label>

        <button class="button" type="submit">Register and place order</button>
    </form>

<?php } ?>

<?php
require_once __DIR__ . '/includes/footer.php';
?>