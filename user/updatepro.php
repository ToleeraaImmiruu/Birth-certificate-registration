<?php
session_start();
include "../setup/dbconnection.php";

$user_id = $_SESSION["id"]; // Ensure this is correctly set

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update_password"])) {
        $oldpassword = $_POST["oldpassword"];
        $newpassword = $_POST["newpassword"];
        $confirmpassword = $_POST["confirmnew"];

        // Fetch current password
        $sql = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Verify old password
        if (!password_verify($oldpassword, $user["password"])) {
            $_SESSION["error_message"] = "Incorrect existing password";
            header("Location: editprofile.php");
            exit;
        } elseif ($newpassword != $confirmpassword) {
            $_SESSION["error_message"] = "Passwords do not match";
            header("Location: editprofile.php");
            exit;
        } else {
            // Hash new password and update
            $hashedpassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $hashedpassword, $user_id);

            if ($stmt->execute()) {
                $_SESSION["success_message"] = "Password updated successfully!";
            } else {
                $_SESSION["error_message"] = "Password update failed!";
            }
            header("Location: editprofile.php");
            exit;
        }
    }

    // Handle profile updates (name, phone, etc.)
    if (isset($_POST["update_profile"])) {
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $phone = $_POST["phone"];

        $sql = "UPDATE users SET first_name = ?, last_name = ?, phone = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $first_name, $last_name, $phone, $user_id);

        if ($stmt->execute()) {
            header("location: userdashboard.php");
            $_SESSION["success_message"] = "Profile updated successfully!";
        } else {
            $_SESSION["error_message"] = "Profile update failed!";
        }
        header("Location: userdashboard.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>

<body>
    <h2>Edit Profile</h2>

    <?php
    if (isset($_SESSION["success_message"])) {
        echo "<p style='color: green'>" . $_SESSION["success_message"] . "</p>";
        unset($_SESSION["success_message"]);
    }

    if (isset($_SESSION["error_message"])) {
        echo "<p style='color: red'>" . $_SESSION["error_message"] . "</p>";
        unset($_SESSION["error_message"]);
    }
    ?>

    <!-- Profile Update Form -->
    <form action="editprofile.php" method="post">
        <input type="text" placeholder="First Name" name="first_name" required>
        <input type="text" placeholder="Last Name" name="last_name" required>
        <input type="text" placeholder="Phone" name="phone" required>
        <input type="submit" name="update_profile" value="Update Profile">
    </form>

    <hr>

    <!-- Password Update Form -->
    <form action="editprofile.php" method="post">
        <input type="password" placeholder="Old Password" name="oldpassword" required>
        <input type="password" placeholder="New Password" name="newpassword" required>
        <input type="password" placeholder="Confirm Password" name="confirmnew" required>
        <input type="submit" name="update_password" value="Change Password">
    </form>
</body>

</html>