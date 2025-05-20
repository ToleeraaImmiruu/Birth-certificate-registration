<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Main Layout Styles - Scoped to avoid conflicts */
        .main-layout {
            position: relative;
            min-height: 100vh;
        }

        .main-sidebar {
            width: 250px;
            background-color: #6c757d;
            color: white;
            padding: 20px;
            transition: transform 0.5s ease, background-color 0.5s ease;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
        }

        .main-sidebar.hidden {
            transform: translateX(-100%);
            background-color: rgba(108, 117, 125, 0.5);
        }

        .main-sidebar .sidebar-btn {
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
            display: flex;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .main-sidebar.hidden .sidebar-btn {
            opacity: 0;
        }

        .main-sidebar .sidebar-btn img {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.5s ease;
            padding: 20px;
        }

        .main-sidebar.hidden~.main-content {
            margin-left: 0;
        }

        .main-logo {
            width: 100px;
            display: block;
            margin-bottom: 20px;
            transition: opacity 0.5s ease;
        }

        .main-sidebar.hidden .main-logo {
            opacity: 0;
        }

        /* Header Styles */
        .main-header {
            position: fixed;
            top: 0;
            right: 0;
            left: 250px;
            height: 60px;
            background-color: #f8f9fa;
            z-index: 99;
            transition: left 0.5s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        .main-sidebar.hidden~.main-header {
            left: 0;
        }

        /* Logout Button */
        .main-logout-btn {
            color: #dc3545;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .main-logout-btn:hover {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .main-logout-btn img {
            width: 16px;
            height: 16px;
            margin-right: 5px;
        }

        /* Toggle Button */
        .main-toggle-btn {
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Dynamic Content Container */
        .dynamic-content-container {
            margin-top: 80px;
        }
    </style>
</head>

<body class="main-layout">
    <button class="btn btn-secondary main-toggle-btn" onclick="toggleMainSidebar()">☰</button>

    <header class="main-header">
        <h2 class="mb-0">Welcome to Efa Bula Kebele</h2>
        <a class="main-logout-btn" href="../public/logOut.php">
            <img src="../image/logout.png" alt="Logout"> Logout
        </a>
    </header>

    <aside class="main-sidebar">
        <img src="../image/birth.png" alt="Logo" class="main-logo">
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php'">
            <img src="../image/home.png" alt="Home"> HOME
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=application'">
            <img src="../image/apply.png" alt="Apply"> Applications
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=manageuser'">
            <img src="../image/check-list.png" alt="Status"> a user
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=announcement'">
            <img src="../image/check-list.png" alt="Status"> ANNOUNCEMENT
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=payments'">
            <img src="../image/check-list.png" alt="Status"> PAYMENTS
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=usersupport'">
            <img src="../image/check-list.png" alt="Status"> USER SUPPORT
        </button>
        <button class="btn btn-primary sidebar-btn" onclick="location.href='sidebar.php?page=editprofile'">
            <img src="../image/user.png" alt="Profile Setting"> MY PROFILE
        </button>
    </aside>

    <main class="main-content">
        <div class="dynamic-content-container">
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                if ($page == "application") {
                    include 'applications.php';
                } elseif ($page == "editprofile") {
                    include 'editprofile.php';
                } elseif ($page == "announcement") {
                    include 'announcement.php';
                } else if ($page == "manageuser") {
                    include "manageUser.php";
                } else if ($page == "payments") {
                    include "payments.php";
                } else if ($page == "usersupport") {
                    include "usersupport1.php";
                } else {
                    echo "<h3>Page Not Found</h3>";
                }
            } else {
                include 'home.php'; // Default Page
            }
            ?>
        </div>
    </main>

    <script>
        function toggleMainSidebar() {
            document.querySelector('.main-sidebar').classList.toggle('hidden');
        }
    </script>
</body>

</html>