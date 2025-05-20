<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Birth Records Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }

        /* Main Content Styles (won't conflict with sidebar) */
        .main-content {
            background-color: var(--light-bg);
            min-height: 100vh;
            margin-left: 280px;
            /* Adjust based on your sidebar width */
            padding: 20px;
            transition: all 0.3s;
        }

        .dashboard-header {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-card.primary {
            border-left-color: var(--primary-color);
        }

        .stat-card.success {
            border-left-color: var(--secondary-color);
        }

        .stat-card.danger {
            border-left-color: var(--accent-color);
        }

        .stat-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .stat-title {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .recent-records {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .table-custom thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 12px 15px;
        }

        .table-custom tbody tr {
            transition: all 0.3s;
        }

        .table-custom tbody tr:hover {
            background-color: rgba(44, 62, 80, 0.05);
        }

        .badge-custom {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-completed {
            background-color: #d4edda;
            color: #155724;
        }

        .btn-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #1a252f;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success-custom {
            background-color: var(--secondary-color);
        }

        .btn-success-custom:hover {
            background-color: #0a7a40;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar would be included here -->
    <!-- <div class="sidebar">...</div> -->

    <div class="main-content">
        <div class="dashboard-header">
            <h2 class="mb-0"><i class="fas fa-baby me-2"></i>Birth Records Dashboard</h2>
            <p class="text-muted mb-0">Welcome back, Dr. Smith</p>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="stat-card primary">
                    <div class="stat-icon">
                        <i class="fas fa-baby-carriage"></i>
                    </div>
                    <div class="stat-number">1,248</div>
                    <div class="stat-title">Total Births Recorded</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card success">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-number">324</div>
                    <div class="stat-title">Births This Month</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card danger">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-number">18</div>
                    <div class="stat-title">Pending Certifications</div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-8">
                <div class="recent-records">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0"><i class="fas fa-list me-2"></i>Recent Birth Records</h4>
                        <button class="btn btn-custom btn-sm">
                            <i class="fas fa-plus me-1"></i> New Record
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom table-hover">
                            <thead>
                                <tr>
                                    <th>Record ID</th>
                                    <th>Mother's Name</th>
                                    <th>Birth Date</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BR-2023-0456</td>
                                    <td>Sarah Johnson</td>
                                    <td>2023-06-15</td>
                                    <td>Female</td>
                                    <td><span class="badge badge-completed badge-custom">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BR-2023-0455</td>
                                    <td>Emily Williams</td>
                                    <td>2023-06-14</td>
                                    <td>Male</td>
                                    <td><span class="badge badge-completed badge-custom">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BR-2023-0454</td>
                                    <td>Jessica Brown</td>
                                    <td>2023-06-14</td>
                                    <td>Female</td>
                                    <td><span class="badge badge-pending badge-custom">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BR-2023-0453</td>
                                    <td>Amanda Jones</td>
                                    <td>2023-06-13</td>
                                    <td>Male</td>
                                    <td><span class="badge badge-completed badge-custom">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>BR-2023-0452</td>
                                    <td>Jennifer Garcia</td>
                                    <td>2023-06-12</td>
                                    <td>Female</td>
                                    <td><span class="badge badge-pending badge-custom">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="#" class="text-primary">View All Records <i class="fas fa-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="recent-records">
                    <h4 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Birth Statistics</h4>
                    <div class="text-center mb-4">
                        <canvas id="birthChart" height="200"></canvas>
                    </div>
                    <div class="mt-4">
                        <h5 class="mb-3"><i class="fas fa-calendar-alt me-2"></i>Today's Births</h5>
                        <div class="list-group">
                            <div class="list-group-item border-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Male Births</span>
                                    <strong>4</strong>
                                </div>
                            </div>
                            <div class="list-group-item border-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Female Births</span>
                                    <strong>3</strong>
                                </div>
                            </div>
                            <div class="list-group-item border-0 py-2">
                                <div class="d-flex justify-content-between">
                                    <span>Twins</span>
                                    <strong>1</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success-custom w-100">
                            <i class="fas fa-file-export me-2"></i> Generate Monthly Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample chart data
        const ctx = document.getElementById('birthChart').getContext('2d');
        const birthChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Male', 'Female', 'Twins'],
                datasets: [{
                    data: [45, 52, 3],
                    backgroundColor: [
                        '#3498db',
                        '#e83e8c',
                        '#ffc107'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // You would add your sidebar toggle functionality here
        // function toggleSidebar() {...}
    </script>
</body>

</html>