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
        <li><a href="signup.php">Sign up</a></li>
      </ul>
    </nav>
  </header>
  <h1>Login</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    
    <input type="submit" value="Login" class="login">
  </form>

  <?php
    include("connection.php");
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Retrieve the form data
      $username = $_POST['username'];
      $password = $_POST['password'];
    
      $sql = "SELECT * FROM users WHERE Username = ?";
    
      $stmt = $mysqli->prepare($sql);
    
      if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
    
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
          $row = $result->fetch_assoc();
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

          if (password_verify($password, $hashedPassword)) {
            session_start();
            $_SESSION['username'] = $username;
            echo '<script type="text/javascript">
                  alert("You are now logged in! Welcome Back!");
                  window.location.href = "fnf_shop.html";
                  </script>';
            exit();
          }
           else {
            echo '<script type="text/javascript">
            window.onload = function () { alert("Incorrect Password."); }</script>';
          }
        } else {
          echo '<script type="text/javascript">
          window.onload = function () { alert("User not found. Please recheck your info or signup"); }</script>';
        }

        $result->close();
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