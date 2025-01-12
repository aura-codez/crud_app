<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Application</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        // JavaScript function to confirm deletion
        function confirmDelete(id) {
            const confirmation = confirm("Are you sure you want to delete this user?");
            if (confirmation) {
                window.location.href = 'delete.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>CRUD Application</h1>

        <!-- Search Form -->
        <form method="GET" action="index.php">
            <input 
                type="text" 
                name="query" 
                placeholder="Search by name or email" 
                value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" 
                required 
                title="Enter a name or email to search">
            <button type="submit">Search</button>
        </form>

        <a href="create.php">Add New User</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = new mysqli('localhost', 'root', '', 'crud_db');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if a search query is provided
                $sql = "SELECT * FROM userz";
                if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
                    $query = $conn->real_escape_string($_GET['query']);
                    $sql = "SELECT * FROM userz WHERE name LIKE '%$query%' OR email LIKE '%$query%'";
                }

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>
                                <a href='edit.php?id={$row['id']}' class='edit'>Edit</a>
                                <a href='javascript:void(0);' class='delete' onclick='confirmDelete({$row['id']})'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No records found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
