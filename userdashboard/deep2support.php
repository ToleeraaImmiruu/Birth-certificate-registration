<?php
include "../setup/dbconnection.php";


$password = generateRandomPassword();
echo $password;

if (isset($_POST["register_officer"])) {
    $fullName = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $password = generateRandomPassword();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO officers (full_name, email, username, phone, password ) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fullName, $email, $username, $phone, $hashed_password);
    if ($stmt->execute()) {
        sendmessage($email, $fullName, $password);



        // PHP code after successful hospital registration
        echo "
<div id='successPopup' style='
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #d1e7dd;
  color: #0f5132;
  padding: 15px 20px;
  border: 1px solid #badbcc;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  z-index: 9999;
'>
  ✅ officer registered successfully!
</div>
<script>
  setTimeout(function() {
    var popup = document.getElementById('successPopup');
    if (popup) popup.remove();
  }, 3000);
</script>
";
    }
}

if (isset($_POST["register_officer"])) {
    $fullName = $_POST["full_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $password = generateRandomPassword();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO officers (full_name, email, username, phone, password ) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $fullName, $email, $username, $phone, $hashed_password);
    if ($stmt->execute()) {
        sendmessage($email, $fullName, $password);



        // PHP code after successful hospital registration
        echo "
<div id='successPopup' style='
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #d1e7dd;
  color: #0f5132;
  padding: 15px 20px;
  border: 1px solid #badbcc;
  border-radius: 8px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  z-index: 9999;
'>
  ✅ kebele officer is registered successfully!
</div>
<script>
  setTimeout(function() {
    var popup = document.getElementById('successPopup');
    if (popup) popup.remove();
  }, 3000);
</script>
";
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #343a40;
        }

        .btn-create {
            width: 100%;
            padding: 10px;
            font-weight: 500;
            margin-top: 20px;
        }

        .role-section {
            display: none;
        }

        .role-section.active {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        .role-tabs .btn {
            width: 48%;
            font-weight: 500;
        }

        .role-tabs .btn.active {
            background-color: #0d6efd;
            color: white;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Create Role</h2>
            <div class="d-flex justify-content-between mb-4 role-tabs">
                <button type="button" class="btn btn-outline-primary me-2 active" id="officerButton">Officer</button>
                <button type="button" class="btn btn-outline-primary" id="kebeleAdminButton">Kebele Admin</button>
            </div>

            <!-- Officer Role Section -->
            <div class="role-section active" id="officerSection">
                <h4 class="mb-4 text-center">Officer Information</h4>
                <form id="roleForm" action="createrole.php" method="POST">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">full name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone number" class="form-label">phone number </label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <!-- <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
          </div> -->
                    <input type="hidden" id="roleType" value="officer">
                    <button type="submit" name="register_officer" class="btn btn-primary btn-create">register </button>
                </form>
            </div>

            <!-- Kebele Admin Role Section -->
            <div class="role-section" id="kebeleAdminSection">
                <h4 class="mb-4 text-center">Kebele Admin Information</h4>
                <form id="roleForm" action="createrole.php" method="POST">

                    <div class="mb-3">
                        <label for="full_name" class="form-label">full name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone number" class="form-label">phone number </label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <!-- <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
          </div> -->
                    <input type="hidden" id="roleType" value="kebeleAdmin">
                    <button type="submit" name="register_kebele_officer" ...>Register</button>

                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle between Officer and Kebele Admin sections
        const officerButton = document.getElementById('officerButton');
        const kebeleAdminButton = document.getElementById('kebeleAdminButton');
        const officerSection = document.getElementById('officerSection');
        const kebeleAdminSection = document.getElementById('kebeleAdminSection');

        officerButton.addEventListener('click', () => {
            officerSection.classList.add('active');
            kebeleAdminSection.classList.remove('active');
            officerButton.classList.add('active');
            kebeleAdminButton.classList.remove('active');
            document.getElementById('roleType').value = 'officer';
        });

        kebeleAdminButton.addEventListener('click', () => {
            kebeleAdminSection.classList.add('active');
            officerSection.classList.remove('active');
            kebeleAdminButton.classList.add('active');
            officerButton.classList.remove('active');
            document.getElementById('roleType').value = 'kebeleAdmin';
        });

        // Handle Form Submission
        document.querySelectorAll('#roleForm').forEach(form => {
            form.addEventListener('submit', function(event) {
                // event.preventDefault();
                const username = this.querySelector('#username').value;
                const password = this.querySelector('#password').value;
                const roleType = this.querySelector('#roleType').value;

                if (username && password) {
                    const roleName = roleType === 'officer' ? 'Officer' : 'Kebele Admin';
                    alert(`${roleName} Role Created!\nUsername: ${username}`);
                    // Add logic to save role (e.g., send data to the server)
                    // Reset form after submission
                    this.reset();
                } else {
                    alert('Please fill out all fields.');
                }
            });
        });
    </script>
</body>

</html>