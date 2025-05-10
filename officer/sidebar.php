<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body
        /*{
             display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: cover;
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

        .content {
            flex-grow: 1;
            height: 10vh;
            padding: 20px;
            position: relative;
            margin-left: 250px;
            transition: margin-left 0.5s ease;
            background-color: rgba(108, 117, 125, 0.5);
        }

        .sidebar.hidden+.content {
            margin-left: 0;
        }

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
            color: red;
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

        .header {
            height: 10vh;
            background-color: red;
            width: 100%;
        }

        .header ul {
            display: flex;
            gap: 1rem;
        }

        
        .logout{
            color: white;
            text-decoration: none;
            text-transform: capitalize;
        
        }
    </style>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        }
    </script>
</head>

<body>

    <div class="content">
        <button class="btn btn-primary logout-btn"><img src="../image/logout.png" alt="Logout"><a class="logout" href="../public/logOut.php">Logout</a> </button>
        <!-- <h2>Welcome to Efa Bula Kebele</h2> -->
    </div>
    <button class="btn btn-secondary toggle-btn" onclick="toggleSidebar()">☰</button>
    <div class="sidebar">
        <img src="../image/birth.png" alt="Logo" class="logo">
        <button class="btn btn-primary" onclick="location.href='sidebar.php'"><img src="../image/home.png" alt="Home"> HOME</button>
        <button class="btn btn-primary" onclick="location.href='sidebar.php?page=application'"><img src="../image/apply.png" alt="Apply"> Applications</button>
        <button class="btn btn-primary" onclick="location.href='sidebar.php?page=manageuser'"><img src="../image/check-list.png" alt="Status"> manage user</button>
        <button class="btn btn-primary" onclick="location.href='sidebar.php?page=announcement'"><img src="../image/check-list.png" alt="Status"> ANNOUNCEMENT </button>
        <button class="btn btn-primary" onclick="location.href='sidebar.php?page=editprofile'"><img src="../image/user.png" alt="Profile Setting"> MY PROFILE </button>
    </div>

</body>
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
    } else {
        echo "<h3>Page Not Found</h3>";
    }
} else {
    include 'home.php'; // Default Page
}
?>

</html>