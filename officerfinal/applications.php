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
    <title>Application Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 1200px;
        }

        .header-card {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a252f 100%);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            color: white;
            padding: 1.5rem;
            margin-bottom: 2rem;
            text-align: center;
            border: none;
        }
        
        .header-card h2 {
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0;
        }
        
        .data-table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        
        .table thead {
            background-color: var(--primary-color);
            color: white;
        }
        
        .table thead th {
            padding: 1rem;
            text-align: center;
            vertical-align: middle;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody td {
            padding: 0.75rem;
            vertical-align: middle;
            border-color: #eee;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(13, 146, 79, 0.08);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        
        .btn-view {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.35rem 0.75rem;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-view:hover {
            background-color: #0b7a40;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(13, 146, 79, 0.3);
            color: white;
        }
        
        .btn-view i {
            margin-right: 5px;
        }
        
        .status-badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 600;
            border-radius: 50px;
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }
        
        @media (max-width: 768px) {
            .table-responsive {
                border-radius: 8px;
            }
            
            .header-card {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container py-4">
        <div class="header-card">
            <h2><i class="bi bi-people-fill"></i> User Applications Management</h2>
        </div>
        
        <div class="data-table">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>App ID</th>
                            <th>Full Name</th>
                            <th>Date of Birth</th>
                            <th>Place of Birth</th>
                            <th>Gender</th>
                            <th>Mother's Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr id="row-<?= $row['id']; ?>">
                                    <td class="fw-bold">#<?= $row['id']; ?></td>
                                    <td><?= $row['full_name']; ?></td>
                                    <td><?= date('M d, Y', strtotime($row['dob'])); ?></td>
                                    <td><?= $row['place_of_birth']; ?></td>
                                    <td><span class="badge bg-secondary"><?= $row['gender']; ?></span></td>
                                    <td><?= $row['mother_name']; ?></td>
                                    <td>
                                        <a href="updatdetailview.php?app_id=<?= $row['id'] ?>" class="btn-view">
                                            <i class="bi bi-file-earmark-text"></i> View
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-folder-x"></i>
                                        <h5>No applications found</h5>
                                        <p>There are currently no applications in the system</p>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
    </script>
</body>
</html>