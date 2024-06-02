<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Database connection details
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

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Fetch current user details
    $sql = "SELECT * FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $role = $row['role'];
    } else {
        echo "No user found with matric: $matric";
        exit;
    }
} elseif (isset($_POST['update'])) {
    $old_matric = $_POST['old_matric'];
    $new_matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Update user details
    $sql = "UPDATE users SET matric=?, name=?, role=? WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $new_matric, $name, $role, $old_matric);

    if ($stmt->execute() === TRUE) {
        echo "Record updated successfully";
        header("Location: display.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST" action="update.php">
        <input type="hidden" name="old_matric" value="<?php echo $matric; ?>">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" value="<?php echo $matric; ?>" required><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>
        <label for="role">Role:</label>
        <input type="text" id="role" name="role" value="<?php echo $role; ?>" required><br><br>
        <input type="submit" name="update" value="Update">
        <a href="display.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>
