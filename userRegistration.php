<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Get form data
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("ssss", $matric, $name, $password, $role);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record created successfully.<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
