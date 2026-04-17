<?php 
session_start();

include('conn.php');

if(isset($_POST['login']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];

    if(!empty($email) && !empty($password))
    {

        $login_code = "select id,email,password from users where email='$email' ";
        $result = mysqli_query($conn, $login_code);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // If password is plain text (Not recommended)
              if (password_verify($password, $user['password'])) {

                //  Store session data
                $_SESSION['email'] = $user['email'];
                $_SESSION['user_id'] = $user['id'];

                // Redirect based on ID
                if ($user['id'] == 1) {
                    header("Location: admin/deshbord.php");
                } 
                else {
                    header("Location: member/index.php");
                }
                exit();

            } else {
                echo "<script>alert('Invalid password!'); window.location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('No user found with this email!'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Please fill all fields!'); window.location.href='login.php';</script>";
    }
}
?>