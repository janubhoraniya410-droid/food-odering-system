<?php
session_start();
include("../conn.php");
include("navbar.php");

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

// Get user ID
$user_email = $_SESSION['email'];
$userQuery = mysqli_query($conn, "SELECT id FROM users WHERE email='$user_email'");
$userData = mysqli_fetch_assoc($userQuery);
$user_id = $userData['id'];

// Handle delete (cancel) order
if (isset($_GET['delete_id'])) {
    $delete_id = (int)$_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM orders WHERE id='$delete_id' AND user_id='$user_id'");
    header("Location: orders.php");
    exit();
}

// Fetch all orders for this user
$sql = "SELECT id, items, total_price, discount, final_price, shipping_address, status, created_at
        FROM orders
        WHERE user_id='$user_id'
        ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

// Fetch points history for display
$pointsQuery = mysqli_query($conn, "SELECT order_id, points_change, type FROM points_history WHERE user_id='$user_id'");
$pointsHistory = [];
while ($row = mysqli_fetch_assoc($pointsQuery)) {
    $pointsHistory[$row['order_id']][] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <style>
       <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

       
       h2 {
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    color: #333;
}

        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(48%, 1fr));
            gap: 20px;
        }

        .order-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .order-header strong { font-size: 18px; }

        .order-items { margin-bottom: 10px; }
        .order-item {
            display: flex;
            align-items: center;
            margin: 6px 0;
        }
        .order-item img {
            width: 50px; height: 50px;
            border-radius: 8px;
            margin-right: 10px;
            object-fit: cover;
            border: 1px solid #ccc;
        }
        .order-item p { margin: 0; font-size: 14px; }

        .order-info { font-size: 14px; color: #555; margin: 5px 0; }

        .timeline {
            display: flex;
            justify-content: space-between;
            margin: 20px 0;
            position: relative;
        }
        .timeline::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 5%;
            right: 5%;
            height: 4px;
            background: #ddd;
            z-index: 1;
        }
        .step {
            position: relative;
            text-align: center;
            width: 25%;
            z-index: 2;
        }
        .step .circle {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #ddd;
            margin: 0 auto 8px;
            line-height: 24px;
            color: white;
            font-size: 12px;
        }
        .step.active .circle { background: #28a745; }
        .step.cancelled .circle { background: red; }


        .delete { background: red; color: white; }
        .disabled { background: grey; color: #ccc; cursor: not-allowed; }
    </style>
</head>
<body>
<div class="container">
    <h2>My Orders</h2>
    <div class="orders-grid">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php
            $items = json_decode($row['items'], true);
            if (!is_array($items)) { $items = []; }

            $order_time = strtotime($row['created_at']);
            $time_diff = time() - $order_time;
            $can_cancel = ($time_diff <= 900);

            $status = strtolower($row['status']);
            $steps = ["pending", "processing", "shipped", "delivered"];

            // Points for this order
            $earned_points = 0;
            $redeemed_points = 0;
            if (isset($pointsHistory[$row['id']])) {
                foreach ($pointsHistory[$row['id']] as $p) {
                    if ($p['type'] === 'earn') $earned_points += $p['points_change'];
                    if ($p['type'] === 'redeem') $redeemed_points += abs($p['points_change']);
                }
            }
        ?>
        <div class="order-card">
            <div class="order-header">
                <strong>Order <?php echo $row['id']; ?></strong>
                <span><?php echo date("d M Y, h:i A", strtotime($row['created_at'])); ?></span>
            </div>

            <div class="order-items">
                <h4>Items:</h4>
                <?php if (empty($items)): ?>
                    <p>-</p>
                <?php else: ?>
                    <?php foreach ($items as $item): 
                        $name  = $item['name'] ?? 'Item';
                        $qty   = $item['quantity'] ?? 0;
                        $price = $item['price'] ?? 0;
                        $image = $item['photo'] ?? 'default.png';
                    ?>
                        <div class="order-item">
                            <img src="../admin/uploads/<?php echo htmlspecialchars($image); ?>" alt="food">
                            <p><?php echo htmlspecialchars($name) . " (x" . $qty . ") - Rs " . $price; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <p class="order-info"><strong>Total Price:</strong> Rs <?php echo $row['total_price']; ?></p>
            <?php if ($row['discount'] > 0): ?>
                <p class="order-info"><strong>Discount Applied:</strong> Rs <?php echo $row['discount']; ?></p>
            <?php endif; ?>
            <p class="order-info"><strong>Final Price:</strong> Rs <?php echo $row['final_price']; ?></p>

            <?php if ($earned_points > 0): ?>
                <p class="order-info" style="color:green;"><strong>Points Earned:</strong> <?php echo $earned_points; ?></p>
            <?php endif; ?>
            <?php if ($redeemed_points > 0): ?>
                <p class="order-info" style="color:orange;"><strong>Points Redeemed:</strong> <?php echo $redeemed_points; ?></p>
            <?php endif; ?>

            <p class="order-info"><strong>Address:</strong> <?php echo htmlspecialchars($row['shipping_address']); ?></p>

            <div class="timeline">
                <?php foreach ($steps as $i => $step): ?>
                    <?php 
                        $isActive = array_search($status, $steps) >= $i;
                        $isCancelled = ($status === "cancelled");
                    ?>
                    <div class="step <?php echo $isActive ? 'active' : ''; ?> <?php echo $isCancelled ? 'cancelled' : ''; ?>">
                        <div class="circle"><?php echo $i+1; ?></div>
                        <div><?php echo ucfirst($step); ?></div>
                    </div>
                <?php endforeach; ?>
                <?php if ($status === "cancelled"): ?>
                    <div class="step cancelled">
                        <div class="circle">X</div>
                        <div>Cancelled</div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($status === "pending"): ?>
                <?php if ($can_cancel): ?>
                    <a href="orders.php?delete_id=<?php echo $row['id']; ?>" class="btn delete">❌ Cancel Order</a>
                <?php else: ?>
                    <button class="btn disabled" disabled>❌ Cancel Order</button>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
    </div>
</div>
</body>
</html>
<?php
include("../footer.php");

?>

