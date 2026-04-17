<?php
session_start();
include("../conn.php");
include("navbar.php");


if (!isset($_SESSION['email'])) {
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch user data
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];

    $old_pass = $_POST['old_password'];
    $new_pass = $_POST['new_password'];

    // Password update section
    if (!empty($old_pass) && !empty($new_pass)) {

        // Verify old password
        if (password_verify($old_pass, $user['password'])) {

            $hashed = password_hash($new_pass, PASSWORD_DEFAULT);

            $update = "UPDATE users SET 
                        fname='$fname',
                        lname='$lname',
                        phone='$phone',
                        password='$hashed'
                       WHERE email='$email'";

            mysqli_query($conn, $update);
            $success = "Profile updated successfully!";

        } else {
            $error = "Old password is incorrect!";
        }

    } else {

        // Update only name + phone
        $update = "UPDATE users SET 
                    fname='$fname',
                    lname='$lname',
                    phone='$phone'
                   WHERE email='$email'";

        mysqli_query($conn, $update);
        $success = "Profile updated successfully!";
    }

    // Reload updated user data
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
 
</head>

<body>

<div class="container mt-5">
    <div class="card p-4 shadow" style="max-width: 550px; margin:auto;">
        <h3 class="text-center mb-4">My Profile</h3>

        <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

        <form method="POST">

            <label class="fw-bold">First Name</label>
            <input type="text" name="fname" class="form-control mb-3" value="<?= $user['fname']; ?>" required>

            <label class="fw-bold">Last Name</label>
            <input type="text" name="lname" class="form-control mb-3" value="<?= $user['lname']; ?>" required>

            <label class="fw-bold">Email (Cannot change)</label>
            <input type="email" class="form-control mb-3" value="<?= $user['email']; ?>" disabled>

            <label class="fw-bold">Phone</label>
            <input type="text" name="phone" class="form-control mb-3" value="<?= $user['phone']; ?>" required>

            <hr>

            <h5 class="mt-3">Change Password</h5>

            <label class="fw-bold">Old Password</label>
            <input type="password" name="old_password" class="form-control mb-3" placeholder="Enter old password">

            <label class="fw-bold">New Password</label>
            <input type="password" name="new_password" class="form-control mb-3" placeholder="Enter new password">

            <small class="text-muted">Leave password fields empty if you don't want to change password.</small>
            <br><br>

            <button type="submit" name="update" class="btn btn-warning w-100">Update Profile</button>
        </form>
    </div>
</div>

</body>
</html>
