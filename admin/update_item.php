<?php
include("../conn.php");
include("sidebar.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM items WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        die("Item not found!");
    }
}

if (isset($_POST['update_btn'])) {
    $name  = $_POST['iname'];
    $des   = $_POST['des'];
    $price = $_POST['price'];
    $cid   = $_POST['cid'];
    $available = isset($_POST['available']) ? '1' : '0';

    $image_name = $_FILES['photo']['name'];
    $image_tmp  = $_FILES['photo']['tmp_name'];
    $upload_dir = "uploads/";

    if (!empty($image_name)) {
        $image_path = $upload_dir . basename($image_name);
        move_uploaded_file($image_tmp, $image_path);
    } else {
        $image_name = $row['photo'];
    }

    $update = "UPDATE items 
               SET iname='$name',
                   des='$des',
                   price='$price',
                   cid='$cid',
                   available='$available',
                   photo='$image_name'
               WHERE id='$id'";
    $update_run = mysqli_query($conn, $update);

    if ($update_run) {
        header("Location: all_food.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Item</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            background-color: #f8f9fa;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
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
        .form-container img {
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="main-content">
    <h3 class="text-center mb-4">Edit Food Item</h3>

    <div class="form-container">
        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="cid" class="form-select" required>
                    <option value="">Choose category</option>
                    <?php
                    $cat_q = mysqli_query($conn, "SELECT * FROM category");
                    while ($cat = mysqli_fetch_assoc($cat_q)) {
                        $selected = ($cat['cid'] == $row['cid']) ? "selected" : "";
                        echo "<option value='".$cat['cid']."' $selected>".$cat['cname']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Item Name</label>
                <input type="text" name="iname" class="form-control" value="<?= $row['iname'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <input type="text" name="des" class="form-control" value="<?= $row['des'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price (₹)</label>
                <input type="number" name="price" class="form-control" value="<?= $row['price'] ?>" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="available" <?= ($row['available'] == '1') ? 'checked' : '' ?>>
                <label class="form-check-label">Available</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="uploads/<?= $row['photo']; ?>" alt="Item Image" width="150"><br>
                <input type="file" name="photo" class="form-control mt-2">
            </div>

            <button type="submit" name="update_btn" class="btn btn-success w-100">Update Item</button>
        </form>
    </div>
</div>

</body>
</html>

