<?php
session_start();
include 'database.php';

// Show all errors (for debugging during development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["username"]);
    $password_plain = $_POST["password"];
    $nickname = trim($_POST["nickname"]);

    // Basic validation
    if (empty($name) || empty($password_plain) || empty($nickname)) {
        $_SESSION["register_error"] = "❌ All fields are required.";
        $_SESSION["active_form"] = "register";
        header("Location: signin.php");
        exit();
    }

    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM users_data WHERE Name = ?");

    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Username already exists
        $_SESSION["register_error"] = "❌ Username already exists.";
        $_SESSION["active_form"] = "register";
        header("Location: signin.php");
        exit();
    } else {
        // Hash password
        $password_hashed = password_hash($password_plain, PASSWORD_DEFAULT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users_data (Name, Password, Nickname) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password_hashed, $nickname);

        if ($stmt->execute()) {
            // Signup success
            $_SESSION["register_success"] = "✅ Signup successful! Please login.";
            header("Location: login.php");
            exit();
        } else {
            // Insert failed
            $_SESSION["register_error"] = "❌ Signup failed: " . $stmt->error;
            $_SESSION["active_form"] = "register";
            header("Location: signin.php");
            exit();
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // Block direct access
    $_SESSION["register_error"] = "Invalid request method.";
    $_SESSION["active_form"] = "register";
    header("Location: signin.php");
    exit();
}
?>
