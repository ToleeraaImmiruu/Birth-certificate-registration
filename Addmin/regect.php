<?php
include "../setup/dbconnection.php";

$user_id = $_GET["user_id"];

$sql = "DELETE FROM applications WHERE id = $user_id";

if ($conn->query($sql)) {
    $notify = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
    $msg = "Your certificate application has been rejected!";
    $stmt = $conn->prepare($notify);
    $stmt->bind_param("is", $user['id'], $msg);
    $stmt->execute();
    echo "Application rejected successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>


