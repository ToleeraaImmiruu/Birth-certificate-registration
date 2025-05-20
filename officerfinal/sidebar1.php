<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <!-- Load Bootstrap only once -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Main layout styles */
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
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

        .content-wrapper {
            flex-grow: 1;
            padding-left: 280px;
            transition: padding-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            width: 100%;
        }

        .content {
            padding: 30px;
            background-color: white;
            min-height: 100vh;
        }

        .sidebar.hidden+.content-wrapper {
            padding-left: 0;
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

        /* Rest of your sidebar styles... */
        /* ... (keep all your existing sidebar styles) ... */

        /* Payment page specific styles - moved here to prevent conflicts */
        .payment-header {
            background-color: #2c3e50;
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


        /* Profile Page Specific Styles */
        /* Profile Page Specific Styles */
        .profile-page-container {
            background-color: #f8f9fa;
            padding: 20px 0;
        }

        .profile-header-section {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .profile-subtitle {
            margin-bottom: 0;
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .profile-main-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .profile-card-header {
            background-color: #2c3e50;
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-edit-icon {
            position: absolute;
            bottom: 30px;
            right: calc(50% - 80px);
            background: #0d924f;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
            border: 3px solid white;
        }

        .profile-card-body {
            padding: 2rem;
            background-color: white;
        }

        .profile-field-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            display: block;
        }

        .profile-input-group {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .profile-input-icon {
            background-color: #2c3e50;
            color: white;
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            border-radius: 0.25rem 0 0 0.25rem;
        }

        .profile-form-input {
            flex: 1;
            border-radius: 0 0.25rem 0.25rem 0;
        }

        .profile-form-input:focus {
            border-color: #0d924f;
            box-shadow: 0 0 0 0.25rem rgba(13, 146, 79, 0.25);
        }

        .profile-password-toggle-btn {
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 0 0.25rem 0.25rem 0;
            padding: 0.375rem 0.75rem;
        }

        .profile-hint-text {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .profile-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 2rem;
        }

        .profile-save-btn {
            background-color: #0d924f;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .profile-save-btn:hover {
            background-color: #0b7a40;
            transform: translateY(-2px);
        }

        .profile-cancel-btn {
            padding: 0.5rem 1.5rem;
        }

        .profile-modal-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #eee;
        }

        .profile-modal-hint {
            display: block;
            margin-top: 0.5rem;
            color: #6c757d;
            font-size: 0.875rem;
        }


        /* the style of ussersuport */
        .header {
            background: linear-gradient(135deg, var(--primary-color), #1a252f);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }

        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-success:hover {
            background-color: #0b7a43;
            border-color: #0b7a43;
        }

        .btn-danger {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-danger:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        .status-pending {
            color: #f39c12;
            font-weight: bold;
        }

        .status-resolved {
            color: var(--secondary-color);
            font-weight: bold;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
        }

        .highlight-row:hover {
            background-color: rgba(44, 62, 80, 0.05);
            cursor: pointer;
        }

        .success-alert {
            background-color: var(--secondary-color);
            color: white;
        }

        .error-alert {
            background-color: var(--accent-color);
            color: white;
        }

        .complaint-details {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .reply-form {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="main-container">
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

        <div class="content-wrapper">
            <div class="content">
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
                        include "payments1.php";
                    } else if ($page == "usersupport") {
                        include "usersupport2.php";
                    } else {
                        echo "<h3>Page Not Found</h3>";
                    }
                } else {
                    include 'home.php';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('hidden');
        }
    </script>
</body>

</html>