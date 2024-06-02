<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table border="2">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        <?php
        // Database connection 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab_7";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT matric, name, role FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["matric"]. "</td>
                        <td>" . $row["name"]. "</td>
                        <td>" . $row["role"]. "</td>
                        <td>
                            <a href='update.php?matric=" . $row["matric"] . "'>Update</a> |
                            <a href='delete.php?matric=" . $row["matric"] . "'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
     <!-- Logout button -->
     <br><form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
