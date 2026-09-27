
<?php

require_once "includes/db.php";

$full_name = "Anchal";
$email = "Anchal@gmail.com";
$password = "Anchalisthebestteacher";

$password_hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users
        (full_name, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $pdo->prepare($sql);

try {
    $stmt->execute([
        $full_name,
        $email,
        $password_hash
    ]);

    echo "User successfully created!";

} catch (PDOException $e) {
    if ($e->getCode() === "23000") {
        echo "Email already registered.";
    } else {
        error_log($e->getMessage());
        echo "Failed to create user.";
    }
}

?>
