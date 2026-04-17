<?php
session_start();
include("../conn.php");
include("sidebar.php");

// ✅ Handle status update
if (isset($_POST['update_status'])) {
    $order_id = (int)$_POST['order_id'];
    $status   = mysqli_real_escape_string($conn, $_POST['status']);
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$order_id");
}

// ✅ Handle filter
$filter = "";
if (isset($_GET['status']) && $_GET['status'] != "all") {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $filter = "WHERE status='$status'";
}

// ✅ Fetch orders with filter
$ordersQuery = mysqli_query($conn, "SELECT * FROM orders $filter ORDER BY created_at DESC");
if (!$ordersQuery) {
    die("SQL Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin - Manage Orders</title>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    background: #f4f6f9;
}
.container {
    margin-left: 250px;
    padding: 20px;
}
h1 {
    text-align: center;
    color: #132537;
    margin-bottom: 20px;
}

/* Filter box */
.filter-box {
    background: #fff;
    padding: 15px 25px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 10px;
    text-align: center;
    margin-bottom: 25px;
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}
.filter-box select,
.filter-box button {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin: 0 5px;
}
.filter-box button {
    background: #28a745;
    color: white;
    border: none;
    cursor: pointer;
}
.filter-box button:hover {
    background: #218838;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    overflow: hidden;
}
th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 14px;
}
th {
    background: #132537;
    color: white;
}
td form {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
}
td form select {
    padding: 4px 6px;
}
td form button {
    background: #007bff;
    color: white;
    border: none;
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
}
td form button:hover {
    background: #0056b3;
}
.order-item {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 10px;
    margin: 5px 0;
}
.order-item img {
    width: 45px;
    height: 45px;
    border-radius: 5px;
    object-fit: cover;
    border: 1px solid #ccc;
}
</style>
</head>
<body>

<div class="container">
    <h1>Manage Orders</h1>

    <!-- ✅ Filter box on top -->
    <div class="filter-box">
        <form method="GET">
            <label for="status"><b>Filter by Status:</b></label>
            <select name="status" id="status">
                <option value="all" <?php if(!isset($_GET['status']) || $_GET['status']=="all") echo "selected"; ?>>All</option>
                <option value="pending" <?php if(isset($_GET['status']) && $_GET['status']=="pending") echo "selected"; ?>>Pending</option>
                <option value="processing" <?php if(isset($_GET['status']) && $_GET['status']=="processing") echo "selected"; ?>>Processing</option>
                <option value="shipped" <?php if(isset($_GET['status']) && $_GET['status']=="shipped") echo "selected"; ?>>Shipped</option>
                <option value="delivered" <?php if(isset($_GET['status']) && $_GET['status']=="delivered") echo "selected"; ?>>Delivered</option>
                <option value="cancelled" <?php if(isset($_GET['status']) && $_GET['status']=="cancelled") echo "selected"; ?>>Cancelled</option>
            </select>
            <button type="submit">Apply</button>
        </form>
    </div>

    <!-- ✅ Orders Table -->
    <table>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Items</th>
            <th>Total Price</th>
            <th>Shipping Address</th>
            <th>Status</th>
            <th>Order Date</th>
        </tr>

        <?php while ($order = mysqli_fetch_assoc($ordersQuery)): ?>
        <tr>
            <td><?= $order['id']; ?></td>
            <td><?= $order['user_id']; ?></td>
            <td>
                <?php
                $items = json_decode($order['items'], true);
                if (!empty($items)) {
                    foreach ($items as $item) {
                        $name = $item['iname'] ?? 'Item';
                        $qty = $item['quantity'] ?? 0;
                        $price = $item['price'] ?? 0;
                        $image = $item['photo'] ?? 'default.png';
                        ?>
                        <div class="order-item">
                            <img src="uploads/<?= htmlspecialchars($image); ?>" alt="food">
                            <span><?= htmlspecialchars($name); ?> (x<?= $qty; ?>) - Rs <?= $price; ?></span>
                        </div>
                        <?php
                    }
                } else {
                    echo "-";
                }
                ?>
            </td>
            <td>Rs <?= $order['total_price']; ?></td>
            <td><?= htmlspecialchars($order['shipping_address']); ?></td>
            <td>
                <form method="POST">
                    <input type="hidden" name="order_id" value="<?= $order['id']; ?>">
                    <select name="status">
                        <?php
                        $statuses = ["pending", "processing", "shipped", "delivered", "cancelled"];
                        foreach ($statuses as $s) {
                            $selected = ($order['status'] === $s) ? "selected" : "";
                            echo "<option value='$s' $selected>" . ucfirst($s) . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="update_status">Update</button>
                </form>
            </td>
            <td><?= $order['created_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
