<?php
// --- Database Connection ---
$host = "localhost";   // Default XAMPP/WAMP server
$user = "root";        // Default MySQL user
$pass = "";            // Leave empty for XAMPP
$db   = "penworld_db"; // Database name

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// --- Handle Form Submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Registration successful!</p>";
    } else {
        echo "<p style='color:red;'>❌ Error: " . $stmt->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | PenWorld</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Create Account</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Enter Username" required><br><br>
        <input type="email" name="email" placeholder="Enter Email" required><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
