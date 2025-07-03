<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['increment'])) {
        $_SESSION['cart']++;
    } elseif (isset($_POST['decrement']) && $_SESSION['cart'] > 0) {
        $_SESSION['cart']--;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
    <style>
        .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 300px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .buttons {
            display: flex;
            align-items: center;
        }
        .buttons button {
            margin: 0 5px;
            padding: 5px 10px;
        }
    </style>
</head>
<body>
    <div class="product">
        <span>Product Name</span>
        <div class="buttons">
            <form method="post">
                <button type="submit" name="decrement">-</button>
                <span><?php echo $_SESSION['cart']; ?></span>
                <button type="submit" name="increment">+</button>
            </form>
        </div>
    </div>
    <form method="post" action="at21(1)result.php">
        <input type="hidden" name="quantity" value="<?php echo $_SESSION['cart']; ?>">
        <button type="submit">Go to Cart</button>
    </form>
</body>
</html>
