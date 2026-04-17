<?php
include("../conn.php");
include("sidebar.php");

// Date filter 
$from_date = $_GET['from_date'] ?? '';
$to_date = $_GET['to_date'] ?? '';


$base_query = "SELECT o.*, u.email FROM orders o 
               JOIN users u ON o.user_id = u.id";

// Apply filter if dates provided
if (!empty($from_date) && !empty($to_date)) {
    $query = $base_query . " WHERE DATE(o.created_at) BETWEEN '$from_date' AND '$to_date'";
} else {
    $query = $base_query;
}

$orders_q = mysqli_query($conn, $query);

// Initialize totals
$delivered_revenue = 0;
$pending_revenue = 0;
$total_orders = 0;
$today_revenue = 0;

// Calculate totals
if ($orders_q && mysqli_num_rows($orders_q) > 0) {
    while ($row = mysqli_fetch_assoc($orders_q)) {
        $total_orders++;

        $order_date = date('Y-m-d', strtotime($row['created_at']));
        $today = date('Y-m-d');


        if (strtolower(trim($row['status'])) === 'delivered') {
    $delivered_revenue += $row['final_price'];


$order_date = date('Y-m-d', strtotime($row['created_at']));
$today = date('Y-m-d');

if ($order_date == $today) {  
    $today_revenue += $row['final_price'];
}
    } else {
    $pending_revenue += $row['final_price'];
     }

}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Revenue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            background-color: #f8f9fa;
        }
        .main-content {
            margin-left: 250px;
            padding: 40px;
            width: 100%;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .revenue-table {
            margin-top: 30px;
        }
        .filter-box {
            background: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        h3{
    font-size: 28px;
    font-weight: bold;
    color: #132537ff;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h3 class="mb-4 text-center fw-bold">📊 Manage Revenue</h3>

    <!-- Date Filter Form -->
    <div class="filter-box">
        <form method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">From Date</label>
                <input type="date" name="from_date" value="<?= $from_date ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">To Date</label>
                <input type="date" name="to_date" value="<?= $to_date ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white p-4">
                <h5>Delivered Revenue</h5>
                <h3>₹ <?= number_format($delivered_revenue, 2) ?></h3>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-warning text-dark p-4">
                <h5>Pending Revenue</h5>
                <h3>₹ <?= number_format($pending_revenue, 2) ?></h3>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-info text-white p-4">
                <h5>Total Orders</h5>
                <h3><?= $total_orders ?></h3>
            </div>
        </div>


    <!-- Today Revenue Card -->
    <div class="card bg-success text-white text-center mb-4 p-4">
        <h4>🌞 Today's Delivered Revenue</h4>
        <h2>₹ <?= number_format($today_revenue, 2) ?></h2>
    </div>

    <!-- Orders Table -->
    <div class="revenue-table">
        <div class="card p-4">
            <h5 class="mb-3 text-secondary">📦 Order Details</h5>
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>User Email</th>
                        <th>Final Price</th>
                        <th>Status</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <?php
                    $orders_q = mysqli_query($conn, $query);
                    if ($orders_q && mysqli_num_rows($orders_q) > 0) {
                        while ($order = mysqli_fetch_assoc($orders_q)) {
                            $status = strtolower(trim($order['status']));
                            if ($status === 'delivered') {
                                $status_badge = "<span class='badge bg-success'>Delivered </span>";
                            } else {
                                $status_badge = "<span class='badge bg-warning text-dark'>" . ucfirst($order['status']) . "</span>";
                            }

                            echo "<tr>
                                    <td>{$order['id']}</td>
                                    <td>{$order['email']}</td>
                                    <td>₹ " . number_format($order['final_price'], 2) . "</td>
                                    <td>{$status_badge}</td>
                                    <td>" . date('d M Y', strtotime($order['created_at'])) . "</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-muted text-center'>No orders found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
