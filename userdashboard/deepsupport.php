<?php 
require "init.php";
include "../setup/dbconnection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Support Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
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
            background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
            min-height: 100vh;
        }

        .support-card {
            max-width: 700px;
            margin: 50px auto;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a2a3a 100%);
            color: white;
            padding: 25px;
            border-bottom: none;
        }

        .card-body {
            padding: 30px;
            background-color: white;
        }

        .support-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 146, 79, 0.15);
        }

        .btn-officer {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
        }

        .btn-officer:hover {
            background-color: #0b7a41;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 146, 79, 0.3);
        }

        .btn-admin {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s;
            border: none;
        }

        .btn-admin:hover {
            background-color: #1a2a3a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(44, 62, 80, 0.3);
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 25px;
        }

        .button-group .btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            min-width: 300px;
        }

        .form-floating label {
            color: #6c757d;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(-45deg, #f5f7fa, #e4e8eb, #f0f2f5, #e8ebf0);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            background-color: rgba(13, 146, 79, 0.1);
            color: var(--secondary-color);
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Animated Background -->
    <div class="animated-bg"></div>

    <!-- Alert Container (floating) -->
    <div id="alertPlaceholder" class="floating-alert"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card support-card">
                    <div class="card-header text-center">
                        <div class="feature-icon mx-auto">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h2 class="mb-0">Customer Support Portal</h2>
                        <p class="mb-0 opacity-75">We're here to help you 24/7</p>
                    </div>
                    <div class="card-body">
                        <form id="supportForm" method="post">
                            <div class="mb-4">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="What's this about?" required>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="your@email.com" required>
                                </div>
                                <div class="form-text">We'll never share your email with anyone else.</div>
                            </div>

                            <div class="mb-4">
                                <label for="feedback" class="form-label">Your Feedback</label>
                                <textarea class="form-control" id="feedback" name="feedback" rows="5" placeholder="Please describe your issue or feedback in detail..." required></textarea>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="urgentCheck" name="urgentCheck">
                                <label class="form-check-label" for="urgentCheck">This is an urgent request</label>
                            </div>

                            <div class="button-group">
                                <button type="submit" name="officerbtn" class="btn btn-officer" id="officerBtn">
                                    <i class="bi bi-person-check"></i> Send to Officer
                                </button>
                                <button type="submit" name="adminbtn" class="btn btn-admin" id="adminBtn">
                                    <i class="bi bi-shield-lock"></i> Send to Admin
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 text-center py-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> Average response time: 2-4 hours
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect form data
        $user_id = $_SESSION['id'];
        $subject = $_POST['subject'] ?? '';
        $email = $_POST['email'] ?? '';
        $message = $_POST['feedback'] ?? '';
        $isUrgent = isset($_POST['urgentCheck']) ? 'Yes' : 'No';

        // Determine which button was clicked
        $recipient = '';
        if (isset($_POST['officerbtn'])) {
            $recipient = 'Application Support';
        } elseif (isset($_POST['adminbtn'])) {
            $recipient = 'Account Support';
        }

        // Validate inputs
        $errors = [];
        if (empty($subject)) $errors[] = 'Subject is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($message)) $errors[] = 'Feedback is required';
        if (empty($recipient)) $errors[] = 'Please select a recipient';

        if (empty($errors)) {
            // Here you would typically:
            // 1. Save to database
            // 2. Send email notification
            // 3. Process the request

            if($recipient === 'Application Support'){
                $sql = "INSERT INTO applications_support VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $user_id, $email, $subject, $message);
                if($stmt->execute()){
                    $successMessage = "Thank you for your feedback! Your request has been sent to $recipient.";
                    $successMessage .= $isUrgent === 'Yes' ? " (Marked as urgent)" : "";

                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const alertPlaceholder = document.getElementById('alertPlaceholder');
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = [
                                `<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">`,
                                `   <div class=\"d-flex align-items-center\">`,
                                `       <i class=\"bi bi-check-circle-fill me-2\"></i>`,
                                `       <div>$successMessage</div>`,
                                `   </div>`,
                                '   <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>',
                                '</div>'
                            ].join('');
                            
                            alertPlaceholder.innerHTML = '';
                            alertPlaceholder.append(wrapper);
                            
                            // Reset form
                            document.getElementById('supportForm').reset();
                            
                            // Auto-close alert after 5 seconds
                            setTimeout(() => {
                                const alert = wrapper.querySelector('.alert');
                                if (alert) {
                                    const bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }
                            }, 5000);
                        });
                    </script>";

                }
            
            
            }else if($recipient === 'Account Support'){
                $sql = "INSERT INTO account_suuport VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $user_id, $email, $subject, $message);
                if($stmt->execute()){
                    $successMessage = "Thank you for your feedback! Your request has been sent to $recipient.";
                    $successMessage .= $isUrgent === 'Yes' ? " (Marked as urgent)" : "";

                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const alertPlaceholder = document.getElementById('alertPlaceholder');
                            const wrapper = document.createElement('div');
                            wrapper.innerHTML = [
                                `<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">`,
                                `   <div class=\"d-flex align-items-center\">`,
                                `       <i class=\"bi bi-check-circle-fill me-2\"></i>`,
                                `       <div>$successMessage</div>`,
                                `   </div>`,
                                '   <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>',
                                '</div>'
                            ].join('');
                            
                            alertPlaceholder.innerHTML = '';
                            alertPlaceholder.append(wrapper);
                            
                            // Reset form
                            document.getElementById('supportForm').reset();
                            
                            // Auto-close alert after 5 seconds
                            setTimeout(() => {
                                const alert = wrapper.querySelector('.alert');
                                if (alert) {
                                    const bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }
                            }, 5000);
                        });
                    </script>";

                }

            }

            // For this example, we'll just prepare a success message

        } else {
            // Display errors
            $errorMessage = implode('<br>', $errors);
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    const alertPlaceholder = document.getElementById('alertPlaceholder');
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = [
                        `<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">`,
                        `   <div class=\"d-flex align-items-center\">`,
                        `       <i class=\"bi bi-exclamation-triangle-fill me-2\"></i>`,
                        `       <div>$errorMessage</div>`,
                        `   </div>`,
                        '   <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>',
                        '</div>'
                    ].join('');
                    
                    alertPlaceholder.innerHTML = '';
                    alertPlaceholder.append(wrapper);
                    
                    // Auto-close alert after 5 seconds
                    setTimeout(() => {
                        const alert = wrapper.querySelector('.alert');
                        if (alert) {
                            const bsAlert = new bootstrap.Alert(alert);
                            bsAlert.close();
                        }
                    }, 5000);
                });
            </script>";
        }
    }
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const supportForm = document.getElementById('supportForm');
            const officerBtn = document.getElementById('officerBtn');
            const adminBtn = document.getElementById('adminBtn');
            const alertPlaceholder = document.getElementById('alertPlaceholder');

            function validateForm() {
                const subject = document.getElementById('subject').value.trim();
                const email = document.getElementById('email').value.trim();
                const feedback = document.getElementById('feedback').value.trim();

                if (!subject || !email || !feedback) {
                    showAlert('Please fill in all required fields before submitting.', 'danger');
                    return false;
                }

                // Simple email validation
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showAlert('Please enter a valid email address.', 'danger');
                    return false;
                }

                return true;
            }

            function showAlert(message, type) {
                const wrapper = document.createElement('div');
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible fade show" role="alert">`,
                    `   <div class="d-flex align-items-center">`,
                    `       <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill'} me-2"></i>`,
                    `       <div>${message}</div>`,
                    `   </div>`,
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    '</div>'
                ].join('');

                alertPlaceholder.innerHTML = '';
                alertPlaceholder.append(wrapper);

                // Auto-close alert after 5 seconds
                setTimeout(() => {
                    const alert = wrapper.querySelector('.alert');
                    if (alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            }

            // Add loading indicators when buttons are clicked
            officerBtn.addEventListener('click', function() {
                if (validateForm()) {
                    this.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...`;
                    this.disabled = true;
                    adminBtn.disabled = true;
                }
            });

            adminBtn.addEventListener('click', function() {
                if (validateForm()) {
                    this.innerHTML = `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Sending...`;
                    this.disabled = true;
                    officerBtn.disabled = true;
                }
            });
        });
    </script>
</body>

</html>