<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hunger Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { display: flex; margin: 0; font-family: 'Segoe UI', sans-serif; }
        .sidebar { width: 250px; min-height: 100vh; background: #212529; color: white; display: flex; flex-direction: column; justify-content: space-between; padding: 20px 0; position: fixed; }
        .sidebar .brand { font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 30px; }
        .sidebar a { color: white; padding: 12px 20px; display: block; text-decoration: none; transition: 0.3s; }
        .sidebar a:hover { background: #343a40; }
        .sidebar i { margin-right: 10px; }
        .sidebar .bottom-user { text-align: center; padding: 15px; background: #343a40; font-weight: bold; }
        .submenu { max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out; padding-left: 20px; background: #2c3034; }
        .submenu a { font-size: 14px; padding: 10px 20px; }
        .sidebar a.active + .submenu { max-height: 200px; }
        .content { margin-left: 250px; padding: 30px; width: 100%; background: #f8f9fa; }
        .content h1 { font-weight: 600; }
    </style>
</head>
<body>

    <!-- ✅ Include Sidebar -->
    <?php include('sidebar.php'); ?>

    <!-- Main Content -->
    <div class="content">
        <h1>Welcome, Admin 👋</h1>
        <p>Select an option from the sidebar to manage the food ordering system.</p>
    </div>

    <script>
        // ✅ Toggle submenu on click
        document.querySelectorAll('.toggle-menu').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelectorAll('.toggle-menu').forEach(link => {
                    if (link !== item) link.classList.remove('active');
                });
                item.classList.toggle('active');
            });
        });
    </script>

</body>
</html>
