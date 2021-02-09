<?php
  require 'conn.php';

  if (isset($_GET["id"])) {
    $Id = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $Id);
    $stmt->execute();

  if (mysqli_affected_rows($conn) > 0) {
    echo "1";
  } else {
    echo "0";
  }
};