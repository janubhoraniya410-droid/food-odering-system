<?php
include '../conn.php';  

$keyword = $_GET['keyword'];

$sql = "SELECT * FROM items WHERE iname LIKE '%$keyword%'";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2 style="text-align:center;">Search Results for "<?php echo $keyword; ?>"</h2>
<hr>

<div style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">

<?php
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {
        ?>

        <div style="width:260px; border:1px solid #ddd; border-radius:10px; padding:10px;">
            <img src="../admin/uploads/<?php echo $row['photo']; ?>" width="100%" height="180px"
                 style="border-radius:10px;">

            <h3><?php echo $row['iname']; ?></h3>
            <p><?php echo $row['des']; ?></p>
            <p><b>₹ <?php echo $row['price']; ?></b></p>

            <a href="cart.php?id=<?php echo $row['id']; ?>">
                <button style="background:#ff5722; color:white; padding:8px 12px; border:none; border-radius:5px;">
                    Add to Cart
                </button>
            </a>
        </div>

        <?php
    }

} else {
    echo "<h3 style='color:red;'>No items found</h3>";
}
?>

</div>

</body>
</html>
