<?php include("navbar.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

    .main
    {
      background-image: url('image/back_image.jpg'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .overlay {

      background-color: rgba(0, 0, 0, 0.6);
      padding: 60px 20px;

    }

    .login-box {
      max-width: 500px;
      margin-top: 100px;
      margin-left:450px;
     
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    .signin-link {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .signin-link a {
      color: #fc8019;
      font-weight: 500;
    }

    
/* General neumorphic style */
.neumorphic {
  background: #e0e5ec;
  border-radius: 20px;

}

/* Neumorphic Inset */
.neumorphic-inset {
  background: #e0e5ec;
  border-radius: 20px;
  box-shadow: inset 10px 10px 20px #a3b1c6,
              inset -10px -10px 20px #ffffff;
}

/* Card */
.neumorphic-card {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 30px;
  width: 450px;
  height: 400px;
  text-align: center;
}

/* Input Fields */
.neumorphic-input {
  width: 100%;
  margin: 10px 0;
  padding: 10px 15px;
  border: none;
  outline: none;
  font-size: 16px;
  border-radius: 20px;
  background: #e0e5ec;
  box-shadow: inset 5px 5px 10px #a3b1c6,
              inset -5px -5px 10px #ffffff;
}

/* Button */
.neumorphic-button {
  margin-top: 15px;
  padding: 10px 25px;
  font-size: 16px;
  border: none;
  outline: none;
  cursor: pointer;
  border-radius: 20px;
  background: #fc8019;
  box-shadow: 5px 5px 10px #a3b1c6,
              -5px -5px 10px #ffffff;
transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
  color:white;
}

.neumorphic-button:active {
background: #e56e0f; /* darker orange */
  box-shadow: inset 5px 5px 10px #a3b1c6,
              inset -5px -5px 10px #ffffff;
  transform: translateY(2px);
}

.neumorphic-button:hover {
  background: #ff9445; /* lighter orange */
  transform: translateY(-2px);
}

   
  </style>
</head>
<body>

<div class="main">

<div class="overlay">
  <div class="login-box">
    
    <form action="login_code.php" method="post">

    <div class="neumorphic neumorphic-card">
    <h2 class="main-heading text-center" style="text-align: center; margin-bottom: 30px;">Login</h2>

    <input type="text" class="neumorphic neumorphic-input" placeholder="Email" id="email" name="email" required>
    <input type="password" class="neumorphic neumorphic-input" placeholder="Password" id="password" name="password" required>
    <button class="neumorphic neumorphic-button" name="login" id="login">Login</button>

    
    <div class="signin-link">
      Don't have an account? <a href="regi.php" >Sign up</a>
    </div>
  </div>
    </form>


  </div>
</div>
</div>

</body>
</html>
<?php
include("footer.php");

?>
