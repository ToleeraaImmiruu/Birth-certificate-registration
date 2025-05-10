<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer autoload

include '../setup/dbconnection.php';

if (isset($_GET['approve_id'])) {
    $application_id = $_GET['approve_id'];

    $sql_insert = "INSERT INTO certificates (user_id, first_name, middle_name, last_name, dob, gender, place_of_birth, father_name, mother_name, curent_address, email) 
                   SELECT user_id, first_name, middle_name, last_name, dob, gender, place_of_birth, father_name, mother_name, current_address, email 
                   FROM applications WHERE id = ?";

    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("i", $application_id);

    if ($stmt_insert->execute()) {

        $sql = "SELECT email, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name FROM applications WHERE id = ?";
        $stmt_get_email = $conn->prepare($sql);
        $stmt_get_email->bind_param("i", $application_id);
        $stmt_get_email->execute();
        $result = $stmt_get_email->get_result();
        $applicant = $result->fetch_assoc();

        $sql_delete = "DELETE FROM applications WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $application_id);

        if ($stmt_delete->execute()) {

            // Send Email with PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'bonsadaba8@gmail.com'; // Your Gmail
                $mail->Password   = 'nfcg vsoa oyhm etyv';    // Your App Password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('bonsadaba8@gmail.com', 'Certificate Office');
                $mail->addAddress($applicant["email"], $applicant["full_name"]);

                $mail->Subject = 'Your certificate is approved!';
                $mail->Body    = "Hello {$applicant["full_name"]},\n\nYour application is approved. You can check your status on your dashboard.\n\nThank you!";

                $mail->send();
                echo "Certificate approved and email sent successfully!";
            } catch (Exception $e) {
                echo "Certificate approved, but email failed: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error deleting application: " . $conn->error;
        }

        $stmt_delete->close();
    } else {
        echo "Error inserting into certificates: " . $conn->error;
    }

    $stmt_insert->close();
    $conn->close();
}
