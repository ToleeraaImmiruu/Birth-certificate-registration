<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Officer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <style>
    body {
      min-height: 100vh;
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      width: 100%;
      max-width: 1400px;
      padding: 0;
      border-radius: 15px;
      overflow: hidden;

    }


    .sidebar {
      width: 280px;
      background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
      color: white;
      padding: 25px 15px;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      position: fixed;
      height: 100vh;
      left: 0;
      top: 0;
      z-index: 100;
      border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar.hidden {
      transform: translateX(-100%);
      box-shadow: none;
    }

    .sidebar .btn {
      width: 100%;
      margin-bottom: 12px;
      text-align: left;
      display: flex;
      align-items: center;
      transition: all 0.3s ease;
      padding: 12px 15px;
      border-radius: 8px;
      font-weight: 500;
      letter-spacing: 0.5px;
      border: none;
      background-color: rgba(255, 255, 255, 0.1);
      color: #ecf0f1;
    }

    .sidebar .btn:hover {
      background-color: rgba(255, 255, 255, 0.2);
      transform: translateX(5px);
    }

    .sidebar .btn.active {
      background-color: #3498db;
    }

    .sidebar .btn img {
      width: 22px;
      height: 22px;
      margin-right: 12px;
      filter: brightness(0) invert(1);
    }

    .sidebar.hidden .btn {
      opacity: 0;
      pointer-events: none;
    }

    .content {
      flex-grow: 1;
      padding: 30px;
      margin-left: 280px;
      transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      width: 110%;
      /* max-width: 1200px; */
      background-color: white;
      min-height: 100vh;
    }

    .sidebar.hidden+.content {
      margin-left: 0;
    }

    .logo {
      width: 120px;
      display: block;
      margin: 0 auto 30px;
      transition: all 0.4s ease;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
    }

    .sidebar.hidden .logo {
      opacity: 0;
      transform: scale(0.8);
    }

    .logout-btn {
      position: fixed;
      top: 20px;
      right: 30px;
      display: flex;
      align-items: center;
      padding: 8px 15px;
      border-radius: 20px;
      font-weight: 500;
      background-color: #e74c3c;
      color: white;
      border: none;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .logout-btn:hover {
      background-color: #c0392b;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .logout-btn img {
      width: 18px;
      height: 18px;
      margin-right: 8px;
      filter: brightness(0) invert(1);
    }

    .toggle-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      z-index: 1000;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #2c3e50;
      color: white;
      border: none;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .toggle-btn:hover {
      background-color: #34495e;
      transform: scale(1.1);
    }

    .welcome-message {
      margin-top: 80px;
      text-align: center;
      font-size: 2.2rem;
      color: #2c3e50;
      padding: 30px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      border-radius: 12px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
      border-left: 5px solid #3498db;
      animation: fadeIn 0.8s ease;
    }

    .notification-badge {
      background-color: #e74c3c;
      color: white;
      border-radius: 50%;
      padding: 2px 6px;
      font-size: 12px;
      margin-left: 8px;
    }

    /* style of payment1 */
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

    .header {
      background-color: var(--primary-color);
      color: white;
      padding: 20px 0;
      margin-bottom: 30px;
      border-radius: 0 0 10px 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .payment-card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
      margin-bottom: 20px;
    }

    .payment-card:hover {
      transform: translateY(-5px);
    }

    .card-header {
      background-color: var(--primary-color);
      color: white;
      border-radius: 10px 10px 0 0 !important;
    }

    .btn-view {
      background-color: var(--primary-color);
      color: white;
    }

    .btn-view:hover {
      background-color: #1a252f;
      color: white;
    }

    .btn-approve {
      background-color: var(--secondary-color);
      color: white;
    }

    .btn-reject {
      background-color: var(--accent-color);
      color: white;
    }

    .details-container {
      display: none;
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-top: 20px;
    }

    .screenshot-preview {
      max-width: 100%;
      height: auto;
      border: 1px solid #ddd;
      border-radius: 5px;
      margin-top: 10px;
    }

    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: bold;
    }

    .pending {
      background-color: #fff3cd;
      color: #856404;
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
    <button class="logout-btn" onclick="location.href='../public/logOut.php'">
      <img src="../image/logout.png" alt="Logout"> Logout
    </button>

    <button class="toggle-btn" onclick="toggleSidebar()">☰</button>

    <div class="sidebar">
      <img src="../image/birth.png" alt="Logo" class="logo">
      <button class="btn" onclick="location.href='sidebar.php'">
        <img src="../image/home.png" alt="Home"> HOME
      </button>
      <button class="btn" onclick="location.href='sidebar.php?page=application'">
        <img src="../image/apply.png" alt="Applications"> APPLICATIONS
      </button>

      <button class="btn" onclick="location.href='sidebar.php?page=announcement'">
        <img src="../image/announcement.png" alt="Announcements"> ANNOUNCEMENTS
      </button>
      <button class="btn" onclick="location.href='sidebar.php?page=payments'">
        <img src="../image/payment.png" alt="Payments"> PAYMENTS
      </button>
      <button class="btn" onclick="location.href='sidebar.php?page=usersupport'">
        <img src="../image/support.png" alt="User Support"> USER SUPPORT
      </button>
      <button class="btn" onclick="location.href='sidebar.php?page=editprofile'">
        <img src="../image/user.png" alt="Profile Setting"> MY PROFILE
      </button>
    </div>

    <div class="content">
      <?php
      if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page == "application") {
          include 'applications.php';
        } elseif ($page == "editprofile") {
          include 'editprofile1.php';
        } elseif ($page == "announcement") {
          include 'announcement.php';
        } else if ($page == "manageuser") {
          include "manageUser.php";
        } else if ($page == "payments") {
          include "payments1.php";
        } else if ($page == "usersupport") {
          include "usersupport2.php";
        } else {
          echo "<h3>Page Not Found</h3>";
        }
      } else {
        include 'home.php'; // Default Page
      }
      ?>
    </div>
  </div>
</body>

</html>