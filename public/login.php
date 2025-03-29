<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">


    <div class="card shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>

        <form action="login.php" method="POST">
            <!-- Email Input -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Password Input -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100" name="login">Login</button>
        </form>

        <p class="mt-3 text-center">
            Don't have an account? <a href="signUp.php">Sign Up</a>
        </p>
    </div>

    <?php
    session_start(); // Start session for user login

    include '../setup/dbconnection.php'; // Include database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Prepare the SQL statement to prevent SQL Injection
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            if (password_verify($password, $user["password"])) {
                // Store user session
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["role"] = $user["role"]; // Store role for admin/user handling
                $_SESSION["email"] = $user["email"];

                // Redirect based on user role
                if ($user["role"] === "admin") {
                    header("Location: admin.php");
                } else {
                    header("location: ../user/userdashboard.php");
                }
                exit;
            } else {
                echo "<script>alert('Incorrect password!');</script>";
                
            }
        } else {
            echo "<script>alert('User not found! Please sign up.');</script>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

</body>

</html>