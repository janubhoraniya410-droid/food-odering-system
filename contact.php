<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>

    .main {
      background-image: url('image/back_image.jpg'); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.6);
      min-height: 100vh;
      padding: 60px 20px;
    }

    .register-box {
      max-width: 700px;
      margin: auto;
      margin-top: 60px;
      padding: 30px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* Neumorphic style */
    .neumorphic {
      background: #e0e5ec;
      border-radius: 20px;
    }

    .neumorphic-card {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px;
      width: 100%;
      text-align: center;
    }

    .form-row {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      width: 100%;
    }

    .form-row .form-group {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    label {
      margin-bottom: 6px;
      font-size: 14px;
      text-align: left;
    }

    .neumorphic-input {
      width: 100%;
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
      padding: 12px 25px;
      font-size: 16px;
      border: none;
      outline: none;
      cursor: pointer;
      border-radius: 20px;
      background: #fc8019;
      box-shadow: 5px 5px 10px #a3b1c6,
                  -5px -5px 10px #ffffff;
      transition: background-color 0.3s, box-shadow 0.3s, transform 0.2s;
      color: white;
      width: 100%;
    }

    .neumorphic-button:hover {
      background: #ff9445;
      transform: translateY(-2px);
    }

    .neumorphic-button:active {
      background: #e56e0f;
      box-shadow: inset 5px 5px 10px #a3b1c6,
                  inset -5px -5px 10px #ffffff;
      transform: translateY(2px);
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

    @media (max-width: 680px) {
      .form-row {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

<div class="main">
<div class="overlay">
  <div class="register-box neumorphic neumorphic-card">
    <h2 class="main-heading" style="margin-bottom: 30px;">Contact</h2>

    <form action="contact_save.php" method="post">

      <!-- First Name & Last Name -->
      <div class="form-row">
        <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" name="fname" id="fname" class="neumorphic-input" required>
        </div>
        <div class="form-group">
          <label for="lname">Last Name</label>
          <input type="text" name="lname" id="lname" class="neumorphic-input" required>
        </div>
      </div>

      <!-- Email & Mobile -->
      <div class="form-row">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" id="email" class="neumorphic-input" required>
        </div>
        <div class="form-group">
          <label for="mobile">Mobile No</label>
          <input type="text" name="mobile" id="mobile" class="neumorphic-input" required pattern="[0-9]{10}" maxlength="10">
        </div>
      </div>

      <!-- Password & Confirm Password -->
      <div class="form-row">

        <div class="form-group">
          <label>Message</label>
          <input type="text-area" name="msg" id="msg" class="neumorphic-input" required>
        </div>
      </div>

      <button type="submit" name="send" class="neumorphic-button">Send Message</button>
    </form>


  </div>
</div>
</div>

</body>
</html>

<?php
include("footer.php");

?>
