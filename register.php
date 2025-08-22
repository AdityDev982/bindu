<?php
session_start();
include("db.php"); // This includes the $conn connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Hash the password before saving (important for security)
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

    // Use prepared statement to avoid SQL injection
    $sql = "INSERT INTO Users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $user, $hashedPass);

        if (mysqli_stmt_execute($stmt)) {
            // Registration successful → redirect to login
            header("Location: login.php");
            exit();
        } else {
            echo "❌ Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "❌ Error in SQL preparation: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
