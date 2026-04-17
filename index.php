<?php
include("navbar.php");
include("conn.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
          .carousel-item img {
      height: 80vh;              /* Adjust height */
      width: 100%;          
    }

        .food-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 30px;
    padding: 20px;
    margin: 40px auto;   
    max-width: 1200px;  
    justify-items: center;
}

.food-item {
    width: 100%;
    max-width: 250px;   
    text-align: center;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
    padding: 10px;
    transition: transform 0.3s;
}

.food-itemr:hover {
    transform: scale(1.05);
}

.food-item img {
    width: 100%;       
    height: 200px;     
    border-radius: 10px;
    object-fit: cover;  
    display: block;
}


        .food-item p {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

         </style>
</head>
<body>
    <div id="carouselExampleSlidesOnly" class="carousel slide"  data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="image/back_image.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/slider2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="image/slider3.avif" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

  <div class="food-container">
    <?php
    $query = "SELECT * FROM items ORDER BY RAND() LIMIT 8";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="food-item">';
        echo '<img src="admin/uploads/' . htmlspecialchars($row['photo']) . '" alt="Food Image">';
        echo '<div class="food-name">' . htmlspecialchars($row['iname']) . '</div>';
        echo '</div>';
      }
    } else {
      echo '<p class="text-center">No items found.</p>';
    }
    ?>
    </div>
</body>



</html>

<?php
include("footer.php");

?>
