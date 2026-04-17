<?php
session_start();
require_once('../conn.php'); // ✅ Use require_once to avoid duplicate includes

// Fetch all users
$query = "SELECT * FROM users";
$user = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

</head>
    <style>
        .content {
            margin-left: 250px; /* Leave space for sidebar */
            padding: 30px;
            background: #f8f9fa;
            min-height: 100vh;

            /* Center Content */
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .content table {
            width: 90%; /* Adjust table width */
        }
    </style>
<body>

<?php include('sidebar.php'); ?> 

<!-- Page Content -->
<div class="content">
    <h2>User Details</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Fname</th>
                <th>Lname</th>
                <th>Email</th>
                <th>Phone</th>
           
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($user && mysqli_num_rows($user) > 0) {
                while ($row = mysqli_fetch_assoc($user)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fname']}</td>
                            <td>{$row['lname']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                  
                            <td>{$row['created_at']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
