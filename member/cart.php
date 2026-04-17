<?php
session_start();
include("../conn.php");
include("navbar.php");


if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}


$user_email = $_SESSION['email'];
$userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email='$user_email'");
$userData = mysqli_fetch_assoc($userQuery);
$user_id = $userData['id'];

//  ADD ITEM TO CART
if (isset($_GET['id'])) {
    $item_id = intval($_GET['id']);

    // Check if item already in cart
    $check = mysqli_query($conn, "SELECT * FROM cart WHERE user_id='$user_id' AND item_id='$item_id'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO cart (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', 1)");
    }
    header("Location: cart.php");
    exit();
}

// UPDATE QUANTITY / REMOVE ITEM
if (isset($_GET['action']) && isset($_GET['cart_id'])) {
    $cart_id = intval($_GET['cart_id']);
    $action = $_GET['action'];

    if ($action == "plus") {
        mysqli_query($conn, "UPDATE cart SET quantity = quantity + 1 WHERE id='$cart_id'");
    } elseif ($action == "minus") {
        mysqli_query($conn, "UPDATE cart SET quantity = GREATEST(quantity - 1, 1) WHERE id='$cart_id'");
    } elseif ($action == "remove") {
        mysqli_query($conn, "DELETE FROM cart WHERE id='$cart_id'");
    }
    header("Location: cart.php");
    exit();
}

// FETCH CART ITEMS
$sql = "SELECT cart.id as cart_id, cart.quantity, items.iname, items.price, items.photo 
        FROM cart 
        JOIN items ON cart.item_id = items.id 
        WHERE cart.user_id='$user_id'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$total_price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .cart-container { width: 80%; margin: 20px auto; }
        h2 { color: black; font-size: 28px; }
        h2 span { color: red; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table th, table td { padding: 15px; text-align: center; border-bottom: 1px solid #eee; }
        img { width: 100px; border-radius: 12px; }
        .qty-btn { padding: 5px 12px; font-size: 16px; cursor: pointer; text-decoration: none; border: 1px solid #ccc; border-radius: 4px; }
        .remove-btn { background: red; color: white; padding: 8px 15px; border: none; cursor: pointer; border-radius: 6px; }
        .checkout { float: right; margin-top: 20px; }
        .checkout-btn { background: blue; color: white; padding: 10px 20px; border-radius: 8px; border: none; cursor: pointer; font-size: 16px; text-decoration: none; }
        .checkout-btn { 
    background: blue; 
    color: white; 
    padding: 10px 20px; 
    border-radius: 8px; 
    border: none; 
    cursor: pointer; 
    font-size: 16px; 
    text-decoration: none; 
    transition: 0.3s ease; 
}

.checkout-btn:hover {
   
    color: black; 
}

.remove-btn {
    background: red;
    color: white;
    padding: 8px 15px;
    border: none;
    cursor: pointer;
    border-radius: 6px;
    transition: 0.3s ease;
}

.remove-btn:hover {
      color: black; 
}

        
        .total { font-size: 20px; font-weight: bold; margin-top: 20px; text-align: right; }
        .empty-cart { text-align: center; margin-top: 50px; font-size: 22px; color: gray; }
        .menu-link { display: inline-block; margin-top: 20px; padding: 10px 20px; background: green; color: white; text-decoration: none; border-radius: 8px; font-size: 18px; }
        
        .menu-link:hover{ color:black;}
    </style>
</head>
<body>
<div class="cart-container">
    <h2><span>My</span> Cart</h2>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): 
                $row_total = $row['price'] * $row['quantity'];
                $total_price += $row_total; ?>
                <tr>
                    <td><img src="../admin/uploads/<?php echo $row['photo']; ?>" alt=""></td>
                    <td><?php echo $row['iname']; ?></td>
                    <td>Rs <?php echo $row['price']; ?></td>
                    <td>
                        <a href="?action=minus&cart_id=<?php echo $row['cart_id']; ?>" class="qty-btn">-</a>
                        <?php echo $row['quantity']; ?>
                        <a href="?action=plus&cart_id=<?php echo $row['cart_id']; ?>" class="qty-btn">+</a>
                    </td>
                    <td>Rs <?php echo $row_total; ?></td>
                    <td><a href="?action=remove&cart_id=<?php echo $row['cart_id']; ?>"><button class="remove-btn">🗑 Remove</button></a></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="total">Total Cart Value : Rs <?php echo $total_price; ?> </div>
        <div class="checkout">
            <a href="checkout.php" class="checkout-btn">🛒 Checkout</a>
        </div>

    <?php else: ?>
        <div class="empty-cart">
            🛒 Your cart is empty!  
            <br>
            <a href="menu.php" class="menu-link">Add Items </a>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
