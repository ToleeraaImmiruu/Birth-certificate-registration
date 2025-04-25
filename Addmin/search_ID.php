<?php
header('Content-Type: application/json');
include "../setup/dbconnection.php";
$response =["succes" => false, "message"=> ""];
if(!isset($_POST["kebele_id"]) || empty($_POST["kebele_id"])){
    $response["message"] = " kebele id number is requred";
    echo json_encode($response);
    exit;
}
$kebele_id = $_POST["kebele_id"];
$sql



?>