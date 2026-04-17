<?php
require("../conn.php");

echo "<pre>";
print_r($_POST);
echo "</pre>";



if(isset($_POST['add_btn'])) {
    $cat  = $_POST['cid'];
    $name = $_POST['name'];
    $des  = $_POST['des'];
    $price = $_POST['price'];
    $availability_status = isset($_POST['not_available']) ? '0' : '1';

  
    $image_name = $_FILES['image']['name'];
    $image_tmp  = $_FILES['image']['tmp_name'];
    $upload_dir = "uploads/";
    $image_path = $upload_dir . basename($image_name);

    if(move_uploaded_file($image_tmp, $image_path)) {
    
        $add = "INSERT INTO items (cid, iname, des, photo, price, available)
                VALUES ('$cat','$name','$des','$image_name','$price','$availability_status')";
        
        $run = mysqli_query($conn, $add);

        if($run) {
            echo "successful";
            header("location:add_food.php");
        } else {
            echo "error: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
} else {
    echo "error: form not submitted.";
}
?>
