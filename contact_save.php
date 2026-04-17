<?php
include("conn.php"); 

if (isset($_POST['send'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['mobile']);
    $msg = mysqli_real_escape_string($conn, $_POST['msg']);

    $sql = "INSERT INTO contact (fname, lname, email, phone_no, msg) 
            VALUES ('$fname', '$lname', '$email', 'mobile', '$msg')";

    if (mysqli_query($conn, $sql)) {
       
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
