<?php
include("../conn.php");
include("sidebar.php");


// Count total categories
$cat_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM category");
$cat_row = mysqli_fetch_assoc($cat_q);
$total_categories = $cat_row['total'];

// Count total items
$item_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM items");
$item_row = mysqli_fetch_assoc($item_q);
$total_items = $item_row['total'];

// Count total orders
$order_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders");
$order_row = mysqli_fetch_assoc($order_q);
$total_orders = $order_row['total'];

// Count total users
$user_q = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$user_row = mysqli_fetch_assoc($user_q);
$total_users = $user_row['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hunger Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 25px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            text-align: center;
            padding: 25px 10px;
            transition: 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.15);
        }
        .card i {
            font-size: 45px;
            color: #28a745;
            margin-bottom: 10px;
        }
        .card h5 {
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h2 class="text-center mb-4 fw-bold">🍽️ Hunger Hub Admin Dashboard</h2>

    <div class="dashboard">
        <div class="card bg-light">
            <i class="bi bi-grid"></i>
            <h4><?= $total_categories ?></h4>
            <h5>Categories</h5>
        </div>

        <div class="card bg-light">
            <i class="bi bi-basket"></i>
            <h4><?= $total_items ?></h4>
            <h5>Food Items</h5>
        </div>

        <div class="card bg-light">
            <i class="bi bi-receipt"></i>
            <h4><?= $total_orders ?></h4>
            <h5>Total Orders</h5>
        </div>

        <div class="card bg-light">
            <i class="bi bi-people"></i>
            <h4><?= $total_users ?></h4>
            <h5>Users</h5>
        </div>
    </div>

    <hr class="my-5">

    <div class="text-center">
        <h4>📊 Quick Links</h4>
        <div class="mt-3">
            <a href="all_category.php" class="btn btn-outline-success m-2">Manage Categories</a>
            <a href="all_food.php" class="btn btn-outline-success m-2">Manage Food Items</a>
            <a href="view_orders.php" class="btn btn-outline-success m-2">View Orders</a>
            <a href="users.php" class="btn btn-outline-success m-2">View Users</a>
        </div>
    </div>
</div>




<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
