<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New User</h1>

        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color: red;'>{$_GET['error']}</p>";
        }
        ?>

        <form action="store.php" method="POST">
            <label for="name">Name:</label>
            <input 
                type="text" 
                id="name" 
                name="name" 
                placeholder="Enter your name" 
                required 
                pattern="[A-Za-z' -]{2,50}" 
                title="Name must be 2-50 characters long and can include letters, spaces, apostrophes (') and hyphens (-).">
            <br>
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                placeholder="Enter your email" 
                required 
                title="Please enter a valid email address.">
            <br>
            <button type="submit">Add User</button>
        </form>
        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</body>
</html>
