<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>User Registration</title>
  <link rel="stylesheet" href="register.css">

  <?php
    // Initialize variables
    $message = "";
    $showForm = true;

    // Database connection details
    $servername = "localhost";
    $username = "root"; // Update this based on your XAMPP MySQL username
    $password = ""; // Update this based on your XAMPP MySQL password
    $dbname = "user_db"; // Database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = htmlspecialchars($_POST['fullname'] ?? '');
        $email = htmlspecialchars($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';

        if ($password !== $confirmPassword) {
            $message = "<p style='color: red;'>❌ Passwords do not match!</p>";
        } else {
            // Password hashing for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // SQL query to insert user data into the database
            $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hashedPassword')";

            if ($conn->query($sql) === TRUE) {
                $message = "<p style='color: green;'>✅ Registered Successfully! Redirecting to dashboard in 5 seconds...</p>";
                $showForm = false;

                // Redirect after 5 seconds
                echo '<meta http-equiv="refresh" content="5;url=dashboard.html">';
            } else {
                $message = "<p style='color: red;'>❌ Error: " . $conn->error . "</p>";
            }
        }
    }
    // Close the database connection
    $conn->close();
  ?>
</head>
<body>

<header>
  <h1>Register</h1>
</header>

<main class="form-container">

  <?php echo $message; ?>

  <?php if ($showForm): ?>
    <form action="register.php" method="post" class="auth-form">
      <h2>Create an Account</h2>

      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" required />

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required />

      <label for="confirmPassword">Confirm Password</label>
      <input type="password" id="confirmPassword" name="confirmPassword" required />

      <button type="submit">Register</button>

      <p class="form-footer">
        Already have an account? <a href="login.html">Login here</a>
      </p>
    </form>
  <?php endif; ?>

</main>

<footer>
  &copy; 2025 Labour Compliance Solutions
</footer>

</body>
</html>
