<?php

if (!session_id()) {
  session_start();
}

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if (!$_SESSION['Logged']) {
    header("Location: Index?return_url=" . $_SERVER['REQUEST_URI']);
    die();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $_SESSION["usr"]);

$stmt->execute();

$result = $stmt->get_result();
$query = $result->fetch_assoc();

$LoggedID = $query['id'];
$Nome = $query["name"];
$Email = $query["email"];
$Role = $query["id_role"];