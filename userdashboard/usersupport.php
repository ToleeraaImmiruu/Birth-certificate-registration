<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <!-- Use the official Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        .hidden {
            display: none !important;
            /* Added !important to ensure it overrides other styles */
        }

        .toggle-buttons {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .toggle-buttons button {
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .toggle-buttons button:first-child {
            background-color: var(--primary-color);
            color: white;
        }

        .toggle-buttons button:last-child {
            background-color: var(--secondary-color);
            color: white;
        }

        .toggle-buttons button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            opacity: 0.9;
        }

        .support-form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .support-form:hover {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .support-form h3 {
            color: var(--primary-color);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--secondary-color);
        }

        .form-control {
            border-radius: 5px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 146, 79, 0.25);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-warning {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            color: white;
        }

        .btn-primary:hover,
        .btn-warning:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 25px;
            border-radius: 5px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            max-width: 350px;
            transform: translateX(120%);
            transition: transform 0.3s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            background-color: var(--secondary-color);
        }

        .notification.error {
            background-color: var(--accent-color);
        }

        .notification-icon {
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .toggle-buttons {
                flex-direction: column;
                gap: 10px;
            }

            .toggle-buttons button {
                width: 100%;
            }

            .support-form {
                padding: 20px;
            }

            .notification {
                max-width: calc(100% - 40px);
                left: 20px;
                right: auto;
                transform: translateY(-150%);
            }

            .notification.show {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Notification Container -->
    <div id="notification-container"></div>

    <!-- Page Content -->
    <div class="container mt-5">

        <!-- Toggle Buttons -->
        <div class="toggle-buttons text-center">
            <button class="btn" onclick="showApplicationSupport()">
                <i class="fas fa-mobile-alt"></i> Application Support
            </button>
            <button class="btn" id="account_sopport" onclick="showAccountSupport()">
                <i class="fas fa-user-cog"></i> Account Support
            </button>
        </div>

        <!-- Application Support Form -->
        <div id="application-support" class="support-form">
            <h3><i class="fas fa-mobile-alt me-2"></i>Contact Application Officer</h3>
            <form method="post" id="appForm">
                <div class="mb-3">
                    <label for="app_email" class="form-label">Your Email</label>
                    <input type="email" name="app_email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="app_message" class="form-label">Message</label>
                    <textarea name="app_message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" name="submit_application" class="btn btn-primary">
                    <i class="fas fa-paper-plane me-2"></i>Send to Application Officer
                </button>
            </form>
        </div>

        <!-- Account Support Form -->
        <div id="account-support" class="support-form hidden">
            <h3><i class="fas fa-user-cog me-2"></i>Contact Admin</h3>
            <form method="post" id="accForm">
                <div class="mb-3">
                    <label for="acc_email" class="form-label">Your Email</label>
                    <input type="email" name="acc_email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="acc_message" class="form-label">Message</label>
                    <textarea name="acc_message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" name="submit_account" class="btn btn-warning">
                    <i class="fas fa-paper-plane me-2"></i>Send to Admin
                </button>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function showApplicationSupport() {
            const applicationbtn = document.getElementById('application-support');
            const accountbtn = document.getElementById('account-support');
            applicationbtn.classList.remove('hidden');
            applicationbtn.classList.add('animate__animated', 'animate__fadeIn');
            accountbtn.classList.add('hidden');

            // Remove animation class after it completes
            setTimeout(() => {
                applicationbtn.classList.remove('animate__animated', 'animate__fadeIn');
            }, 1000);
        }

        function showAccountSupport() {
            const applicationbtn = document.getElementById('application-support');
            const accountbtn = document.getElementById('account-support');
            accountbtn.classList.remove('hidden');
            accountbtn.classList.add('animate__animated', 'animate__fadeIn');
            applicationbtn.classList.add('hidden');

            // Remove animation class after it completes
            setTimeout(() => {
                accountbtn.classList.remove('animate__animated', 'animate__fadeIn');
            }, 1000);
        }

        // Function to show notification
        function showNotification(message, type) {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;

            const icon = document.createElement('span');
            icon.className = 'notification-icon';
            icon.innerHTML = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';

            const text = document.createElement('span');
            text.textContent = message;

            notification.appendChild(icon);
            notification.appendChild(text);
            container.appendChild(notification);

            // Trigger the show animation
            setTimeout(() => {
                notification.classList.add('show');
            }, 10);

            // Remove notification after 5 seconds
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }

        // Initialize the page with the first form visible
        document.addEventListener('DOMContentLoaded', function() {
            // Show application form by default
            showApplicationSupport();
           

            // Check for success messages from PHP
            <?php if ($app_success): ?>
                showNotification("<?= $app_success ?>", "success");
            <?php elseif ($app_error): ?>
                showNotification("<?= $app_error ?>", "error");
            <?php endif; ?>

            <?php if ($acc_success): ?>
                showNotification("<?= $acc_success ?>", "success");
            <?php elseif ($acc_error): ?>
                showNotification("<?= $acc_error ?>", "error");
            <?php endif; ?>
        });
    </script>
</body>

</html>