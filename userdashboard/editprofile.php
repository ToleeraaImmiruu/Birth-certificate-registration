<?php
session_start();
include "../setup/dbconnection.php";

$email = $_SESSION["email"];
$user_id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $oldpassword = $_POST["oldpassword"];
    $newpassword = $_POST["newpassword"];
    $confirmpassword = $_POST["confirmpassword"];
    $phone = $_POST["phone"];
    // $password = $user["password"];


    if (!password_verify($oldpassword, $user["password"])) {
        echo "incorrect password ";
    } else if ($newpassword != $confirmpassword) {
        echo "the not match";
    } else {
        $hashedpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ?, phone = ? WHERE id= ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $hashedpassword, $phone, $user_id);
        $stmt->execute();
        header("location: user.php");
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="card p-4 shadow">
            <div class="text-center">
                <img src="../assets//uploads/<?php echo htmlspecialchars($user["profile_image"]) ?>" alt="Profile Image" class="rounded-circle" width="100">
                <h4 class="mt-2"><?php echo $user["first_name"] . " " . $user["last_name"] ?></h4>
            </div>


            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="<?php echo $user["email"] ?>" disabled>
            </div>


            <!-- Phone Number Section -->
            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <div class="d-flex">
                    <input type="text" id="phoneNumber" class="form-control" value="<?php echo $user["phone"] ?>" disabled>
                    <!-- <button type="button" class="btn btn-primary ms-2" onclick="editPhoneNumber()">Edit</button> -->
                </div>
            </div>

            <!-- Phone Number Edit -->
            <!-- <div id="phoneEditSection" class="mb-3 d-none">
                    <label class="form-label">New Phone Number</label>
                    <input type="text" id="newPhoneNumber" class="form-control">
                    <button type="button" class="btn btn-success mt-2" onclick="savePhoneNumber()">Save</button>
                </div> -->

            <!-- Change Password Button -->


            <!-- Change Password Section -->
            <button type="button" class="btn btn-warning w-100" onclick="showPasswordForm()">edit profile</button>
            <div id="passwordSection" class="mt-2 d-none">
                <form action="editprofile.php" method="post">
                    <label class="form-label">New Phone Number</label>
                    <input type="text" id="newPhoneNumber" name="phone" class="form-control">
                    <label class="form-label">Old Password</label>
                    <input type="password" class="form-control mb-2" name="oldpassword">
                    <label class="form-label">New Password</label>
                    <input type="password" class="form-control mb-2" name="newpassword">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control mb-2" name="confirmpassword">
                    <!-- <input type="submit" name="submit" value="save change"> -->
                    <input type="submit" name="submit" class="btn btn-success w-100">save change </input>

                </form>
            </div>

        </div>
    </div>

    <script>
        function editPhoneNumber() {
            document.getElementById("phoneEditSection").classList.remove("d-none");
        }

        function savePhoneNumber() {
            let newPhone = document.getElementById("newPhoneNumber").value;
            document.getElementById("phoneNumber").value = newPhone;
            document.getElementById("phoneEditSection").classList.add("d-none");
        }

        function showPasswordForm() {
            document.getElementById("passwordSection").classList.remove("d-none");
        }
    </script>

</body>

</html>