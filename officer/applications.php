<?php

include "../setup/dbconnection.php";
$sql = "SELECT id, CONCAT(first_name, ' ', middle_name,' ', last_name) AS full_name, dob, place_of_birth, gender,father_name, mother_name, current_address FROM applications";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: auto;
            padding: auto;
        }

        .container {
            max-width: 1000px;

        }

        .hidden {
            display: none;

        }

        .visible {
            display: block;
        }
    </style>
</head>

<body>

    <div class="container mt-5 d-flex flex-column justify-content-center align-items-center">
        <h2 class="mb-4 p-3 shadow-lg rounded bg-primary text-white text-center fw-bold">User Applications</h2>
        <table class="table table-bordered shadow-lg table-striped table-hover table-sm text-center">
            <thead>
                <tr>
                    <th>App ID</th>
                    <th>Full Name</th>
                    <th>Date of Birth</th>
                    <th>Place of Birth</th>
                    <th>Gender</th>
                    <th>Mother Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr id="row-<?= $row['id']; ?>">
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['full_name']; ?></td>
                            <td><?= $row['dob']; ?></td>
                            <td><?= $row['place_of_birth']; ?></td>
                            <td><?= $row['gender']; ?></td>
                            <td><?= $row['mother_name']; ?></td>
                            <td>
                                <!-- Button to view documents (assumes you have a page to display docs) -->
                                <a href="updatdetailview.php?app_id=<?= $row['id'] ?>" id="viewdcoment" class="btn btn-info btn-sm">View Document</a>
                                <!-- Approve button -->
                                <!-- <button class="btn btn-success btn-sm approveBtn" onclick="approved(<?= $row['id']; ?>)" data-appid="<?= $row['id']; ?>">Approve</button>
                                <!-- Reject button -->
                                <!-- <button class="btn btn-danger btn-sm rejectBtn" onclick="regectfunction(<?= $row['id']; ?>)" data-appid="<?= $row['id']; ?>">Reject</button> -->

                                <!-- <button class="btn btn-danger" onclick="document.getElementById('rejectPopUp').style.display='block'">
                                    reject
                                </button> --> 

                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="7">No applications found.</td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>


    <script>
        function approved(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200 && xmlhttp.responseText.trim() === "Certificate approved and email sent successfully!") {
                        document.getElementById("row-" + id).remove();
                        alert("Certificate approved and email sent successfully!");
                    } else {
                        alert("Error: " + xmlhttp.responseText);
                    }
                }

            }
            xmlhttp.open("GET", "approved.php?approve_id=" + id, true);
            xmlhttp.send();
        }




        function regectfunction(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                    document.getElementById("row-" + id).remove();
                }
            }
            xmlhttp.open("GET", "regect.php?user_id=" + id, true);
            xmlhttp.send();


        }
    </script>



    <div style="display:none;position: fixed; top:0; left:0; background-color:rgba(0,0,0,4);width:100%;height:100%;" id="rejectPopUp">
        <div class="card">
            <div class="card-header">
                Title
            </div>
            <div class="card-body">

                <button type="button" onclick="submitting()">submit</button>
                <button class="btn btn-danger" onclick="document.getElementById('rejectPopUp').style.display='none'">
                    close
                </button>

            </div>
        </div>

    </div>

</body>

</html>