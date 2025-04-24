<?php
session_start();
include '../setup/dbconnection.php';
if (isset($_GET["app_id"]) && !empty($_GET["app_id"])) {
    $app_id = $_GET["app_id"];

    $sql = "SELECT father_id, mother_id, applicant_id, birth_record FROM aplications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $app_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        die("application isnot found");
    } else {
        $doc = $result->fetch_assoc();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .big-image {
            width: 100%;
            max-width: 500px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .small-images img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .small-images img:hover {
            transform: scale(1.1);
        }

        .container-custom {
            max-width: 800px;
            margin-top: 50px;
        }

        .not-uploaded {
            font-size: 14px;
            color: red;
            text-align: center;
        }

        .horizontal{
            display: flex;
            gap: 2rem;
        }
    </style>
</head>

<body>

    <div class="container text-center container-custom">
        <h2 class="mb-4 p-3 shadow-lg rounded bg-primary text-white text-center fw-bold">Uploaded Documents</h2>

        <!-- Large Center Image -->
        <div class="horizontal">
            <div class="d-flex justify-content-center">
                <!-- <img id="bigImage" src="placeholder.jpg" class="big-image" alt="Uploaded Image"> -->
                <img id="bigImage" class="big-image" src="<?= htmlspecialchars($doc['father_id']) ?>" onclick="changeImage(this.src)" alt="Father ID">
            </div>

            <!-- Smaller Images Below -->
            <div class="d-flex justify-content-center mt-3">
                <div class="d-flex flex-column align-items-center gap-3 small-images">
                    <img src="<?= htmlspecialchars($doc['mother_id'] ) ?>" onclick="changeImage(this.src)" alt="Mother ID">
                    <img src="<?= htmlspecialchars($doc['applicant_id']) ?>" onclick="changeImage(this.src)" alt="Applicant ID">
                    <img src="<?= htmlspecialchars($doc['birth_record']) ?>" onclick="changeImage(this.src)" alt="Birth Record">
                </div>
            </div>

        </div>


        <button class="btn btn-dark mt-4" onclick="history.back()">Back to Dashboard</button>
    </div>

    <script>
        function changeImage(newSrc) {
            document.getElementById("bigImage").src = newSrc;
        }
    </script>

</body>

</html>