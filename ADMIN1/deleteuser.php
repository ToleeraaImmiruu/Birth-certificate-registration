<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include "../setup/dbconnection.php";
$user_id =$_REQUEST["user_id"];
$reason = $_REQUEST["reason"];



 $sql = "SELECT email, CONCAT(first_name, middle_name, last_name) AS full_name FROM users WHERE id = $user_id";
 $result = $conn->query($sql);
 if($result->num_rows > 0){
   $user = $result->fetch_assoc();
   
}


$sql = "DELETE FROM users WHERE id = $user_id";

 if($conn->query($sql)){
   $mail = new PHPMailer(true);

   try {
      $mail->isSMTP();
      $mail->Host       = 'smtp.gmail.com';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'bonsadaba8@gmail.com';
      $mail->Password   = 'nfcg vsoa oyhm etyv';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;

      $mail->setFrom('bonsadaba8@gmail.com', 'Certificate Office');
      $mail->addAddress($user["email"], $user["full_name"]);

      $mail->Subject = 'Your account  is DELETED!';
      $mail->Body    = "Hello {$user["full_name"]},\n\nYour account  is deleted. because of {$reason}\n\nThank you!";

      $mail->send();


      
   } catch (Exception $e) {
      echo "Certificate approved, but email failed: {$mail->ErrorInfo}";
   }
} else {
   echo "Error deleting application: " . $conn->error;
}

 




?>