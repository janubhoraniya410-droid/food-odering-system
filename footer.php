
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <style>

  .footer {
  background-color: #0a0a0aff;
  color: #fff;
  padding: 40px 0 20px;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  max-width: 1200px;
  height: 150px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-section {
  flex: 1 1 220px;
  margin: 20px;
}

.footer-section h2, .footer-section h3 {
  margin-bottom: 15px;
  color: #ff6347; 
}

.footer-section p, .footer-section li {
  font-size: 14px;
  line-height: 1.6;
}

.footer-section ul {
  list-style: none;
  padding: 0;
}

.footer-section ul li {
  margin-bottom: 10px;
}

.footer-section ul li a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

.footer-section ul li a:hover {
  color: #ff6347;
}

.social-icons a {
  margin-right: 10px;
  display: inline-block;
}

.social-icons img {
  width: 24px;
  height: 24px;
}

.footer-bottom {
  text-align: center;
  margin-top: 30px;
  font-size: 13px;
  color: #bbb;
  border-top: 1px solid #444;
  padding-top: 10px;
}

@media (max-width: 768px) {
  .footer-container {
    flex-direction: column;
    align-items: center;
  }

  .footer-section {
    margin: 20px 0;
    text-align: center;
  }
}


    </style>
</head>
<body>
    
</body>
</html>
<footer class="footer">
  <div class="footer-container">
    <!-- About Section -->
    <div class="footer-section about">
      <h2>Foodie Delight</h2>
      <p>Delicious meals delivered straight to your doorstep. Fresh, tasty, and made with love!</p>
    </div>

    <!-- Quick Links -->
    <div class="footer-section links">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
      
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

    <!-- Contact Info -->
    <div class="footer-section contact">
      <h3>Contact Us</h3>
      <p>Email: hungerhub9@gmail.com</p>
      <p>Phone: +91 12345 67890</p>
      <p>Address: 123 Food Street, Culinary City</p>
    </div>

    <!-- Social Media -->
    <div class="footer-section social">
      <h3>Follow Us</h3>
      <div class="social-icons">
        <a href="#"><img src="icons/facebook.svg" alt="Facebook"></a>
        <a href="#"><img src="icons/instagram.svg" alt="Instagram"></a>
        <a href="#"><img src="icons/twitter.svg" alt="Twitter"></a>
        <a href="#"><img src="icons/youtube.svg" alt="YouTube"></a>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 Foodie Delight. All rights reserved.</p>
  </div>
</footer>
