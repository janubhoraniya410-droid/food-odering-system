<?php
include('../conn.php');



$query='delete from category where cid = '. $_REQUEST["id"];

$run=mysqli_query($conn,$query);

if(!$run)
{
    echo "error".mysqli_error();
}
header("Location:all_category.php");
?>