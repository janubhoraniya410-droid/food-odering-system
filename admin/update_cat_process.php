
<?php

include('../conn.php');

if(isset($_POST['btn']))
{
    $cid=$_POST['cid'];
    $cname=$_POST['cname'];

    $image_name = $_FILES['photo']['name'];
    $image_tmp  = $_FILES['photo']['tmp_name'];



    $photo_path =basename($image_name);

    if (!empty($image_name)) {
        $photo_path = basename($image_name);
        move_uploaded_file($image_tmp, $photo_path);
    } else {
        $image_name = $row['photo'];
    }

    $query="update category set cname='$cname', photo='$image_name' where cid='$cid' ";

    $run =mysqli_query($conn,$query);

    if(!$run)
    {
        echo "error".mysqli_error($conn);
    }

    header('location:all_category.php');

}


?>