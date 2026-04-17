<?php
include('../conn.php');

if (isset($_POST['cat_btn'])) {
    $cname = $_POST['cname'];

    // Handle file upload
    if (isset($_FILES['cphoto']) && $_FILES['cphoto']['error'] == 0) {
        $photo_name = $_FILES['cphoto']['name'];
        $photo_tmp = $_FILES['cphoto']['tmp_name'];

        // Save to "uploads" folder
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $photo_path = $upload_dir . basename($photo_name);

        if (move_uploaded_file($photo_tmp, $photo_path)) {
            // Insert into DB
            $query = "INSERT INTO category (cname, photo) VALUES ('$cname', '$photo_path')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "Category added successfully!";
            } else {
                echo "Database error: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "Please select a category photo.";
    }

    header("location:all_category.php");
}


?>
