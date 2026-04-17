<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hunger Hub</title>
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/custom.css">
  <style>
    /* Hunger Hub brand styling */
    .navbar-brand h2 {
      font-family: "Poppins", sans-serif;
      font-weight: 800;
      font-size: 28px;
      background: linear-gradient(90deg, #ff7a18, #ff3d81);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin: 0;
      letter-spacing: 1px;
    }

    .navbar {
      padding: 12px 0;
    }

    .navbar-light .nav-link {
      font-weight: 500;
      color: #ff7a18 !important;
      transition: color 0.3s ease, transform 0.3s ease;
    }

    .navbar-light .nav-link:hover {
      color: #ff7a18 !important;
      transform: translateY(-2px);
    }

    .btn-outline-dark:hover {
      background: linear-gradient(90deg, #ff7a18, #ff3d81);
      color: #fff;
      border: none;
    }

    .btn-outline-warning {
      border-color: #ff7a18;
      color: #ff7a18;
    }

    .btn-outline-warning:hover {
      background-color: #ff7a18;
      color: #fff;
    }

    #login:hover{
      background: linear-gradient(90deg, #ff7a18, #ff3d81);
      color: #fff;
      border: none;
    }


  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">

      <!-- Brand Name -->
      <a class="navbar-brand d-flex align-items-center" href="index.php">
        <h2>Hunger Hub</h2>
      </a>



      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left side menu -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-3">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
          <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>
          <li class="nav-item"><a class="nav-link" href="cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="orders.php">My Order</a></li>


        </ul>

        <!-- Search Bar -->
        <form action="search.php" method="GET" class="d-flex me-3">
          <input class="form-control me-2" name="keyword" type="search" placeholder="Search food...">
          <button type="submit" class="btn btn-outline-warning">Search</button>
        </form>


        <!-- Login/Register -->

        <form action="../login.php" method="POST" class="d-flex me-3">
          
          <button type="submit" class="btn btn-outline-warning">Logout</button>
        </form>

        <form action="profile.php" method="POST" class="d-flex me-3">
          
          <button type="submit" class="btn btn-outline-warning">Profile</button>
        </form>
        

        
      </div>
    </div>
  </nav>



  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
