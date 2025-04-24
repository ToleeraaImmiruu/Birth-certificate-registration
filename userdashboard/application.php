<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Application Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Birth Application Form</h2>
        <form action="submit_application.php" method="POST" enctype="multipart/form-data">
            <!-- Applicant Details -->
            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Middle Name</label>
                <input type="text" class="form-control" name="middle_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required onchange="checkApplicantAge()">
            </div>
            <div class="mb-3">
                <label class="form-label">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Father's Information -->
            <h4>Father's Information</h4>
            <div class="mb-3">
                <label class="form-label">Father's Name</label>
                <input type="text" class="form-control" name="father_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Is Father Alive?</label>
                <select class="form-control" id="fatherStatus" onchange="toggleFatherFields()" required>
                    <option value="">Select</option>
                    <option value="alive">Alive</option>
                    <option value="deceased">Deceased</option>
                </select>
            </div>
            <div id="fatherAlive" class="mb-3">
                <label class="form-label">Father's ID</label>
                <input type="file" class="form-control" name="father_id">
            </div>
            <div id="fatherDeceased" class="mb-3" style="display: none;">
                <label class="form-label">Father's Death Certificate</label>
                <input type="file" class="form-control" name="father_death_certificate">
            </div>

            <!-- Mother's Information -->
            <h4>Mother's Information</h4>
            <div class="mb-3">
                <label class="form-label">Mother's Name</label>
                <input type="text" class="form-control" name="mother_name">
            </div>
            <div class="mb-3">
                <label class="form-label">Is Mother Alive?</label>
                <select class="form-control" id="motherStatus" onchange="toggleMotherFields()" required>
                    <option value="">Select</option>
                    <option value="alive">Alive</option>
                    <option value="deceased">Deceased</option>
                </select>
            </div>
            <div id="motherAlive" class="mb-3">
                <label class="form-label">Mother's ID</label>
                <input type="file" class="form-control" name="mother_id">
            </div>
            <div id="motherDeceased" class="mb-3" style="display: none;">
                <label class="form-label">Mother's Death Certificate</label>
                <input type="file" class="form-control" name="mother_death_certificate">
            </div>

            <!-- Guardian Information (If Both Parents Are Deceased) -->
            <div id="guardianSection" style="display: none;">
                <h4>Guardian Information</h4>
                <div class="mb-3">
                    <label class="form-label">Guardian's Name</label>
                    <input type="text" class="form-control" name="guardian_name">
                </div>
                <div class="mb-3">
                    <label class="form-label">Guardian's ID</label>
                    <input type="file" class="form-control" name="guardian_id">
                </div>
            </div>

            <!-- Applicant ID (Only If Age >= 18) -->
            <div id="applicantIdSection" class="mb-3" style="display: none;">
                <label class="form-label">Applicant's ID</label>
                <input type="file" class="form-control" name="applicant_id">
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Birth Certificate (if available)</label>
                <input type="file" class="form-control" name="birth_record">
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>

    <script>
        function toggleFatherFields() {
            let status = document.getElementById("fatherStatus").value;
            document.getElementById("fatherAlive").style.display = (status === "alive") ? "block" : "none";
            document.getElementById("fatherDeceased").style.display = (status === "deceased") ? "block" : "none";
            checkGuardianRequirement();
        }

        function toggleMotherFields() {
            let status = document.getElementById("motherStatus").value;
            document.getElementById("motherAlive").style.display = (status === "alive") ? "block" : "none";
            document.getElementById("motherDeceased").style.display = (status === "deceased") ? "block" : "none";
            checkGuardianRequirement();
        }

        function checkGuardianRequirement() {
            let fatherStatus = document.getElementById("fatherStatus").value;
            let motherStatus = document.getElementById("motherStatus").value;
            document.getElementById("guardianSection").style.display = (fatherStatus === "deceased" && motherStatus === "deceased") ? "block" : "none";
        }

        function checkApplicantAge() {
            let dob = document.getElementById("dob").value;
            if (!dob) return;

            let birthDate = new Date(dob);
            let today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            document.getElementById("applicantIdSection").style.display = (age >= 18) ? "block" : "none";
        }
    </script>
</body>

</html>