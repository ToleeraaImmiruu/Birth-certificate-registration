  <?php
    session_start();
    include '../setup/dbconnection.php';
    


    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {

        $firstname = trim($_POST["first_name"]);
        $lastname = trim($_POST["last_name"]);
        $phone = trim($_POST["phone"]);
        $password = trim($_POST["password"]);
        $email = trim($_POST["email"]);
        $confirm_password = trim($_POST['confirm_password']);

        $target_dir = "../assets/uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $profile_image = $_FILES['profile_image']['name'];
        $target_file = $target_dir . basename($profile_image);


        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            echo "Image uploaded successfully!";
        } else {
            echo "Error uploading image!";
        }






        if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm_password)) {
            die("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format.");
        }

        if ($password !== $confirm_password) {
            die("Passwords do not match.");
        }


        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE  email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            die("Username or email already exists.");
        }

        $sql = "INSERT INTO users (first_name, last_name,email,phone, password, profile_image) VALUES ('$firstname', '$lastname', '$email','$phone','$hashed_password','$profile_image')";
        if (mysqli_query($conn, $sql)) {
            header("location: ../userdashboard/user.php");
            echo "Registration successful!";
        } else {
            header("location: login.php");
            echo "Error: " . mysqli_error($conn);
        }
        $_SESSION["email"] = $_POST["email"];
        mysqli_close($conn);
    }


    ?>


  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Signup | Birth Certificate System</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body class="bg-light">

      <div class="container">
          <div class="row justify-content-center">
              <div class="col-md-6">
                  <div class="card mt-5 shadow">
                      <div class="card-header bg-primary text-white text-center">
                          <h4>Sign Up</h4>
                      </div>
                      <div class="card-body">
                          <form action="signUp.php" method="POST" enctype="multipart/form-data">

                              <div class="mb-3">
                                  <label for="first_name" class="form-label">First Name</label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" required>
                              </div>

                              <div class="mb-3">
                                  <label for="last_name" class="form-label">middle Name</label>
                                  <input type="text" class="form-control" id="last_name" name="last_name" required>
                              </div>
                              <div class="mb-3">
                                  <label for="current_address" class="form-label">current Name</label>
                                  <input type="text" class="form-control" id="current_address" name="current_address" required>
                              </div>

                              <div class="mb-3">
                                  <label for="email" class="form-label">Email Address</label>
                                  <input type="email" class="form-control" id="email" name="email" required>
                              </div>

                              <div class="mb-3">
                                  <label for="phone" class="form-label">Phone Number</label>
                                  <input type="tel" class="form-control" id="phone" name="phone" required>
                              </div>

                              <div class="mb-3">
                                  <label for="password" class="form-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                              <div class="mb-3">
                                  <label for="confirm_password" class="form-label">Confirm Password</label>
                                  <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                              </div>

                              <div class="mb-3">
                                  <label for="profile_image" class="form-label">Profile Image (Optional)</label>
                                  <input type="file" class="form-control" id="profile_image" name="profile_image">
                              </div>

                              <button type="submit" class="btn btn-primary w-100" name="submit">Register</button>

                              <div class="text-center mt-3">
                                  <small>Already have an account? <a href="login.php">Login here</a></small>
                              </div>

                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>



      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>

  </html>