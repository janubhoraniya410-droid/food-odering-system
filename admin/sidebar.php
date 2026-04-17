<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    </head>

 
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../conn.php');

// ✅ Get admin name
$adminName = "Admin";
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT CONCAT(fname, ' ', lname) AS name FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $adminName = $row['name'];
    }
}

// ✅ Detect current page for highlighting
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Sidebar CSS -->
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        display: flex;
    }

    /* Sidebar Container */
    .sidebar {
        width: 250px;
        min-height: 100vh;
        background: #212529;
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: fixed;
        top: 0;
        left: 0;
    }

    /* Brand Name */
    .sidebar .brand {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        padding: 20px 0;
    }

    /* Sidebar Links */
    .sidebar a {
        color: white;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: 0.3s;
        font-size: 16px;
    }

    .sidebar a i {
        margin-right: 10px;
        font-size: 18px;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background: #343a40;
    }

    /* Logout link in red */
    .sidebar a.logout {
        color: #e74c3c;
    }

    /* Submenu */
    .submenu {
        max-height: 0;
        overflow: hidden;
        background: #2c3034;
        transition: max-height 0.3s ease;
    }

    .submenu a {
        font-size: 14px;
        padding: 10px 40px;
    }

    /* Open submenu */
    .submenu.open {
        max-height: 200px;
    }

    /* Bottom user */
    .sidebar .bottom-user {
        text-align: center;
        padding: 15px;
        background: #343a40;
        font-weight: bold;
    }

    /* Page Content */
    .content {
        margin-left: 250px;
        padding: 30px;
        background: #f8f9fa;
        min-height: 100vh;
        width: calc(100% - 250px);
    }
</style>

<!-- Sidebar HTML -->
<div class="sidebar">
    <div>
        <div class="brand">Hunger Hub</div>


        <a href="deshbord.php" class="<?= $currentPage == 'deshbord.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i> deshbord
        </a>

        <!-- Food Items (Collapsible) -->
        <a href="javascript:void(0)" class="menu-toggle <?= in_array($currentPage, ['add_food.php','all_food.php']) ? 'active' : '' ?>">
            <i class="fa-solid fa-utensils"></i> Food Items
        </a>
        <div class="submenu <?= in_array($currentPage, ['add_food.php','all_food.php']) ? 'open' : '' ?>">
            <a href="add_food.php" class="<?= $currentPage == 'add_food.php' ? 'active' : '' ?>">➕ Add Food Item</a>
            <a href="all_food.php" class="<?= $currentPage == 'all_food.php' ? 'active' : '' ?>">📋 All Food Items</a>
        </div>

        <!-- Category (Collapsible) -->
        <a href="javascript:void(0)" class="menu-toggle <?= in_array($currentPage, ['add_category.php','all_category.php']) ? 'active' : '' ?>">
            <i class="fa-solid fa-layer-group"></i> Category
        </a>
        <div class="submenu <?= in_array($currentPage, ['add_category.php','all_category.php']) ? 'open' : '' ?>">
            <a href="add_category.php" class="<?= $currentPage == 'add_category.php' ? 'active' : '' ?>">➕ Add Category</a>
            <a href="all_category.php" class="<?= $currentPage == 'all_category.php' ? 'active' : '' ?>">📋 All Categories</a>
        </div>

        <!-- Other Links -->
        <a href="view_orders.php" class="<?= $currentPage == 'view_orders.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-bag-shopping"></i> Orders
        </a>

        <a href="manage_revenue.php" class="<?= $currentPage == 'manage_revenue.php' ? 'active' : '' ?>">
            🌞Manage Revenue
        </a>

        <a href="generate_report.php" class="<?= $currentPage == 'generate_report.php' ? 'active' : '' ?>">
             📊 Revenue Analytics
        </a>

        

        
        <a href="user_details.php" class="<?= $currentPage == 'user_details.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i> User Details
        </a>
        <a href="../login.php" class="logout">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <div class="bottom-user">
        <?= htmlspecialchars($adminName); ?>
    </div>
</div>

<!-- Sidebar JS -->
<script>
    document.querySelectorAll('.menu-toggle').forEach(menu => {
        menu.addEventListener('click', () => {
            const submenu = menu.nextElementSibling;
            submenu.classList.toggle('open');
        });
    });
</script>
