<?php
include('../conn.php');

$query='delete from items where id = '. $_REQUEST["id"];

$run=mysqli_query($conn,$query);

if(!$run)
{
    echo "error".mysqli_error();
}
header("Location:all_food.php");
?>