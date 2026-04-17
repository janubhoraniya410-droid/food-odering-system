<?php
include("navbar.php");
include("../conn.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

h2 {
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    color: #333;
}

/* --- Category Section --- */
.category-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 50px; /* space between items */
  margin: 40px auto 20px;
  max-width: 1200px;
}

.category-card {
  text-align: center;
  margin: 10px;
}

.category-card img {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  box-shadow: 0 4px 8px rgba(0,0,0,0.15);
  transition: transform 0.3s, box-shadow 0.3s;
}

.category-card img:hover {
  transform: scale(1.1);
  box-shadow: 0 6px 15px rgba(0,0,0,0.25);
}

.category-card p {
  margin-top: 10px;
  font-weight: 600;
  color: #222;
  text-transform: capitalize;
}

/* --- Food Items Section --- */
.item-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 30px;
    padding: 30px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.item-card {
    text-align: center;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.15);
    padding: 10px;
    transition: transform 0.3s, box-shadow 0.3s;
}

.item-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 6px 15px rgba(0,0,0,0.25);
}

.item-card img {
    width: 100%;
    height: 180px;
    border-radius: 10px;
    object-fit: cover;
}

.item-card p {
    margin-top: 10px;
    font-weight: bold;
    color: #333;
}


    </style>
</head>
<body>
    <h2> What's on your mind</h2>
<div class="category-container">
    <?php 
    $query = "SELECT * FROM category";
    $query_run = mysqli_query($conn, $query);
    $selected_category = isset($_GET['cid']) ? $_GET['cid'] : null;

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) { ?>
            <a href="menu.php?cid=<?php echo $row['cid']; ?>" style="text-decoration:none; color:black;">
                <div class="category-card">
                    <img src="../admin/<?php echo $row['photo']; ?>" alt="<?php echo $row['cname']; ?>">
                    <p><?php echo $row['cname']; ?></p>
                </div>
            </a>
    <?php } 
    } else {
        echo "<p style='color:red;'>Error fetching categories</p>";
    }
    ?>
</div>

    <div class="item-container">

    <?php
    if($selected_category)
    {
         $items="SELECT * FROM items where cid='$selected_category' ";
    }
    else
    {
          $items="SELECT * FROM items";

    }
       $items_run = mysqli_query($conn,$items);

       if($items_run)
       {
          while($row = mysqli_fetch_assoc($items_run))
          { ?>
          
         <a href="detail.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:black;">
 
            <div class="item-card">
            <img src="../admin/uploads/<?php echo $row['photo']; ?>"alt="<?php echo $row['iname']; ?>">
            <p><?php echo $row['iname'];?></p>
                     
        
          </div>

          </a>
            
        <?php  }

       }?>

    </div>


   
</body>
</html>
<?php
include("../footer.php");

?>
