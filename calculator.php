<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$result = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = floatval($_POST["num1"]);
    $num2 = floatval($_POST["num2"]);
    $operation = $_POST["operation"];

    switch ($operation) {
        case "add":
            $result = $num1 + $num2;
            break;
        case "subtract":
            $result = $num1 - $num2;
            break;
        case "multiply":
            $result = $num1 * $num2;
            break;
        case "divide":
            $result = ($num2 != 0) ? $num1 / $num2 : "❌ Error: Division by 0";
            break;
        default:
            $result = "❌ Invalid operation";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Hello, <?php echo htmlspecialchars($_SESSION["username"]); ?>! 👋 Simple Calculator</h2>
    
    <form method="post">
        <input type="number" step="any" name="num1" placeholder="First number" required>
        <select name="operation">
            <option value="add">+</option>
            <option value="subtract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" step="any" name="num2" placeholder="Second number" required>
        <button type="submit">Calculate</button>
    </form>

    <?php if ($result !== ""): ?>
        <p><strong>Result:</strong> <?php echo htmlspecialchars($result); ?></p>
    <?php endif; ?>

    <p><a href="logout.php">Logout</a></p>
</div>
</body>
</html>
