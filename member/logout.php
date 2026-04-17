<?php
session_start();


    // session_destroy();
    unset(  $_SESSION['email']);
    unset( $_SESSION['user_id']);
 

   
    header("Location: ../login.php");
    exit(0);


?>