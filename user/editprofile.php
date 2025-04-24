<!-- <?php
session_start();
include "../setup/dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $user_id = $_SESSION["id"];
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $confirmpassword = $_POST["confirmnew"];

    $sql = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    if (!password_verify($oldpassword, $user["password"])) {
        echo "incoreect existing password";
    } elseif ($newpassword != $confirmpassword) {
        echo " the password is not match";
    } else {
        $hashedpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedpassword, $user_id);

        if ($stmt->execute()) {
            header("location: userdashboard.php");
            echo "the passwoord succesfuly update";
        } else {
            echo "unseccusfuly update";
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="editprofile.php" method="post">
        <input type="password" placeholder="old password" name="oldpassword">
        <input type="password" placeholder="new password" name="newpassword">
        <input type="password" placeholder=" confirm password" name="confirmnew">
        <input type="submit" name="submit">
    </form>
</body>

</html> -->