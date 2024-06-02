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

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    // Delete user
    $sql = "DELETE FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);

    if ($stmt->execute() === TRUE) {
        echo "Record deleted successfully";
        header("Location: display.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>