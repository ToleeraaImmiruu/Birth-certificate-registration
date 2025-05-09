<?php
require 'init.php';

include "../setup/dbconnection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $target_dir = "../assets/uploads/";
    function uploadfile($inputname, $target_dir)
    {
        if (!empty($_FILES[$inputname]["name"])) {
            $filename = basename($_FILES[$inputname]["name"]);
            $filetype = strtolower(pathinfo($_FILES[$inputname]["name"], PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "pdf");
            if (in_array($filetype, $allowedTypes)) {
                $filepath = $target_dir . time() . "_" . $filename;
                if (move_uploaded_file($_FILES[$inputname]["tmp_name"], $filepath)) {
                    return $filepath;
                } else {
                    echo " error ";
                }
            } else {
                echo "invalid type";
            }
        } else {
            return null;
        }
    }

    if (isset($_SESSION["id"])) {
        $user_id = $_SESSION["id"];

        $father_id_path = uploadfile("father_id_proof", $target_dir);
        $mother_id_path = uploadfile("mother_id_proof", $target_dir);
        $applicant_id_path = uploadfile("applicant_id_proof", $target_dir);
        $birth_record_path = uploadfile("birth_record", $target_dir);
        $firstname = $_POST["first_name"];
        $middlename = $_POST["middle_name"];
        $lastname = $_POST["last_name"];
        $dob = $_POST["dob"];
        $gender = $_POST["gender"];
        $birth_place = $_POST["birth_place"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $father_name = $_POST["father_name"];
        $mother_name = $_POST["mother_name"];

        $sql = "INSERT INTO aplications ( user_id,first_name ,middle_name ,last_name ,dob,gender,place_of_birth,father_name,mother_name ,curent_address,father_id,mother_id,applicant_id,birth_record) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssssssss", $user_id, $firstname, $middlename, $lastname, $dob, $gender, $birth_place, $father_name, $mother_name, $address, $father_id_path, $mother_id_path, $applicant_id_path, $birth_record_path);

        echo $father_id_path;
        echo $mother_id_path;
        if ($stmt->execute()) {
            header("location: user.php");
        } else {
            header("location: status.php");
        }
    } else {
        header("location: ../public/login.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 600px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card shadow p-4">
            <h4 class="text-center text-primary">Birth Certificate Application</h4>
            <form id="applicationForm" method="post" action="apply.php" enctype="multipart/form-data">
                <h5 class="text-primary">Personal Information</h5>
                <div class="mb-3">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                </div>
                <div class="mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                </div>
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
                <div class="mb-3">
                    <label for="birth_place" class="form-label">Place of Birth</label>
                    <input type="text" class="form-control" id="birth_place" name="birth_place" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <h5 class="text-primary">Contact Details</h5>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="father_name" class="form-label">Father's Full Name</label>
                    <input type="text" class="form-control" id="father_name" name="father_name" required>
                </div>
                <div class="mb-3">
                    <label for="mother_name" class="form-label">Mother's Full Name</label>
                    <input type="text" class="form-control" id="mother_name" name="mother_name" required>
                </div>

                <h5 class="text-primary">Supporting Documents</h5>
                <div class="mb-3">
                    <label for="parent_id_proof" class="form-label">Father's ID (JPG, PNG)</label>
                    <input type="file" class="form-control" id="father_id_proof" name="father_id_proof" accept=".pdf,.jpg,.png" required>
                </div>
                <div class="mb-3">
                    <label for="parent_id_proof" class="form-label">Mother's ID (JPG, PNG)</label>
                    <input type="file" class="form-control" id="mother_id_proof" name="mother_id_proof" accept=".pdf,.jpg,.png" required>
                </div>
                <div class="mb-3">
                    <label for="applicant_id_proof" class="form-label">Applicant ID (JPG, PNG) if applicant is > 18 years old</label>
                    <input type="file" class="form-control" id="applicant_id_proof" name="applicant_id_proof" accept=".pdf,.jpg,.png">
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

    <script>
        document.getElementById('applicationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            clearErrors();

            let isValid = validateTextFields() &&
                validateDateFields() &&
                validateEmail() &&
                validateFileUploads() &&
                validateCheckbox();

            if (isValid) {
                if (confirm('Are you sure you want to submit this application? All information should be accurate.')) {
                    this.submit();
                }
            }
        });

        function clearErrors() {
            document.querySelectorAll('.is-invalid').forEach(el => {
                el.classList.remove('is-invalid');
            });
            document.querySelectorAll('.invalid-feedback').forEach(el => {
                el.remove();
            });
        }

        function validateTextFields() {
            let isValid = true;
            const requiredFields = [
                'first_name', 'last_name', 'birth_place',
                'address', 'father_name', 'mother_name'
            ];

            requiredFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                const value = field.value.trim();

                if (!value) {
                    showError(field, 'This field is required');
                    isValid = false;
                } else if (value.length > 100) {
                    showError(field, 'Maximum 100 characters allowed');
                    isValid = false;
                }
            });
            return isValid;
        }

        function validateDateFields() {
            let isValid = true;
            const dobField = document.getElementById('dob');
            const dobValue = dobField.value;

            if (!dobValue) {
                showError(dobField, 'Date of birth is required');
                return false;
            }

            const dobDate = new Date(dobValue);
            const today = new Date();
            let age = today.getFullYear() - dobDate.getFullYear();
            const monthDiff = today.getMonth() - dobDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }

            if (dobDate > today) {
                showError(dobField, 'Date of birth cannot be in the future');
                isValid = false;
            }

            if (age < 0 || age > 120) {
                showError(dobField, 'Please enter a valid date of birth');
                isValid = false;
            }

            const genderField = document.getElementById('gender');
            if (!genderField.value) {
                showError(genderField, 'Please select a gender');
                isValid = false;
            }

            return isValid;
        }

        function validateEmail() {
            const emailField = document.getElementById('email');
            const emailValue = emailField.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailValue) {
                showError(emailField, 'Email is required');
                return false;
            }

            if (!emailRegex.test(emailValue)) {
                showError(emailField, 'Please enter a valid email address');
                return false;
            }

            return true;
        }

        function validateFileUploads() {
            let isValid = true;
            const today = new Date();
            const dobValue = document.getElementById('dob').value;
            const dobDate = new Date(dobValue);
            let age = today.getFullYear() - dobDate.getFullYear();
            const monthDiff = today.getMonth() - dobDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
                age--;
            }

            const requiredFiles = [{
                    id: 'father_id_proof',
                    label: "Father's ID proof"
                },
                {
                    id: 'mother_id_proof',
                    label: "Mother's ID proof"
                }
            ];

            if (age >= 18) {
                requiredFiles.push({
                    id: 'applicant_id_proof',
                    label: "Applicant's ID proof"
                });
            }

            requiredFiles.forEach(fileInfo => {
                const fileField = document.getElementById(fileInfo.id);
                const file = fileField.files[0];

                if (!file) {
                    showError(fileField, `${fileInfo.label} is required`);
                    isValid = false;
                } else {
                    const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    const fileType = file.type;
                    const fileExt = file.name.split('.').pop().toLowerCase();

                    if (!allowedTypes.includes(fileType) && !['jpg', 'jpeg', 'png', 'pdf'].includes(fileExt)) {
                        showError(fileField, 'Only JPG, PNG, or PDF files are allowed');
                        isValid = false;
                    }

                    if (file.size > 5 * 1024 * 1024) {
                        showError(fileField, 'File size must be less than 5MB');
                        isValid = false;
                    }
                }
            });

            const birthRecordField = document.getElementById('birth_record');
            if (birthRecordField.files.length > 0) {
                const file = birthRecordField.files[0];
                const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                const fileType = file.type;
                const fileExt = file.name.split('.').pop().toLowerCase();

                if (!allowedTypes.includes(fileType) && !['jpg', 'jpeg', 'png', 'pdf'].includes(fileExt)) {
                    showError(birthRecordField, 'Only JPG, PNG, or PDF files are allowed');
                    isValid = false;
                }

                if (file.size > 5 * 1024 * 1024) {
                    showError(birthRecordField, 'File size must be less than 5MB');
                    isValid = false;
                }
            }

            return isValid;
        }

        function validateCheckbox() {
            const agreeCheckbox = document.getElementById('agree');

            if (!agreeCheckbox.checked) {
                showError(agreeCheckbox, 'You must confirm that all information is true and correct');
                return false;
            }

            return true;
        }

        function showError(element, message) {
            element.classList.add('is-invalid');
            const errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback';
            errorElement.textContent = message;

            if (element.type === 'checkbox') {
                element.closest('.form-check').appendChild(errorElement);
            } else {
                element.parentNode.appendChild(errorElement);
            }
        }

        document.querySelectorAll('input[type="text"], input[type="email"], textarea').forEach(field => {
            field.addEventListener('input', function() {
                const value = this.value.trim();
                if (value) {
                    this.classList.remove('is-invalid');
                    const errorElement = this.nextElementSibling;
                    if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                        errorElement.remove();
                    }
                }
            });
        });

        document.getElementById('dob').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const errorElement = this.nextElementSibling;
            if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                errorElement.remove();
            }
        });

        document.getElementById('gender').addEventListener('change', function() {
            this.classList.remove('is-invalid');
            const errorElement = this.nextElementSibling;
            if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                errorElement.remove();
            }
        });

        document.querySelectorAll('input[type="file"]').forEach(field => {
            field.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
                    const fileType = file.type;
                    const fileExt = file.name.split('.').pop().toLowerCase();

                    if (allowedTypes.includes(fileType) || ['jpg', 'jpeg', 'png', 'pdf'].includes(fileExt)) {
                        this.classList.remove('is-invalid');
                        const errorElement = this.nextElementSibling;
                        if (errorElement && errorElement.classList.contains('invalid-feedback')) {
                            errorElement.remove();
                        }
                    }
                }
            });
        });

        document.getElementById('agree').addEventListener('change', function() {
            if (this.checked) {
                this.classList.remove('is-invalid');
                const errorElement = this.closest('.form-check').querySelector('.invalid-feedback');
                if (errorElement) {
                    errorElement.remove();
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>