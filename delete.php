<?php
$conn = new mysqli('localhost', 'root', '', 'crud_db');
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
$id = $_GET['id'];
$sql = "DELETE FROM userz WHERE id=$id";
if ($conn->query($sql) === TRUE) {
 header("Location: index.php");
} else {
 echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>