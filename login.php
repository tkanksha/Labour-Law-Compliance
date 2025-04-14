<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'user_db';
$user = 'root'; // default user for XAMPP/WAMP
$pass = '';     // default is empty for XAMPP

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'] ?? ''; // Assuming username field = email
    $password = $_POST['password'] ?? '';

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify password (no hashing for now, assuming plain text)
        if (password_verify($password, $row['password'])){
            $_SESSION['username'] = $row['fullname']; // Or email
            header("Location: dashboard.html");
            exit();
        } else {
            echo "<script>alert('❌ Incorrect password'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('❌ User not found'); window.location.href='login.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
