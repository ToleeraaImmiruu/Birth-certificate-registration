<?php
include "../setup/dbconnection.php";
$sql = "SELECT * FROM users WHERE role = 'admin'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$addmin = $result->fetch_assoc();

$sqlmale = "SELECT gender, COUNT(*) as male_gender  FROM certificates WHERE gender = 'Male'";
$stmt = $conn->prepare($sqlmale);
$stmt->execute();
$result = $stmt->get_result();
$male = $result->fetch_assoc();
$sqlfemale = "SELECT gender , COUNT(*) as female_gender FROM certificates WHERE gender = 'Female'";
$stmt = $conn->prepare($sqlfemale);
$stmt->execute();
$result = $stmt->get_result();
$female = $result->fetch_assoc();

$sql = "SELECT COUNT(*) AS totalcertificate FROM Certificates";
$stmt = $conn->prepare($sql);
$stmt-> execute();
$result = $stmt->get_result();
$total = $result->fetch_assoc();
$pendingsql = "SELECT COUNT(*) AS Pending FROM applications";
$stmt = $conn->prepare($pendingsql);
$stmt->execute();
$result = $stmt->get_result();
$pending = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate System - Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--primary-color);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.75);
            border-radius: 5px;
            margin: 2px 0;
            padding: 10px 15px;
        }

        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .card-icon {
            font-size: 2rem;
            opacity: 0.8;
        }

        .stat-card {
            border-left: 4px solid;
            transition: all 0.3s ease;
            border-radius: 8px;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .border-primary {
            border-color: var(--primary-color) !important;
            border-left-color: var(--primary-color) !important;
        }
        .text-primary {
            color: var(--primary-color) !important;
        }
        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .border-success {
            border-color: var(--secondary-color) !important;
            border-left-color: var(--secondary-color) !important;
        }
        .text-success {
            color: var(--secondary-color) !important;
        }
        .bg-success {
            background-color: var(--secondary-color) !important;
        }

        .border-danger {
            border-color: var(--accent-color) !important;
            border-left-color: var(--accent-color) !important;
        }
        .text-danger {
            color: var(--accent-color) !important;
        }
        .bg-danger {
            background-color: var(--accent-color) !important;
        }

        .bg-white {
            background-color: white !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }

        .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            background-color: white;
            font-weight: 600;
            border-radius: 10px 10px 0 0 !important;
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 1.25rem 1.5rem;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: var(--primary-color);
        }

        .badge {
            font-weight: 500;
            padding: 5px 8px;
            border-radius: 4px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border: 2px solid var(--primary-color);
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->  
            <div class="col-md-8 p-4 mx-auto">
                <div class="d-flex justify-content-between align-items-center mb-4 mr-4">
                    <h2 class="fw-bold text-primary">Admin Dashboard</h2>
                    <div class="d-flex align-items-center">
                        <span class="me-3 text-muted">Welcome, <span class="fw-bold text-primary"><?php echo $addmin["first_name"]. " ". $addmin["last_name"] ?></span></span>
                        <img src="pp.png" class="rounded-circle profile-img" alt="Profile" width="40" height="40">
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4 g-4">
                    <div class="col-md-3">
                        <div class="card stat-card border-primary h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="text-uppercase text-muted small fw-bold">Total Certificates</h6>
                                        <h3 class="mb-3 fw-bold"><?php echo $total["totalcertificate"]?></h3>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            <i class="fas fa-arrow-up me-1"></i> 5.2%
                                        </span>
                                    </div>
                                    <div class="card-icon text-primary bg-primary bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-certificate"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card border-success h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="text-uppercase text-muted small fw-bold">This Month</h6>
                                        <h3 class="mb-3 fw-bold">1,243</h3>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-arrow-up me-1"></i> 12.7%
                                        </span>
                                    </div>
                                    <div class="card-icon text-success bg-success bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card border-warning h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="text-uppercase text-muted small fw-bold">Pending Requests</h6>
                                        <h3 class="mb-3 fw-bold"><?php echo $pending["Pending"]?></h3>
                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-arrow-down me-1"></i> 3.4%
                                        </span>
                                    </div>
                                    <div class="card-icon text-warning bg-warning bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stat-card border-danger h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="text-uppercase text-muted small fw-bold">Rejected</h6>
                                        <h3 class="mb-3 fw-bold">23</h3>
                                        <span class="badge bg-danger bg-opacity-10 text-danger">
                                            <i class="fas fa-arrow-up me-1"></i> 1.2%
                                        </span>
                                    </div>
                                    <div class="card-icon text-danger bg-danger bg-opacity-10 p-3 rounded-circle">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row mb-4 g-4">
                    <div class="col-md-8">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold text-primary">Certificates Issued (Last 12 Months)</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="chartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        This Year
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="chartDropdown">
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                        <li><a class="dropdown-item" href="#">Last Year</a></li>
                                        <li><a class="dropdown-item" href="#">Custom Range</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="yearlyChart" height="250"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header bg-white">
                                <h5 class="mb-0 fw-bold text-primary">Gender Distribution</h5>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="flex-grow-1">
                                    <canvas id="genderChart" height="250"></canvas>
                                </div>
                                <div class="mt-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><i class="fas fa-circle text-primary me-2"></i> Male</span>
                                        <span class="fw-bold"><?php echo $male["male_gender"]?></span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span><i class="fas fa-circle text-danger me-2"></i> Female</span>
                                        <span class="fw-bold"><?php echo $female["female_gender"]?></span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span><i class="fas fa-circle text-success me-2"></i> Other</span>
                                        <span class="fw-bold">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity and Top Locations -->
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold text-primary">Recent Activity</h5>
                                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-certificate"></i></span>
                                                    <strong>New certificate issued</strong>
                                                </div>
                                                <p class="mb-0 text-muted small">Certificate #BC-2023-12456</p>
                                            </div>
                                            <small class="text-muted">2 mins ago</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge bg-success bg-opacity-10 text-success me-2"><i class="fas fa-check-circle"></i></span>
                                                    <strong>Registration approved</strong>
                                                </div>
                                                <p class="mb-0 text-muted small">For Baby Smith (ID: 7890)</p>
                                            </div>
                                            <small class="text-muted">25 mins ago</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge bg-info bg-opacity-10 text-info me-2"><i class="fas fa-print"></i></span>
                                                    <strong>Certificate printed</strong>
                                                </div>
                                                <p class="mb-0 text-muted small">Certificate #BC-2023-12455</p>
                                            </div>
                                            <small class="text-muted">1 hour ago</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge bg-secondary bg-opacity-10 text-secondary me-2"><i class="fas fa-user-plus"></i></span>
                                                    <strong>New user registered</strong>
                                                </div>
                                                <p class="mb-0 text-muted small">Dr. Johnson (Hospital Admin)</p>
                                            </div>
                                            <small class="text-muted">3 hours ago</small>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <span class="badge bg-danger bg-opacity-10 text-danger me-2"><i class="fas fa-times"></i></span>
                                                    <strong>Request rejected</strong>
                                                </div>
                                                <p class="mb-0 text-muted small">Incomplete documentation</p>
                                            </div>
                                            <small class="text-muted">5 hours ago</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold text-primary">Top Registration Locations</h5>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="locationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        This Year
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="locationDropdown">
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                        <li><a class="dropdown-item" href="#">Last Year</a></li>
                                        <li><a class="dropdown-item" href="#">All Time</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th class="text-primary">Location</th>
                                                <th class="text-primary">Count</th>
                                                <th class="text-primary">Trend</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-hospital"></i></span>
                                                        City General Hospital
                                                    </div>
                                                </td>
                                                <td class="fw-bold">3,456</td>
                                                <td><span class="badge bg-success bg-opacity-10 text-success">+12%</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-hospital-alt"></i></span>
                                                        Women & Children Hospital
                                                    </div>
                                                </td>
                                                <td class="fw-bold">2,789</td>
                                                <td><span class="badge bg-success bg-opacity-10 text-success">+8%</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-clinic-medical"></i></span>
                                                        Central Medical Center
                                                    </div>
                                                </td>
                                                <td class="fw-bold">1,945</td>
                                                <td><span class="badge bg-warning bg-opacity-10 text-warning">+2%</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-first-aid"></i></span>
                                                        Northside Clinic
                                                    </div>
                                                </td>
                                                <td class="fw-bold">1,230</td>
                                                <td><span class="badge bg-danger bg-opacity-10 text-danger">-5%</span></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge bg-primary bg-opacity-10 text-primary me-2"><i class="fas fa-ambulance"></i></span>
                                                        Community Health Center
                                                    </div>
                                                </td>
                                                <td class="fw-bold">876</td>
                                                <td><span class="badge bg-success bg-opacity-10 text-success">+15%</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Yearly Certificates Chart
        const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        const yearlyChart = new Chart(yearlyCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Certificates Issued',
                    data: [1024, 1156, 987, 1345, 1567, 1432, 1678, 1567, 1789, 1654, 1432, 1234],
                    backgroundColor: 'rgba(44, 62, 80, 0.7)',
                    borderColor: 'rgba(44, 62, 80, 1)',
                    borderWidth: 1,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(44, 62, 80, 0.9)',
                        titleFont: {
                            weight: 'bold',
                            size: 14
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            stepSize: 500
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female', 'Other'],
                datasets: [{
                    data: [<?php echo  $male["male_gender"]?>, <?php echo  $female["female_gender"]?>,0],
                    backgroundColor: [
                        'rgba(44, 62, 80, 0.7)',
                        'rgba(231, 76, 60, 0.7)',
                        'rgba(13, 146, 79, 0.7)'
                    ],
                    borderColor: [
                        'rgba(44, 62, 80, 1)',
                        'rgba(231, 76, 60, 1)',
                        'rgba(13, 146, 79, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false,
                        position: 'bottom',
                        labels: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(44, 62, 80, 0.9)',
                        titleFont: {
                            weight: 'bold',
                            size: 14
                        },
                        bodyFont: {
                            size: 12
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>