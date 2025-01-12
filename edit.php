<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        // JavaScript form validation
        function validateForm() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var nameRegex = /^[A-Za-z\s]+$/;
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

            // Validate name (only letters and spaces)
            if (!nameRegex.test(name)) {
                alert("Please enter a valid name (letters and spaces only).");
                return false;
            }

            // Validate email format
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>

        <?php
        $conn = new mysqli('localhost', 'root', '', 'crud_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $_GET['id'];
        $sql = "SELECT * FROM userz WHERE id=$id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        ?>

        <form action="update.php" method="POST" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            <br>

            <button type="submit">Update User</button>
        </form>

        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
