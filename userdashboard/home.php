<?php
require "../userdashboard/init.php";
include "../setup/dbconnection.php";
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["id"]);
$stmt->execute();
$result =$stmt->get_result();
$user =$result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Birth Certificate System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', sans-serif;
        }

        .dashboard-container {
            padding: 2rem;
            max-width: 1200px;
            margin: auto;
        }

        .welcome-box {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .stats-card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .announcement-box {
            background-color: white;
            border-left: 5px solid #3498db;
            padding: 1.5rem;
            border-radius: 10px;
        }

        .fa-stack {
            vertical-align: top;
        }

        @media (max-width: 768px) {
            .stats-card {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container me-4">
        <div class="welcome-box text-center">
            <h2>Welcome, <?php echo htmlspecialchars($user["first_name"]. " ". $user["last_name"]); ?>!</h2>
            <p class="lead">Manage your birth certificate requests and view updates here.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card stats-card shadow-sm text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                        <h5 class="card-title">Total Requests</h5>
                        <p class="card-text fs-4">3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card shadow-sm text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                        <h5 class="card-title">Approved</h5>
                        <p class="card-text fs-4">2</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card shadow-sm text-center p-4">
                    <div class="card-body">
                        <i class="fas fa-hourglass-half fa-2x text-warning mb-2"></i>
                        <h5 class="card-title">Pending</h5>
                        <p class="card-text fs-4">1</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4 class="mb-3">Latest Announcements</h4>
            <div class="announcement-box mb-3">
                <h6><i class="fas fa-bullhorn me-2 text-primary"></i>System Maintenance</h6>
                <p>The system will be down for maintenance on Saturday between 1 AM - 3 AM.</p>
            </div>
            <div class="announcement-box">
                <h6><i class="fas fa-info-circle me-2 text-primary"></i>New Update</h6>
                <p>Online payment feature has been added for faster processing.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>