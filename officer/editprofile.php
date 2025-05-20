<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Profile | Certificate Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .profile-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: "";
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
            border: none;
        }

        .profile-body {
            padding: 2rem;
            background-color: white;
        }

        .section-title {
            color: var(--primary-color);
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 50px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .info-label {
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-primary-custom {
            background-color: var(--primary-color);
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #1a252f;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-success-custom {
            background-color: var(--secondary-color);
            border: none;
            border-radius: 6px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-success-custom:hover {
            background-color: #0a7a40;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 146, 79, 0.2);
        }

        .badge-role {
            background-color: var(--accent-color);
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 50px;
        }

        .stats-card {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .stats-icon {
            font-size: 2rem;
            color: var(--primary-color);
        }

        .stats-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }

        .nav-pills .nav-link {
            color: var(--primary-color);
            font-weight: 500;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: var(--primary-color);
        }

        .tab-content {
            padding: 20px 0;
        }

        .signature-preview {
            max-height: 80px;
            border: 1px dashed #ddd;
            border-radius: 4px;
            padding: 5px;
            background-color: var(--light-bg);
        }

        @media (max-width: 768px) {
            .profile-avatar {
                width: 80px;
                height: 80px;
            }

            .profile-header {
                padding: 1.5rem;
            }

            .stats-card {
                margin-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="profile-card">
                    <!-- Profile Header -->
                    <div class="profile-header text-center">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="badge badge-role">Certificate Issuing Officer</span>
                            </div>
                            <div>
                                <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="tooltip" title="Settings">
                                    <i class="fas fa-cog"></i>
                                </button>
                            </div>
                        </div>

                        <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" alt="Profile" class="profile-avatar rounded-circle mt-3 mb-3">
                        <h3>John Doe</h3>
                        <p class="mb-0"><i class="fas fa-envelope me-2"></i>john.doe@certificate.gov</p>
                    </div>

                    <!-- Profile Body -->
                    <div class="profile-body">
                        <ul class="nav nav-pills mb-4 justify-content-center" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="pill" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                    <i class="fas fa-user me-2"></i>Profile
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="password-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab" aria-controls="password" aria-selected="false">
                                    <i class="fas fa-lock me-2"></i>Password
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="settings-tab" data-bs-toggle="pill" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                                    <i class="fas fa-cog me-2"></i>Settings
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="profileTabsContent">
                            <!-- Profile Tab -->
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="row">
                                    <!-- Left Column - Profile Info -->
                                    <div class="col-md-6">
                                        <h4 class="section-title">Personal Information</h4>

                                        <form id="profileForm">
                                            <div class="mb-3">
                                                <label class="info-label">Full Name</label>
                                                <input type="text" class="form-control" value="John Doe">
                                            </div>

                                            <div class="mb-3">
                                                <label class="info-label">Email Address</label>
                                                <input type="email" class="form-control" value="john.doe@certificate.gov">
                                            </div>

                                            <div class="mb-3">
                                                <label class="info-label">Phone Number</label>
                                                <input type="tel" class="form-control" value="+1 (555) 123-4567">
                                            </div>

                                            <div class="mb-3">
                                                <label class="info-label">Department</label>
                                                <select class="form-select">
                                                    <option>Certification Department</option>
                                                    <option>Verification Department</option>
                                                    <option>Administration</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="info-label">Office Location</label>
                                                <input type="text" class="form-control" value="Headquarters, Floor 3, Room 305">
                                            </div>

                                            <div class="d-grid gap-2 mt-4">
                                                <button type="submit" class="btn btn-primary-custom text-white">
                                                    <i class="fas fa-save me-2"></i>Save Changes
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Right Column - Stats and Signature -->
                                    <div class="col-md-6">
                                        <h4 class="section-title">Work Statistics</h4>

                                        <div class="row mb-4">
                                            <div class="col-6 mb-3">
                                                <div class="stats-card text-center">
                                                    <i class="fas fa-certificate stats-icon mb-2"></i>
                                                    <div class="stats-number">1,248</div>
                                                    <div class="stats-label">Certificates Issued</div>
                                                </div>
                                            </div>

                                            <div class="col-6 mb-3">
                                                <div class="stats-card text-center">
                                                    <i class="fas fa-clock stats-icon mb-2"></i>
                                                    <div class="stats-number">24</div>
                                                    <div class="stats-label">Pending Approvals</div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="stats-card text-center">
                                                    <i class="fas fa-calendar-alt stats-icon mb-2"></i>
                                                    <div class="stats-number">3.2</div>
                                                    <div class="stats-label">Avg. Processing Days</div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="stats-card text-center">
                                                    <i class="fas fa-star stats-icon mb-2"></i>
                                                    <div class="stats-number">4.8</div>
                                                    <div class="stats-label">User Rating</div>
                                                </div>
                                            </div>
                                        </div>

                                        <h4 class="section-title">Digital Signature</h4>
                                        <div class="mb-3 text-center">
                                            <img src="https://via.placeholder.com/300x100?text=Digital+Signature" alt="Signature" class="img-fluid signature-preview mb-3">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-upload me-2"></i>Upload New Signature
                                            </button>
                                        </div>

                                        <h4 class="section-title mt-4">Profile Picture</h4>
                                        <div class="mb-3 text-center">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-camera me-2"></i>Change Profile Picture
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Password Tab -->
                            <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <h4 class="section-title text-center mb-4">Change Password</h4>

                                        <form id="passwordForm">
                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label info-label">Current Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="currentPassword" required>
                                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('currentPassword')"></i>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label info-label">New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="newPassword" required>
                                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('newPassword')"></i>
                                                </div>
                                                <div class="form-text">Must be at least 8 characters long</div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="confirmPassword" class="form-label info-label">Confirm New Password</label>
                                                <div class="position-relative">
                                                    <input type="password" class="form-control" id="confirmPassword" required>
                                                    <i class="fas fa-eye password-toggle" onclick="togglePassword('confirmPassword')"></i>
                                                </div>
                                            </div>

                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-success-custom text-white">
                                                    <i class="fas fa-key me-2"></i>Update Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <h4 class="section-title text-center mb-4">Account Settings</h4>

                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-bell me-2 text-primary"></i>Notification Preferences</h5>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                                    <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                                                </div>
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" id="smsNotifications">
                                                    <label class="form-check-label" for="smsNotifications">SMS Notifications</label>
                                                </div>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="pushNotifications" checked>
                                                    <label class="form-check-label" for="pushNotifications">Push Notifications</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <h5 class="card-title"><i class="fas fa-language me-2 text-primary"></i>Language & Region</h5>
                                                <div class="mb-3">
                                                    <label class="form-label info-label">Language</label>
                                                    <select class="form-select">
                                                        <option selected>English</option>
                                                        <option>French</option>
                                                        <option>Spanish</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label info-label">Time Zone</label>
                                                    <select class="form-select">
                                                        <option selected>(GMT) London</option>
                                                        <option>(GMT+1) Paris</option>
                                                        <option>(GMT+3) Moscow</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary-custom">
                                                <i class="fas fa-save me-2"></i>Save Settings
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Enable Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Password toggle functionality
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling;

            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                field.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        // Form submission handlers
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            showAlert('Profile updated successfully!', 'success');
        });

        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (newPassword !== confirmPassword) {
                showAlert('Passwords do not match!', 'danger');
                return;
            }

            if (newPassword.length < 8) {
                showAlert('Password must be at least 8 characters!', 'danger');
                return;
            }

            showAlert('Password changed successfully!', 'success');
            this.reset();
        });

        // Show alert message
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;

            // Find the appropriate container to show the alert
            const container = document.querySelector('.tab-content > .active');
            container.insertBefore(alertDiv, container.firstChild);

            // Auto dismiss after 3 seconds
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alertDiv);
                bsAlert.close();
            }, 3000);
        }
    </script>
</body>

</html>