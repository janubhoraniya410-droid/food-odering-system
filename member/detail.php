<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <style>
        /* ✅ Only for item detail page, unique class names */
        .item-container {
            width: 1000px;
            height:300px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2);
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .item-image {
            flex: 1;
        }

        .item-image img {
            width: 100%;
            max-width: 350px;
            height: 240px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
        }

        .item-details {
            flex: 2;
        }

        .item-details h2 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        .item-details p {
            margin: 15px 0;
            line-height: 1.6;
            color: #555;
        }

        .item-price {
            font-size: 22px;
            font-weight: bold;
            color: #e63946;
        }

        .item-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 20px;
            background: #ff6f00;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .item-btn:hover {
            background: #e65100;
            color:black;
        }


        .items-container {
    margin: 40px 100px;
    display: grid;
    grid-template-columns: repeat(4,1fr); /* 4 equal columns */
    gap: 30px; /* space between cards */
    padding: 20px;
    justify-items: center; /* center cards inside grid cells */
}

.items-card {
    width: 100%;
    max-width: 250px;   /* keeps cards from becoming too big */
    text-align: center;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    padding: 10px;
    transition: transform 0.3s;
}

.items-card:hover {
    transform: scale(1.05);
}

.items-card img {
    width: 100%;        /* fills card */
    height: 200px;      /* consistent height */
    border-radius: 10px;
    object-fit: cover;  /* prevents distortion */
    display: block;
}


        .items-card p {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

    </style>
</head>
<body>

<?php
  include("navbar.php");
  include("../conn.php");

  $id = $_GET['id'];

  $detail = "SELECT * FROM items WHERE id='$id'";
  $detail_run = mysqli_query($conn, $detail);

  if($detail_run && $row = mysqli_fetch_assoc($detail_run)) {
?>
    <div class="item-container">
        <div class="item-image">
            <img src="../admin/uploads/<?php echo $row['photo']; ?>" alt="<?php echo $row['iname']; ?>">
        </div>

        <div class="item-details">
            <h2><?php echo $row['iname']; ?></h2>
            <p><?php echo $row['des']; ?></p>
            <p class="item-price">₹<?php echo $row['price']; ?></p>

            <!-- Add to Cart Button -->

            <a href="/hunger_hub/member/cart.php?id=<?php echo $row['id']; ?>" class="item-btn">Add to Cart</a>

        </div>
    </div>
<?php
  } else {
      echo "<p style='text-align:center; color:red;'>Item not found.</p>";
  }
?>

<div class="items-container">

 <?php
       $item="SELECT * FROM items";
       $item_run=mysqli_query($conn,$item);

       if($item_run)
       {
         while($row = mysqli_fetch_assoc($item_run))
          { ?>
          
         <a href="detail.php?id=<?php echo $row['id']; ?>" style="text-decoration:none; color:black;">
 
            <div class="items-card">
            <img src="../admin/uploads/<?php echo $row['photo']; ?>"alt="<?php echo $row['iname']; ?>">
            <p><?php echo $row['iname'];?></p>
                     
        
          </div>

          </a>
            
        <?php  }

       }
       else{
         echo "error";
       }
 ?>
 </div>


</body>
</html>
