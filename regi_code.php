<?php 
session_start();

include('conn.php');
include('send_email.php');

if (isset($_POST['regi'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // ✅ Check password match
    if ($password != $confirm_password) {
        $_SESSION['message'] = "Password and Confirm Password do not match";
        header("Location: regi.php");
        exit();
    }

    // ✅ Check if email already exists
    $checkemail = "SELECT email FROM users WHERE email='$email'";
    $checkemail_run = mysqli_query($conn, $checkemail);

    if (mysqli_num_rows($checkemail_run) > 0) {
        $_SESSION['message'] = "Email already registered";
        header("Location: regi.php");
        exit();
    }

    // ✅ Allow only Gmail addresses (basic check)
    if (!preg_match("/^[A-Za-z0-9._%+-]+@gmail\.com$/", $email)) {
        $_SESSION['message'] = "Only Gmail addresses are allowed";
        header("Location: regi.php");
        exit();
    }

    // ✅ Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Insert into database
    $user_query = "INSERT INTO users (fname, lname, email, phone, password, created_at) 
                   VALUES ('$fname', '$lname', '$email', '$mobile', '$hashed_password', NOW())";
    $user_query_run = mysqli_query($conn, $user_query);

    if ($user_query_run) {
        // ✅ Send welcome email
        if (sendWelcomeEmail($email, $fname . ' ' . $lname)) {
            $_SESSION['message'] = "Registered Successfully & Welcome Email Sent";
        } else {
            $_SESSION['message'] = "Registered Successfully but Email could not be sent";
        }
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "Database Insert Failed: " . mysqli_error($conn);
        header("Location: regi.php");
        exit();
    }
} else {
    header("Location: regi.php");
    exit();
}
?>
