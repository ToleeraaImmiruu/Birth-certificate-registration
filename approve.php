<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Path to Composer autoload

include '../setup/dbconnection.php';

if (isset($_POST['app_id'])) {
    $application_id = $_POST['app_id'];

    function generate_id()
    {
        global $conn;
        $year = date('y');
        $sql = "SELECT MAX(id) AS max_id FROM certificates";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $next_id = $row["max_id"] + 1;
        return "IBBC-" . str_pad($next_id, 4, '0', STR_PAD_LEFT) . "/" . $year;
    }


    $certificate_id = generate_id();

    $sql_insert = "INSERT INTO certificates (certificate_id,user_id, first_name, middle_name, last_name, dob, gender, place_of_birth, father_name, mother_name, current_address, issued_at) 
                   SELECT ?,user_id, first_name, middle_name, last_name, dob, gender, place_of_birth, father_name, mother_name, current_address,NOW()
                   FROM applications WHERE id = ?";


    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("si", $certificate_id, $application_id);

    if ($stmt_insert->execute()) {

        $sql = "SELECT user_id, email, CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name FROM applications WHERE id = ?";
        $stmt_get_email = $conn->prepare($sql);
        $stmt_get_email->bind_param("i", $application_id);
        $stmt_get_email->execute();
        $result = $stmt_get_email->get_result();
        $applicant = $result->fetch_assoc();

        $sql_delete = "DELETE FROM applications WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $application_id);

        if ($stmt_delete->execute()) {
  echo "deleted application succesfully";
           

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
