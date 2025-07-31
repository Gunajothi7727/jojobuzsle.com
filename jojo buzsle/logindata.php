<?php
session_start();
include 'database.php';

// Show errors (for debugging during development only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $password = $_POST["password"];

    // Prepare SQL query
    $stmt = $conn->prepare("SELECT * FROM users_data WHERE Name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["Password"])) {
            // ✅ Login success
            $_SESSION["user"] = $name; // optional: store login
            header("Location: start.html");
            exit();
        } else {
            // ❌ Wrong password
            $_SESSION["login_error"] = "❌ Incorrect password.";
            header("Location: login.php");
            exit();
        }
    } else {
        // ❌ Username not found
        $_SESSION["login_error"] = "❌ User not found.";
        header("Location: login.php");
        exit();
    }

    // ✅ CLEANUP
    $stmt->close();
    $conn->close();
} else {
    // Block direct access
    $_SESSION["login_error"] = "Invalid request method.";
    header("Location: login.php");
    exit();
}
?>
