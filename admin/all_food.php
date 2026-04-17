<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Items</title>


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>


    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

   <style>
/* Table Styling */
table {
    width: 85%;
    margin: 30px auto;
    margin-left: 100px;
    border-collapse: collapse;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    overflow: hidden;
    text-align: center;
}

th, td {
    padding: 14px 18px;
    text-align: center;
    font-size: 15px;
}

th {
    background:  #132537ff;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
}

tr:nth-child(even) {
    background-color: #f9f9f9;
}

tr:hover {
    background-color: #f1f7ff;
    transition: 0.3s;
}

td img {
    width: 60px;
    height: 60px;
    border-radius: 8px;
    object-fit: cover;
    border: 2px solid #ddd;
    display: block;
    margin: 0 auto;
}

td a {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    margin: 0 4px;
    font-weight: bold;
    font-size: 13px;
}

td a[href*="update"] {
    background: #ffc107;
    color: #000;
}

td a[href*="delete"] {
    background: #dc3545;
    color: #fff;
}

td a:hover {
    opacity: 0.8;
    transition: 0.2s;
}

.content {
    margin-left:250px;
    padding: 20px;
    text-align: center;
}

.page-title {
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

<?php
include("sidebar.php"); 

$query = "SELECT * FROM items";
$run = mysqli_query($conn, $query);
?>

<div class="content">
    <h2 class="page-title">All Food Items</h2>

    <table id="items">
        <thead>
 <tr>
    <th>Id</th>
    <th>Cid</th>
    <th>Name</th>
    <th>Description</th>
    <th>Photo</th>
    <th>Price</th>
    <th>Availability</th>
    <th>Edit</th>
    <th>Delete</th>
</tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($run) > 0) {   
            while($row = mysqli_fetch_assoc($run)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['cid']}</td>
                        <td>{$row['iname']}</td>
                        <td>{$row['des']}</td>
                        <td><img src='uploads/{$row['photo']}' alt='{$row['iname']}'></td>
                        <td>₹{$row['price']}</td>
                        <td>".($row['available'] ? '✅ Available' : '❌ Not Available')."</td>
                        <td><a href='update_item.php?id={$row['id']}'>Edit</a></td>
                        <td><a href='delete_item.php?id={$row['id']}'>Delete</a></td>
                     </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No items found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#items').DataTable({
        "pageLength": 5,   // ✅ shows 5 rows per page
        "lengthMenu": [5, 10, 25, 50] // ✅ dropdown for number of rows
    });
});
</script>

</body>
</html>
