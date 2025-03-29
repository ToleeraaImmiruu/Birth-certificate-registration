    <?php
    session_start();
    include "../setup/dbconnection.php";

    $email = $_SESSION["email"];


    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();





    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>


        <a href="../public/logOut.php">logout</a>

        <img src="../uploads/<?php echo htmlspecialchars($profile_image); ?>" alt=""> ;

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Profile</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .profile-pic {
                    width: 150px;
                    height: 150px;
                    border-radius: 50%;
                    object-fit: cover;
                    border: 3px solid #fff;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                }
            </style>
        </head>

        <body>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <div class="card p-4 shadow-lg">
                            <img src="../assets/uploads/<?php echo htmlspecialchars($user["profile_image"]); ?>" alt="Profile Picture" class="profile-pic mb-3">
                            <h3><?php echo $user["first_name"] . " " . $user["last_name"] ?></h3>
                            <p>role: <?php echo $user["role"] ?></p>
                            <p>Email: <?php echo $user["email"] ?></p>
                            <p>Phone: <?php echo $user["phone"] ?></p>

                            <button class="btn btn-primary">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

        </html>


    </body>

    </html>