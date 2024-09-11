<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FNF Sports and Fashion</title>
  <link rel="stylesheet" href="login_signup.css">
</head>
<body>
  <header>
    <img src="logo-no-background.png" class="logo" height="55px">
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="fnf_shop.html">Shop</a></li>
        <li><a href="fnf_aboutus.html">About Us</a></li>
        <li><a href="fnf_request.html">Request merch</a></li>
        <li><a href="login.php">Log in</a></li>
      </ul>
    </nav>
  </header>
  <h1>Signup</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    
    <label for="bill_address">Billing Address:</label>
    <input type="text" id="bill_address" name="bill_address" required>
    <br><br>
    
    <input type="submit" value="Signup" class="login">
  </form>

  <?php
  include("connection.php");

  if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $billAddress = $_POST['bill_address'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (Username, Email, Passcode, Bill_Add) VALUES (?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);

    if ($stmt) {

      $stmt->bind_param("ssss", $username, $email, $hashedPassword, $billAddress);

      if ($stmt->execute()) {
        echo '<script type="text/javascript">
              alert("Signup success! You can now log in.");
              window.location.href = "login.php";
              </script>';
        exit();
      }
       else {
        echo '<script type="text/javascript">
        window.onload = function () { alert("Unable to create account. Please try again."); }</script>';
      }

      $stmt->close();
    }

    $mysqli->close();
  }
  ?>
  <footer>
    <p>&copy; 2023 FNF Sports and Fashion</p>
  </footer>

</body>
</html>