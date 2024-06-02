<?php
// Check if a session is not already active
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE matric = ?");
    if ($stmt === false) {
        die("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        // successful 
        $_SESSION['loggedin'] = true;
        header("Location: display.php");
        exit();
    } else {
        // failed
        $_SESSION['error'] = "Invalid username or password, try <a href='login.php'>login</a> again.";
        header("Location: login.php");
        exit();
    }

    // Close connection
    $stmt->close();
}

$conn->close();
?>
