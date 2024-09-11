<?php
include("connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];

  $sql = "INSERT INTO request (name, email, req) VALUES (?, ?, ?)";

  $stmt = $mysqli->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("sss", $name, $email, $msg);
    $stmt->execute();
    $stmt->close();

    echo '<script type="text/javascript">
          alert("Request submitted successfully.");
          window.location.href = "index.html";
          </script>';
    exit();
  } else {
    echo "Error: " . $mysqli->error;
  }
}

$mysqli->close();
?>