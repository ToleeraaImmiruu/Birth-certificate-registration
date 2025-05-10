<?php
include '../setup/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hospital Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    /* body {
      display: flex;
      min-height: 100vh;
      margin: 0;
      justify-content: center;
      align-items: center;
      background-color: #f8f9fa;
    } */
/* 
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 1200px;
      padding: 20px;
      border-radius: 10px;
      background-color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    } */

    .sidebar {
      width: 250px;
      background-color: #6c757d;
      color: white;
      padding: 20px;
      transition: transform 0.5s ease, background-color 0.5s ease;
      position: fixed;
      height: 100vh;
      left: 0;
      top: 0;
    }

    .sidebar.hidden {
      transform: translateX(-100%);
      background-color: rgba(108, 117, 125, 0.5);
    }

    .sidebar .btn {
      width: 100%;
      margin-bottom: 10px;
      text-align: left;
      display: flex;
      align-items: center;
      transition: opacity 0.5s ease;
    }

    .sidebar.hidden .btn {
      opacity: 0;
    }

    .sidebar .btn img {
      width: 20px;
      height: 20px;
      margin-right: 10px;
    }

    /* .content {
      flex-grow: 1;
      padding: 20px;
      margin-left: 250px;
      transition: margin-left 0.5s ease;
      width: 100%;
      max-width: 1000px;
    }

    .sidebar.hidden+.content {
      margin-left: 0;
    } */

    .logo {
      width: 100px;
      display: block;
      margin-bottom: 20px;
      transition: opacity 0.5s ease;
    }

    .sidebar.hidden .logo {
      opacity: 0;
    }

    .logout-btn {
      position: absolute;
      top: 10px;
      right: 20px;
      display: flex;
      align-items: center;
    }

    .logout-btn img {
      width: 20px;
      height: 20px;
      margin-right: 5px;
    }

    .toggle-btn {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 1000;
    }

    .animated-card {
      overflow: hidden;
      border-radius: 15px;
      transform: translateY(30px);
      opacity: 0;
      animation: fadeInUp 0.8s ease forwards;
    }

    .animated-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .animated-card:hover img {
      transform: scale(1.1);
    }

    @keyframes fadeInUp {
      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    .animated-delay-1 {
      animation-delay: 0.3s;
    }

    .animated-delay-2 {
      animation-delay: 0.6s;
    }

    .animated-delay-3 {
      animation-delay: 0.9s;
    }

    .animated-delay-4 {
      animation-delay: 1.2s;
    }






    
    /* Mobile responsiveness */
    @media (max-width: 992px) {
      .sidebar {
        width: 0;
        overflow: hidden;
      }

      .sidebar.active {
        width: 250px;
        z-index: 1000;
      }

      .main-content {
        margin-left: 0;
      }

      .menu-toggle {
        display: block !important;
      }
    }

    .menu-toggle {
      display: none;
      font-size: 1.5rem;
      cursor: pointer;
      margin-right: 15px;
    } 
  </style>
  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('hidden');
    }
  </script>
</head>

<body>

  <div class="container">
    <button class="btn btn-secondary toggle-btn" onclick="toggleSidebar()">☰</button>


    <div class="sidebar">
      <img src="images/admin.png" alt="Logo" class="logo" />
      <a href="dashboard.php?page=home" class="btn btn-primary">
        <img src="images/register.png" alt="Home" /> HOME
      </a>
      <a href="dashboard.php?page=regester" class="btn btn-primary">
        <img src="images/register.png" alt="Home" /> REGISTERING HOSPITAL
      </a>
      <a href="dashboard.php?page=manage" class="btn btn-primary">
        <img src="images/team.png" alt="Apply" /> MANAGE USER
      </a>
      <a href="dashboard.php?page=create" class="btn btn-primary">
        <img src="images/imaginative.png" alt="Role" /> CREATE ROLE
      </a>
      <a href="dashboard.php?page=notification" class="btn btn-primary">
        <img src="images/imaginative.png" alt="Role" /> NOTIFICATION
      </a>
    </div>
    <!-- <div class="sidebar" id="sidebar">

      <h4>Birth Certificate System</h4>
      <p class="mb-0 text-muted">Admin Dashboard</p>
    </div>

    <div class="sidebar-header">
      <div class="sidebar-menu">
        <a href="dashboard.php?page=home" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="hospitals.php"><i class="fas fa-hospital"></i> Hospitals</a>
        <a href="#"><i class="fas fa-user-tie"></i> Application Officers</a>
        <a href="#"><i class="fas fa-users-cog"></i> Kebele Officers</a>
        <a href="dashboard.php?page=manageuser"><i class="fas fa-users"></i> Users</a>
        <a href="#"><i class="fas fa-certificate"></i> Certificates</a>
        <a href="#"><i class="fas fa-ticket-alt"></i> Support Tickets</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </div>
    </div> -->

    <!-- <div class="content">
      <button class="btn btn-primary logout-btn" href="../public/logout.php">
        <img src="images/back-arrow.png" alt="Logout" /> Logout
      </button> -->

<!-- 
  </div> -->
  </div>

</body>
<?php
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION["email"]);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
if ($user) {
  $_SESSION["ID"] = $user["id"];
}
if (isset($_GET['page'])) {
  $page = $_GET['page'];
  if ($page == "home") {
    include 'home.php';
  } elseif ($page == "regester") {
    include 'registering.php';
  } elseif ($page == "manage") {
    include 'manageuser.php';
  } elseif ($page == "create") {
    include 'createrole.php';
  } elseif ($page == "notification") {
    include 'notification.php';
  } else {
    echo "<h3>Page Not Found</h3>";
  }
} else {
  include 'home.php';
}
?>

</html>