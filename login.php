<?php
session_start();

require_once "includes/db.php";

$error = "";

if (isset($_SESSION["user_id"])) {
    header("Location: appointment.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $sql = "SELECT id, email, password_hash
            FROM users
            WHERE email = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password_hash"])) {

        session_regenerate_id(true);

        $_SESSION["user_id"] = (int) $user["id"];

        header("Location: appointment.php");
        exit;

    } else {
        $error = "Invalid email or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartClinic+ login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="loginbox">
        <h2>Login to SmartClinic</h2>

        <?php if ($error !== ""): ?>
            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form action="login.php" method="POST">

            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                autocomplete="email"
                required
            >

            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Login</button>

        </form>
    </div>
</body>
</html>
