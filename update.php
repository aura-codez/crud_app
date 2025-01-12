<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];

// Prevent SQL injection
$name = $conn->real_escape_string($name);
$email = $conn->real_escape_string($email);

$sql = "UPDATE userz SET name='$name', email='$email' WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php"); // Redirect to the home page after success
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
