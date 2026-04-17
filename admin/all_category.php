<?php
include("sidebar.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Categories</title>
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background-color: #f4f6f9;
    margin: 0;
    padding: 0;
}

/* Main container */
.container {
    margin-left: 250px;
    padding: 30px;
}

/* Title */
h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #132537;
    font-weight: 700;
    font-size: 28px;
}

/* Table container */
.table-box {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    width: 85%;
    margin: 0 auto;
}

/* Table styles */
table {
    width: 100%;
    border-collapse: collapse;
}
th {
    background-color: #132537;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 14px;
    padding: 14px;
    text-align: center;
}
td {
    padding: 14px;
    text-align: center;
    font-size: 15px;
    color: #333;
    border-bottom: 1px solid #e5e5e5;
    background-color: #fff;
}
tr:last-child td {
    border-bottom: none;
}
tr:hover td {
    background-color: #f9fbfd;
}

/* Button styles */
.btn {
    padding: 6px 14px;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 500;
    transition: 0.2s ease;
    margin: 0 3px;
    display: inline-block;
}
.btn.edit {
    background: #ffc107;
    color: #212529;
}
.btn.delete {
    background: #dc3545;
    color: #fff;
}

.btn:hover {
    transform: scale(1.05);
    opacity: 0.9;
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

/* Responsive */
@media (max-width: 768px) {
    .container {
        margin-left: 0;
        padding: 15px;
    }
    .table-box {
        width: 100%;
        box-shadow: none;
    }
    table, th, td {
        font-size: 13px;
    }
}
</style>
</head>
<body>

<div class="container">
    <h2>All Categories</h2>

    <div class="table-box">
        <table>
            <tr>
                <th>CID</th>
                <th>Category Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php
            $query = "SELECT * FROM category";
            $run = mysqli_query($conn, $query);

            if (mysqli_num_rows($run) > 0) {
                while ($row = mysqli_fetch_assoc($run)) {
                    echo "
                    <tr>
                        <td>{$row['cid']}</td>
                        <td style='text-transform: capitalize;'>{$row['cname']}</td>
                       <td><img src='{$row['photo']}' ></td>
                        <td>
                            <a href='update_cat.php?id={$row['cid']}&name={$row['cname']}' class='btn edit'>Edit</a>
                            <a href='delete_cat.php?id={$row['cid']}' class='btn delete' onclick='return confirm(\"Delete this category?\")'>Delete</a>
                       
                        </td>
                    </tr>";
                }
            } else {
                echo "
                <tr>
                    <td colspan='3' style='color:#888;'>No categories found</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
