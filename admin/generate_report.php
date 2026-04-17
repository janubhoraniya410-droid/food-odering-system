<?php
include("../conn.php");
include("sidebar.php");



// --- Monthly Revenue Query ---
$monthly_query = "
    SELECT 
        DATE_FORMAT(created_at, '%Y-%m') AS month,
        SUM(final_price) AS total
    FROM orders
    GROUP BY month
    ORDER BY month ASC
";
$monthly_result = mysqli_query($conn, $monthly_query);
$months = [];
$monthly_totals = [];
while ($row = mysqli_fetch_assoc($monthly_result)) {
    $months[] = $row['month'];
    $monthly_totals[] = $row['total'];
}

// --- Weekly Revenue Query ---
$weekly_query = "
    SELECT 
        DATE_FORMAT(created_at, '%Y-%u') AS week,
        SUM(final_price) AS total
    FROM orders
    GROUP BY week
    ORDER BY week ASC
";
$weekly_result = mysqli_query($conn, $weekly_query);
$weeks = [];
$weekly_totals = [];
while ($row = mysqli_fetch_assoc($weekly_result)) {
    $weeks[] = $row['week'];
    $weekly_totals[] = $row['total'];
}

// --- Item-wise Revenue Query ---
$item_query = "SELECT items, final_price FROM orders";
$item_result = mysqli_query($conn, $item_query);

$itemRevenue = [];
while ($row = mysqli_fetch_assoc($item_result)) {
    $items = json_decode($row['items'], true);
    if (is_array($items)) {
        foreach ($items as $item) {
            $iname = trim($item['iname']);
            $price = floatval($item['price']);
            $quantity = intval($item['quantity']);
            $total = $price * $quantity;
            if (!isset($itemRevenue[$iname])) {
                $itemRevenue[$iname] = 0;
            }
            $itemRevenue[$iname] += $total;
        }
    }
}

$item_names = array_keys($itemRevenue);
$item_totals = array_values($itemRevenue);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #f4f6f8;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
    }

    .main-content {
        margin-left: 260px; /* leave space for sidebar */
        padding: 30px;
        transition: all 0.3s ease;
    }

    h2.section-title {
        text-align: center;
        font-size: 26px;
        font-weight: 600;
        color: #222;
        margin-bottom: 15px;
    }

    .dashboard-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        justify-content: center;
    }

    .chart-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 25px;
        flex: 1 1 420px;
        max-width: 480px;
        min-height: 460px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .chart-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
    }

    .chart-card h3 {
        font-size: 20px;
        color: #444;
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    canvas {
        width: 100% !important;
        height: 320px !important;
    }



    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
        }
      
    }
</style>

</head>
<body>

<div class="main-content">
    <h2 class="section-title">📊 Revenue Analytics</h2>

    <div class="dashboard-container">
        <!-- Monthly Chart -->
        <div class="chart-card">
            <h3>📅 Monthly Revenue Trend</h3>
            <canvas id="monthlyChart"></canvas>
        </div>

        <!-- Weekly Chart -->
        <div class="chart-card">
            <h3>📆 Weekly Revenue Trend</h3>
            <canvas id="weeklyChart"></canvas>
        </div>

        <!-- Item-wise Chart -->
        <div class="chart-card">
            <h3>🍔 Item-wise Revenue Report</h3>
            <canvas id="itemChart"></canvas>
        </div>
    </div>
</div>



    <script>
        // --- Monthly Revenue Chart ---
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Monthly Revenue (₹)',
                    data: <?php echo json_encode($monthly_totals); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'Monthly Revenue Trend', font: { size: 18 } },
                    legend: { display: true }
                },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Revenue (₹)' } },
                    x: { title: { display: true, text: 'Month (YYYY-MM)' } }
                }
            }
        });

        // --- Weekly Revenue Chart ---
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        new Chart(weeklyCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($weeks); ?>,
                datasets: [{
                    label: 'Weekly Revenue (₹)',
                    data: <?php echo json_encode($weekly_totals); ?>,
                    fill: true,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(153, 102, 255, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'Weekly Revenue Trend', font: { size: 18 } },
                    legend: { display: true }
                },
                scales: {
                    y: { beginAtZero: true, title: { display: true, text: 'Revenue (₹)' } },
                    x: { title: { display: true, text: 'Week (YYYY-WeekNo)' } }
                }
            }
        });

        // --- Item-wise Revenue Chart ---
        const itemCtx = document.getElementById('itemChart').getContext('2d');
        new Chart(itemCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($item_names); ?>,
                datasets: [{
                    label: 'Item-wise Revenue (₹)',
                    data: <?php echo json_encode($item_totals); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(201, 203, 207, 0.6)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'Item-wise Revenue Distribution', font: { size: 18 } },
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>

</body>
</html>
