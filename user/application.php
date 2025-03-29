<?php
session_start();
include "../setup/dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

    $user_id = $_SESSION['user_id'];
    $full_name = $_POST['full_name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $birth_place = $_POST['birth_place'];
    $father_name = $_POST['father_name'];
    $mother_name = $_POST['mother_name'];
    $address = $_POST['address'];

    
    $parent_id = $_FILES['parent_id_proof']['name'];
    $applicant_id = $_FILES['applicant_id_proof']['name'];
    $HBC = $_FILES['birth_record']['name'];

   
    move_uploaded_file($_FILES['parent_id_proof']['tmp_name'], "uploads/" . $parent_id);
    move_uploaded_file($_FILES['applicant_id_proof']['tmp_name'], "uploads/" . $applicant_id);
    move_uploaded_file($_FILES['birth_record']['tmp_name'], "uploads/" . $HBC);

    $sql = "INSERT INTO applications (user_id, full_name, dob, gender, birth_place, father_name, mother_name, address, parents_id, applicant_id, birth_record) 
            VALUES ('$user_id', '$full_name','$dob','$gender','$birth_place','$father_name','$mother_name','$address','$parent_id','$applicant_id','$HBC')";

    if (mysqli_query($conn, $sql)) {
        header("Location: userdashboard.php");
        exit(); 
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Birth Certificate Application Form</h4>
                    </div>
                    <div class="card-body">
                        <form action="application.php" method="POST" enctype="multipart/form-data">

                           
                            <h5 class="text-primary">Personal Information</h5>
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" name="dob" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="birth_place" class="form-label">Place of Birth</label>
                                <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                            </div>

                           
                            <h5 class="text-primary">Parent Information</h5>
                            <div class="mb-3">
                                <label for="father_name" class="form-label">Father’s Full Name</label>
                                <input type="text" class="form-control" id="father_name" name="father_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="mother_name" class="form-label">Mother’s Full Name</label>
                                <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                            </div>

                        
                            <h5 class="text-primary">Contact Details</h5>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                    
                            <h5 class="text-primary">Supporting Documents</h5>
                            <div class="mb-3">
                                <label for="id_proof" class="form-label">father ID (JPG, PNG)</label>
                                <input type="file" class="form-control" id="parent_id_proof" name="parent_id_proof" accept=".jpg,.png" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_proof" class="form-label">applicant ID (JPG, PNG) if applicant is > 18 years old</label>
                                <input type="file" class="form-control" id="applicant_id_proof" name="applicant_id_proof" accept=".jpg,.png">
                            </div>
                            <div class="mb-3">
                                <label for="birth_record" class="form-label">Hospital Birth Record</label>
                                <input type="file" class="form-control" id="birth_record" name="birth_record" accept=".pdf,.jpg,.png">
                            </div>

                         
                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="agree" required>
                                <label class="form-check-label" for="agree">I confirm that all information provided is true and correct.</label>
                            </div>

                            <button type="submit" class="btn btn-primary w-100" name="submit">Submit Application</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>