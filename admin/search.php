<?php

include ("../conn.php"); 

if (isset($_GET['q'])) {
    $q = $_GET['q'];
    $q = mysqli_real_escape_string($conn, $q);

    // use "iname" instead of "name"
    $sql = "SELECT iname FROM items WHERE iname LIKE '%$q%' LIMIT 10";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("SQL Error: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div onclick=\"setText('".$row['iname']."')\">" . $row['iname'] . "</div>";
        }
    } else {
        echo "<div>No product found</div>";
    }
}
?>
