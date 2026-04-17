
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foody</title>
 

    <link rel="stylesheet" href="css/bootstrap5.min.css">
    <link rel="stylesheet" href="css/custom.css"> 
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"> -->

    <!-- AlertifyJS -->
     <link rel="stylesheet" href="assets/css/alertify.min.css"> 
    <!-- <link rel="stylesheet" href="assets/css/alertify-bootstrap.min.css"> -->
    
    
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css"> 
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    

</head>
<body>
<div id="loader"></div>
 
<script>
document.onreadystatechange = function () {
  var loader = document.getElementById("loader");
  setTimeout(function () {
    loader.style.display = "none";
  }, 2000);
};

</script>
<?php include('includes/navbar.php'); ?>