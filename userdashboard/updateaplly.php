<?php
session_start();
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

        if ($stmt->execute()) {
            // Store data in session for certificate generation
            $_SESSION['cert_data'] = [
                'first_name' => $firstname,
                'middle_name' => $middlename,
                'last_name' => $lastname,
                'dob' => $dob,
                'gender' => $gender,
                'birth_place' => $birth_place,
                'email' => $email,
                'address' => $address,
                'father_name' => $father_name,
                'mother_name' => $mother_name,
                'applicant_id_path' => $applicant_id_path
            ];
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

        .hidden {
            display: none;
        }

        /* Certificate Styles */
        .certificate-container {
            max-width: 800px;
            margin: 30px auto;
            display: none;
        }

        .certificate {
            background: #fff;
            border: 15px solid #5F9EA0;
            padding: 40px;
            position: relative;
        }

        .certificate::before {
            content: "OFFICIAL BIRTH CERTIFICATE";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 3rem;
            color: rgba(95, 158, 160, 0.1);
            font-weight: bold;
            z-index: 0;
            pointer-events: none;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .certificate-title {
            color: #5F9EA0;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .certificate-body {
            margin: 30px 0;
            position: relative;
            z-index: 1;
        }

        .certificate-row {
            display: flex;
            margin-bottom: 15px;
            align-items: flex-end;
        }

        .certificate-label {
            min-width: 200px;
            font-weight: 600;
            margin-right: 20px;
        }

        .certificate-value {
            border-bottom: 1px solid #333;
            flex-grow: 1;
            padding-bottom: 5px;
            min-height: 1.5rem;
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .signature-block {
            text-align: center;
            width: 200px;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin: 15px 0 5px;
            height: 30px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .form-section {
                display: none;
            }

            body {
                background: white;
                padding: 0;
            }

            .certificate {
                border: none;
                page-break-after: always;
            }
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
                    <label for="father_id_proof" class="form-label">Father's ID (JPG, PNG)</label>
                    <input type="file" class="form-control" id="father_id_proof" name="father_id_proof" accept=".pdf,.jpg,.png" required>
                </div>
                <div class="mb-3">
                    <label for="mother_id_proof" class="form-label">Mother's ID (JPG, PNG)</label>
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

    <!-- Certificate Output -->
    <div id="certificateContainer" class="certificate-container">
        <div class="certificate">
            <div class="certificate-header">
                <h1 class="certificate-title">Birth Certificate</h1>
                <p>Official Document</p>
            </div>

            <div class="certificate-body">
                <div class="certificate-row">
                    <div class="certificate-label">Full Name:</div>
                    <div class="certificate-value" id="certFullName"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Date of Birth:</div>
                    <div class="certificate-value" id="certDob"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Gender:</div>
                    <div class="certificate-value" id="certGender"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Place of Birth:</div>
                    <div class="certificate-value" id="certBirthPlace"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Father's Name:</div>
                    <div class="certificate-value" id="certFatherName"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Mother's Name:</div>
                    <div class="certificate-value" id="certMotherName"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Contact Information:</div>
                    <div class="certificate-value" id="certContact"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Address:</div>
                    <div class="certificate-value" id="certAddress"></div>
                </div>

                <div class="certificate-row">
                    <div class="certificate-label">Applicant ID:</div>
                    <div class="certificate-value" id="certApplicantId"></div>
                </div>
            </div>

            <div class="certificate-footer">
                <div class="signature-block">
                    <div class="signature-line"></div>
                    <p>Authorized Signatory</p>
                </div>
                <div class="signature-block">
                    <div class="signature-line"></div>
                    <p>Date of Issue: <span id="issueDate"></span></p>
                </div>
            </div>

            <div class="no-print text-center mt-4">
                <button id="printCertificate" class="btn btn-primary">Print Certificate</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            document.getElementById('applicationForm').addEventListener('submit', function(event) {
                let valid = true;
                let firstName = document.getElementById('first_name').value.trim();
                let lastName = document.getElementById('last_name').value.trim();
                let email = document.getElementById('email').value.trim();
                let address = document.getElementById('address').value.trim();

                if (!firstName || !lastName || !email || !address) {
                    valid = false;
                }

                if (!valid) {
                    alert('Please fill in all required fields.');
                    event.preventDefault();
                }
            });

            // Print certificate
            document.getElementById('printCertificate')?.addEventListener('click', function() {
                window.print();
            });

            // Check if we should show certificate (after successful submission)
            <?php if (isset($_SESSION['cert_data'])): ?>
                // Format date
                const formatDate = (dateString) => {
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    return new Date(dateString).toLocaleDateString('en-US', options);
                };

                // Get current date for issue date
                const today = new Date();
                const issueDate = formatDate(today);

                // Set certificate values from PHP session
                const certData = <?php echo json_encode($_SESSION['cert_data']); ?>;

                document.getElementById('certFullName').textContent =
                    `${certData.first_name} ${certData.middle_name ? certData.middle_name + ' ' : ''}${certData.last_name}`;
                document.getElementById('certDob').textContent =
                    formatDate(certData.dob);
                document.getElementById('certGender').textContent =
                    certData.gender;
                document.getElementById('certBirthPlace').textContent =
                    certData.birth_place;
                document.getElementById('certFatherName').textContent =
                    certData.father_name;
                document.getElementById('certMotherName').textContent =
                    certData.mother_name;
                document.getElementById('certContact').textContent =
                    `Email: ${certData.email}`;
                document.getElementById('certAddress').textContent =
                    certData.address;
                document.getElementById('issueDate').textContent = issueDate;
                document.getElementById('certApplicantId').textContent =
                    certData.applicant_id_path ? 'Provided' : 'Not provided';

                // Show certificate
                document.getElementById('certificateContainer').style.display = 'block';
                document.getElementById('certificateContainer').scrollIntoView({
                    behavior: 'smooth'
                });

                // Clear session data
                <?php unset($_SESSION['cert_data']); ?>
            <?php endif; ?>
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>