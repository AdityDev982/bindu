<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // Prepared statement to get hashed password from DB
    $sql = "SELECT password FROM Users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $user);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $hashedPass);

        if (mysqli_stmt_fetch($stmt)) {
            // Verify entered password against hashed password
            if (password_verify($pass, $hashedPass)) {
                $_SESSION["username"] = $user;
                header("Location: home.php");
                exit();
            } else {
                echo "❌ Invalid username or password!";
            }
        } else {
            echo "❌ Invalid username or password!";
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
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Enter Username" required><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Don’t have an account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
