<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to a different page if the user is already register
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
</head>
<body>
<h2>Registration</h2>
    <form action="userRegistration.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="">Please select</option>
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select><br><br>

        <input type="submit" name="submit" value="Submit">
    </form>
    <a href="login.php"><button type="button">Back to Login</button></a>
</body>
</html>
