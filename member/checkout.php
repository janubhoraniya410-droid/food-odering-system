<?php
session_start();
include("../conn.php");


if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

$user_email = $_SESSION['email'];
$userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email='$user_email'");
$userData = mysqli_fetch_assoc($userQuery);
$user_id = $userData['id'];

// Fetch user’s current points
$pointsQuery = mysqli_query($conn, "SELECT points FROM user_points WHERE user_id='$user_id'");
$userPoints = mysqli_fetch_assoc($pointsQuery);
$current_points = $userPoints ? $userPoints['points'] : 0;

// Fetch cart items
$sql = "SELECT cart.item_id, cart.quantity, items.iname, items.price, items.photo
        FROM cart 
        JOIN items ON cart.item_id = items.id 
        WHERE cart.user_id='$user_id'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

// Prepare cart array and calculate total
$total_price = 0;
$cartItemsArray = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row_total = $row['price'] * $row['quantity'];
    $total_price += $row_total;
    $cartItemsArray[] = $row;
}

// Calculate points to earn for this order
$points_to_earn = intdiv($total_price, 500);

if (isset($_POST['place_order'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $redeem_points = isset($_POST['redeem_points']) ? intval($_POST['redeem_points']) : 0;

    if ($redeem_points > $current_points) {
        $redeem_points = $current_points;
    }

    $discount = $redeem_points * 10;

    $final_price = max(0, $total_price - $discount);

    if (!empty($cartItemsArray)) {
        $itemsJSON = mysqli_real_escape_string($conn, json_encode($cartItemsArray));

        $insert = "INSERT INTO orders (user_id, items, total_price, discount, final_price, shipping_address) 
                   VALUES ('$user_id', '$itemsJSON', '$total_price', '$discount', '$final_price', '$address')";

        if (mysqli_query($conn, $insert)) {
            $order_id = mysqli_insert_id($conn);

            // Clear cart
            mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");

            // Earn points
            $earned_points = $points_to_earn;
            if ($earned_points > 0) {
                mysqli_query($conn, "INSERT INTO points_history (user_id, order_id, points_change, type) 
                                     VALUES ('$user_id', '$order_id', $earned_points, 'earn')");
                mysqli_query($conn, "INSERT INTO user_points (user_id, points) 
                                     VALUES ('$user_id', $earned_points) 
                                     ON DUPLICATE KEY UPDATE points = points + $earned_points");
            }

            // Deduct redeemed points
            if ($redeem_points > 0) {
                mysqli_query($conn, "INSERT INTO points_history (user_id, order_id, points_change, type) 
                                     VALUES ('$user_id', '$order_id', -$redeem_points, 'redeem')");
                mysqli_query($conn, "UPDATE user_points 
                                     SET points = points - $redeem_points 
                                     WHERE user_id='$user_id'");
            }

            // Fetch updated balance
            $pointsResult = mysqli_query($conn, "SELECT points FROM user_points WHERE user_id='$user_id'");
            $updatedPoints = mysqli_fetch_assoc($pointsResult)['points'];

            // Success message
            echo "
            <html>
            <head>
                <meta http-equiv='refresh' content='3;url=orders.php'>
                <style>
                    body { font-family: Arial, sans-serif; text-align:center; margin-top:100px; }
                    .success-box {
                        display:inline-block;
                        padding:30px 50px;
                        border:2px solid green;
                        border-radius:10px;
                        background:#f0fff0;
                    }
                    .success-box h2 { color:green; }
                    .success-box p { font-size:18px; }
                </style>
            </head>
            <body>
                <div class='success-box'>
                    <h2>✅ Order Placed Successfully!</h2>
                    <p>".($earned_points > 0 ? "You earned $earned_points point(s). " : "No points earned (order below ₹500). ")."
                    ".($redeem_points > 0 ? "You redeemed $redeem_points points." : "")."</p>
                    <p>💰 Your updated balance: <b>{$updatedPoints}</b> points</p>
                </div>
            </body>
            </html>";
            exit();
        } else {
            die("Error: " . mysqli_error($conn));
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        h2 { color: black; font-size: 28px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 15px; text-align: center; border-bottom: 1px solid #eee; }
        .total { font-size: 20px; font-weight: bold; margin-top: 20px; text-align: right; }
        .place-order { float: right; margin-top: 20px; padding: 10px 20px; background: green; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; }
        textarea { width: 100%; height: 80px; padding: 10px; margin-top: 15px; border-radius: 6px; border: 1px solid #ccc; }
    </style>
</head>
<body>
<div class="container">
    <h2>Checkout</h2>
    <form method="POST">
        <table>
            <tr>
                <th>Item Name</th>
                <th>Price (Each)</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php foreach ($cartItemsArray as $row): 
                $row_total = $row['price'] * $row['quantity']; ?>
                <tr>
                    <td><?php echo $row['iname']; ?></td>
                    <td>Rs <?php echo $row['price']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>Rs <?php echo $row_total; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="total">Total Amount: Rs <?php echo $total_price; ?></div>

        <p>You have <b><?php echo $current_points; ?></b> points (1 point = Rs 10)</p>
        <p>
            <?php 
                if ($points_to_earn > 0) {
                    echo "🎉 You will earn <b>$points_to_earn point(s)</b> for this order!";
                } else {
                    echo "Orders below Rs 500 do not earn points.";
                }
            ?>
        </p>

        <label>Redeem Points: </label>
        <input type="number" name="redeem_points" min="0" max="<?php echo $current_points; ?>" value="0">

        <br><br>
        <label><b>Shipping Address:</b></label><br>
        <textarea name="address" required></textarea><br>

        <button type="submit" name="place_order" class="place-order">Place Order</button>
    </form>
</div>
</body>
</html>
