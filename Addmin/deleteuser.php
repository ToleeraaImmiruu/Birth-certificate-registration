<?php
include "../setup/dbconnection.php";
$user_id =$_REQUEST["user_id"];
$sql = "DELETE FROM users WHERE id = $user_id";

 if($conn->query($sql)){
    echo "user are deleted seccusfully";
 }else{
    echo "user not deleted succesfuly";
 }




?>