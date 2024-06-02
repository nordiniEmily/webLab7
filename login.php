<?php
//start
session_start();

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to a different page if the user is already logged in
    header("Location: display.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>
        <form action="loginVerify.php" method="post">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        <br>
        <a href="registration.php">Register here if you have not.</a>
    </div>
</body>
</html>
