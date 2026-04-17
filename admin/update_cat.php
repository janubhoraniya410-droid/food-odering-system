<?php
include("../conn.php");
include("sidebar.php");

// Get category data
if (isset($_GET['id'])) {
    $cid = $_GET['id'];
    $query = "SELECT * FROM category WHERE cid='$cid'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Category not found!");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
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
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 600px;
            margin: auto;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h3 class="text-center mb-4">Update Category Details</h3>

    <div class="form-container">
        <form method="post" action="update_cat_process.php" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label class="form-label">Category ID</label>
                <input type="text" name="cid" class="form-control" 
                       value="<?= htmlspecialchars($row['cid']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input type="text" name="cname" class="form-control" 
                       value="<?= htmlspecialchars($row['cname']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="<?= $row['photo']; ?>" alt="Item Image" width="150"><br>
                <input type="file" name="photo" class="form-control mt-2">
            </div>

            <button type="submit" name="btn" id="btn" class="btn btn-success w-100">
                Update Category
            </button>
        </form>
    </div>
</div>

</body>
</html>
