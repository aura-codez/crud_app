<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate inputs
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$errors = [];

// Validate name
if (empty($name) || !preg_match("/^[A-Za-z' -]{2,50}$/", $name)) {
    $errors[] = "Name must be 2-50 characters long and can include letters, spaces, apostrophes (') and hyphens (-).";
}

// Validate email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please provide a valid email address.";
}

// Handle validation errors
if (!empty($errors)) {
    $error_message = implode(" ", $errors);
    header("Location: create.php?error=" . urlencode($error_message));
    exit;
}

// Insert into database
$sql = "INSERT INTO userz (name, email) VALUES ('$name', '$email')";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    $error_message = "Error adding user: " . $conn->error;
    header("Location: create.php?error=" . urlencode($error_message));
}
$conn->close();
?>
