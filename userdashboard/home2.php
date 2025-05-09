<?php
require 'init.php';
include "../setup/dbconnection.php";

// Get user data
$user_id = $_SESSION["id"];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get application stats
$app_stats = [
    'total' => 0,
    'pending' => 0,
    'approved' => 0,
    'rejected' => 0
];

$sql = "SELECT status, COUNT(*) as count FROM applications WHERE user_id = ? GROUP BY status";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stats_result = $stmt->get_result();

while ($row = $stats_result->fetch_assoc()) {
    $app_stats[strtolower($row['status'])] = $row['count'];
    $app_stats['total'] += $row['count'];
}

// Get recent announcements
$sql = "SELECT * FROM announcements ORDER BY created_at DESC LIMIT 3";
$stmt = $conn->prepare($sql);
$stmt->execute();
$announcements = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birth Certificate System - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --danger-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-container {
            margin-left: 250px;
            padding: 2rem;
            transition: margin 0.3s ease;
        }
        
        .welcome-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }
        
        .welcome-card::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .user-avatar {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .stats-card {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            border-left: 5px solid;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
        }
        
        .stats-card.total {
            border-color: var(--primary-color);
        }
        
        .stats-card.pending {
            border-color: var(--warning-color);
        }
        
        .stats-card.approved {
            border-color: var(--success-color);
        }
        
        .stats-card.rejected {
            border-color: var(--danger-color);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 1rem;
            color: #6c757d;
        }
        
        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.2;
            position: absolute;
            right: 1rem;
            top: 1rem;
        }
        
        .announcement-card {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            border-left: 5px solid var(--primary-color);
        }
        
        .announcement-date {
            font-size: 0.8rem;
            color: #6c757d;
        }
        
        .quick-action-card {
            background-color: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            height: 100%;
        }
        
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 1.5rem 1rem;
            border-radius: 10px;
            background-color: var(--light-color);
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }
        
        .action-btn:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-5px);
        }
        
        .action-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 992px) {
            .dashboard-container {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar would be included here -->
    
    <div class="dashboard-container">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3>Welcome back, <?php echo htmlspecialchars($user['first_name']) ?>!</h3>
                    <p class="mb-0">Here's what's happening with your birth certificate applications</p>
                </div>
                <div class="col-md-4 text-center text-md-end">
                    <img src="../assets/uploads/<?php echo htmlspecialchars($user['profile_image'] ?? 'default-profile.jpg') ?>" 
                         alt="Profile Image" 
                         class="user-avatar"
                         onerror="this.src='../assets/uploads/default-profile.jpg'">
                </div>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="stats-card total">
                    <div class="stat-number"><?php echo $app_stats['total'] ?></div>
                    <div class="stat-label">Total Applications</div>
                    <i class="fas fa-file-alt stat-icon"></i>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card pending">
                    <div class="stat-number"><?php echo $app_stats['pending'] ?></div>
                    <div class="stat-label">Pending</div>
                    <i class="fas fa-clock stat-icon"></i>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card approved">
                    <div class="stat-number"><?php echo $app_stats['approved'] ?></div>
                    <div class="stat-label">Approved</div>
                    <i class="fas fa-check-circle stat-icon"></i>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="stats-card rejected">
                    <div class="stat-number"><?php echo $app_stats['rejected'] ?></div>
                    <div class="stat-label">Rejected</div>
                    <i class="fas fa-times-circle stat-icon"></i>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <!-- Quick Actions -->
            <div class="col-lg-4 mb-4">
                <div class="quick-action-card">
                    <h5 class="mb-4">Quick Actions</h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="user.php?page=apply" class="action-btn">
                                <i class="fas fa-plus-circle action-icon"></i>
                                <span>New Application</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="user.php?page=status" class="action-btn">
                                <i class="fas fa-tasks action-icon"></i>
                                <span>Check Status</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="user.php?page=editprofile" class="action-btn">
                                <i class="fas fa-user-edit action-icon"></i>
                                <span>Edit Profile</span>
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="../public/logOut.php" class="action-btn">
                                <i class="fas fa-sign-out-alt action-icon"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Announcements -->
            <div class="col-lg-8 mb-4">
                <div class="announcement-card">
                    <h5 class="mb-4">Recent Announcements</h5>
                    
                    <?php if ($announcements->num_rows > 0): ?>
                        <?php while ($announcement = $announcements->fetch_assoc()): ?>
                            <div class="mb-4 pb-3 border-bottom">
                                <h6><?php echo htmlspecialchars($announcement['title']) ?></h6>
                                <p class="mb-2"><?php echo htmlspecialchars(substr($announcement['content'], 0, 150)) ?>...</p>
                                <div class="announcement-date">
                                    <i class="far fa-calendar-alt me-2"></i>
                                    <?php echo date('M d, Y', strtotime($announcement['created_at'])) ?>
                                </div>
                                <a href="user.php?page=notification" class="btn btn-sm btn-outline-primary mt-2">Read More</a>
                            </div>
                        <?php endwhile; ?>
                        <div class="text-end">
                            <a href="user.php?page=notification" class="btn btn-link">View All Announcements</a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="far fa-bell fa-3x mb-3 text-muted"></i>
                            <p class="text-muted">No announcements available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Recent Applications (if any) -->
        <?php if ($app_stats['total'] > 0): ?>
        <div class="row mt-2">
            <div class="col-12">
                <div class="announcement-card">
                    <h5 class="mb-4">Recent Applications</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Child's Name</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                    <th>Date Submitted</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                                $sql = "SELECT * FROM applications WHERE user_id = ? ORDER BY created_at DESC LIMIT 3";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("i", $user_id);
                                $stmt->execute();
                                $apps = $stmt->get_result();
                                
                                while ($app = $apps->fetch_assoc()): ?>
                                <tr>
                                    <td>#BC-<?php echo str_pad($app['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                    <td><?php echo htmlspecialchars($app['first_name'] ). ' ' . htmlspecialchars($app['last_name']) ?></td>
                                    <td><?php echo date('M d, Y', strtotime($app['dob'])) ?></td>
                                    <td>
                                        <?php 
                                        $status_class = '';
                                        switch(strtolower($app['status'])) {
                                            case 'approved': $status_class = 'text-success'; break;
                                            case 'rejected': $status_class = 'text-danger'; break;
                                            default: $status_class = 'text-warning';
                                        }
                                        ?>
                                        <span class="<?php echo $status_class ?>">
                                            <?php echo ucfirst($app['status']) ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('M d, Y', strtotime($app['created_at'])) ?></td>
                                    <td>
                                        <a href="user.php?page=status&id=<?php echo $app['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            View Details
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <a href="user.php?page=status" class="btn btn-link">View All Applications</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for stats cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const statsCards = document.querySelectorAll('.stats-card');
            statsCards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html>