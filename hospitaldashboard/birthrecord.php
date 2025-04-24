<?php
include "../setup/dbconnection.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

function generateId(){
  global $conn;
  $year = date('y');
  $sql = "SELECT MAX(id) AS max_id FROM birth_records";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();
  $id = $result->fetch_assoc();
  $next_id = $id["max_id"] + 1;
  return "HBR-".str_pad($next_id,4,"0", STR_PAD_LEFT)."/".$year;

}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $hospital = 1;
  $record_id = generateId();
  $childname = $_POST["child_full_name"];
  $dob = $_POST["dob"];
  $pob = $_POST["pob"];
  $tob = $_POST["tob"];
  $gender = $_POST["gender"];
  $weight = $_POST["weight"] ?: 0.0; // default weight
  $fatherName = $_POST["father_name"];
  $motherName = $_POST["mother_name"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $nameofdoctor = $_POST["name_of_doctor"];

  $sql = "INSERT INTO birth_records(record_id,hospital_id,child_name, dob, pob, tob, gender, weight, father_name, mother_name, phone, address, nameOfDoctor)
            VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("isssssdsssss", $record_id,$hospital_id, $childname, $dob, $pob, $tob, $gender, $weight, $fatherName, $motherName, $phone, $address, $nameofdoctor);

  try {
    if ($stmt->execute()) {
      echo "Successfully registered.";
    }
  } catch (Exception $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Form not submitted.";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Birth Certificate Application</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    html,
    body {
      display: flex;
      flex-direction: column;
      height: 100%;
      margin: 0;
      padding: 0;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      overflow: hidden;

    }

    .hospital-header {
      background-color: #005b96;
      color: white;
      padding: 20px 0;
      border-bottom: 5px solid #ffc107;
    }

    .form-container {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      padding: 25px;
      height: 82vh;
      overflow-y: auto;
    }

    .form-title {
      color: #005b96;
      border-bottom: 2px solid #ffc107;
      padding-bottom: 10px;
      margin-bottom: 25px;
    }

    .btn-submit {
      background-color: #005b96;
      border-color: #005b96;
      padding: 10px 25px;
      font-weight: 600;
    }

    .btn-submit:hover {
      background-color: #004274;
      border-color: #004274;
    }
  </style>
</head>

<body>
  <div class="hospital-header text-center wd-100">
    <h1><i class="fas fa-hospital me-2"></i> CITY GENERAL HOSPITAL</h1>
    <p class="mb-0">Birth Registration Department</p>
  </div>

  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="form-container">
          <h2 class="form-title"><i class="fas fa-certificate me-2"></i>Birth Certificate Application</h2>
          <form id="birthRecordForm" action="" method="POST">
            <!-- Newborn Information Section -->
            <fieldset class="mb-4">
              <legend class="fw-bold text-primary">Newborn Information</legend>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="newbornName" class="form-label">Full Name of Newborn</label>
                  <input type="text" class="form-control" name="child_full_name" id="newbornName" placeholder="e.g. Hana Dinku" required />
                </div>
                <div class="col-md-3">
                  <label for="dob" class="form-label">Date of Birth</label>
                  <input type="date" class="form-control" name="dob" id="dob" required />
                </div>
                <div class="col-md-3">
                  <label for="timeOfBirth" class="form-label">Time of Birth</label>
                  <input type="time" class="form-control" name="tob" id="timeOfBirth" />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="gender" class="form-label">Gender</label>
                  <select class="form-select" name="gender" id="gender" required>
                    <option value="">Select Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label for="weight" class="form-label">Birth Weight (kg)</label>
                  <input type="number" class="form-control" name="weight" id="weight" min="2" max="8" step="0.5" />
                </div>
              </div>
            </fieldset>

            <!-- Parent Information Section -->
            <fieldset class="mb-4">
              <legend class="fw-bold text-primary">Parent Information</legend>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="fatherName" class="form-label">Father's Full Name</label>
                  <input type="text" class="form-control" name="father_name" id="fatherName" placeholder="e.g. Dinku Guta" required />
                </div>
                <div class="col-md-6">
                  <label for="motherName" class="form-label">Mother's Full Name</label>
                  <input type="text" class="form-control" name="mother_name" id="motherName" placeholder="e.g. Aster Geleta" required />
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="parentContact" class="form-label">Contact Number</label>
                  <input type="tel" class="form-control" name="phone" id="parentContact" placeholder="0953935589" required />
                </div>
                <div class="col-md-6">
                  <label for="parentAddress" class="form-label">Residential Address</label>
                  <input type="text" class="form-control" name="address" id="parentAddress" required />
                </div>
              </div>
            </fieldset>

            <!-- Birth Details Section -->
            <fieldset class="mb-4">
              <legend class="fw-bold text-primary">Birth Details</legend>
              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="placeOfBirth" class="form-label">Place of Birth</label>
                  <select class="form-select" name="pob" id="placeOfBirth" required>
                    <option value="">Select Place of Birth</option>
                    <option value="hospital">This Hospital</option>
                    <option value="other_hospital">Other Hospital</option>
                    <option value="home">Home</option>
                    <option value="other">Other</option>
                  </select>
                </div>
                <!-- Removed specificPlace -->
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="attendantName" class="form-label">Name of Attendant (Doctor/Nurse)</label>
                  <input type="text" class="form-control" name="name_of_doctor" id="attendantName" />
                </div>
              </div>

              <!-- <div class="mb-3">
                <label for="additionalNotes" class="form-label">Additional Notes</label>
                <textarea class="form-control" name="additional_note" id="additionalNotes" rows="3"></textarea>
              </div> -->
            </fieldset>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
              <button type="submit" name="submit" class="btn btn-primary btn-submit">
                <i class="fas fa-paper-plane me-2"></i>Submit Application
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script>
    document.getElementById('birthRecordForm').addEventListener('submit', function (e) {
      // e.preventDefault();

      const newbornName = document.getElementById('newbornName').value.trim();
      const fatherName = document.getElementById('fatherName').value.trim();
      const motherName = document.getElementById('motherName').value.trim();
      const contact = document.getElementById('parentContact').value.trim();

      const nameRegex = /^[A-Za-z\s]+$/;
      if (!nameRegex.test(newbornName)) {
        alert("Newborn name must contain only letters.");
        return;
      }
      if (!nameRegex.test(fatherName)) {
        alert("Father's name must contain only letters.");
        return;
      }
      if (!nameRegex.test(motherName)) {
        alert("Mother's name must contain only letters.");
        return;
      }

      const contactRegex = /^\d{10}$/;
      if (!contactRegex.test(contact)) {
        alert("Contact number must be exactly 10 digits (e.g. 0953935589).");
        return;
      }

      // alert('Application submitted successfully!');
    }); -->
  </script>
</body>

</html>