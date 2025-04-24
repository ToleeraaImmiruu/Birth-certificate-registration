<?php
session_start();
include "../setup/dbconnection.php";


if (!isset($_SESSION["id"])) {
    header:
    "location:../public/login.php";
} else {
    $user_id = $_SESSION["id"];
}



// First, check the certificates table
$sql = "SELECT * FROM certificates WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Certificate exists
    $cert = $result->fetch_assoc();

    echo '
<div class="container">
    <div class="card shadow p-4">
        <h4 class="text-center text-primary">Application Status</h4>
        <div id="statusContainer" class="status-box approved">✅ Your application is approved.</div>
        <div id="certificateButtonContainer" class="text-center mt-4">
            <a href="updatedcertificate.php" class="btn btn-success">View Certificate</a>
        </div>
    </div>
</div>';
} else {
    // No certificate, check application status
    $sql = "SELECT * FROM applications WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $app = $result->fetch_assoc();
        $status = $app["status"];
        echo $status;

        if ($status == "Pending") {

            echo '
               <div class="container">
                  <div class="card shadow p-4">
                      <h4 class="text-center text-primary">Application Status</h4>
                      <div id="statusContainer" class="status-box pending"> ⏳ Your application is pending. </div>
                      <div id="certificateButtonContainer" class="text-center mt-3">we notify you by your email</div>
                  </div>
               </div>
            ';
        } elseif ($status == "regect") {


            echo '
               <div class="container">
                  <div class="card shadow p-4">
                      <h4 class="text-center text-primary">Application Status</h4>
                      <div id="statusContainer" class="status-box pending"> ❌ Your application is regect. </div>
                      <div id="certificateButtonContainer" class="text-center mt-3"></div>
                  </div>
               </div>
            ';
        } else {
            echo "ℹ️ Application status: " . $status;
        }
    } else {

        echo '
               <div class="container">
                  <div class="card shadow p-4">
                      <h4 class="text-center text-primary">Application Status</h4>
                      <div id="statusContainer" class="status-box pending">  you are not apply for birth certificate yet </div>
                      <div id="certificateButtonContainer" class="text-center mt-3 approved btn btn-succes">apply now</div>
                  </div>
               </div>
            ';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate Status</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 20px;
        }

        .status-box {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }

        .approved {
            background-color: #d4edda;
            color: #155724;
        }

        .declined {
            background-color: #f8d7da;
            color: #721c24;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>

<body>
    <!-- 
    <div class="container">
        <div class="card shadow p-4">
            <h4 class="text-center text-primary">Application Status</h4>
            <div id="statusContainer" class="status-box pending">Your application is pending.</div>
            <div id="certificateButtonContainer" class="text-center mt-3"></div>
        </div>
    </div> -->

    <script>
        // // Simulated status retrieval (Replace this with actual API call if needed)
        // document.addEventListener("DOMContentLoaded", function() {
        //     $sql = "select"
        //     let status = "approved"; // Example: Change this to "approved" or "declined" dynamically
        //     let statusContainer = document.getElementById("statusContainer");
        //     let certificateButtonContainer = document.getElementById("certificateButtonContainer");

        //     if (status === "approved") {
        //         statusContainer.textContent = "Your application has been approved.";
        //         statusContainer.classList.remove("pending", "declined");
        //         statusContainer.classList.add("approved");

        //         // Add the view certificate button
        //         let viewCertificateButton = document.createElement("button");
        //         viewCertificateButton.classList.add("btn", "btn-success");
        //         viewCertificateButton.textContent = "View Certificate";
        //         viewCertificateButton.onclick = function() {
        //             // Replace with the actual link to view the certificate

        //         };
        //         certificateButtonContainer.appendChild(viewCertificateButton);
        //     } else if (status === "declined") {
        //         statusContainer.textContent = "Your application has been declined.";
        //         statusContainer.classList.remove("pending", "approved");
        //         statusContainer.classList.add("declined");
        //     }
        // });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>