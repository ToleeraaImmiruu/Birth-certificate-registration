<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Profile | Certificate Management System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
        }

        body {
            background-color: #f8f9fa;
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
        }

        .profile-body {
            padding: 2rem;
            background-color: white;
        }

        .section-title {
            color: var(--secondary-color);
            border-bottom: 2px solid var(--primary-color);
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .info-label {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .btn-edit {
            background-color: var(--primary-color);
            border: none;
            border-radius: 50px;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-edit:hover {
            background-color: #2980b9;
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
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
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

        @media (max-width: 768px) {
            .profile-avatar {
                width: 80px;
                height: 80px;
            }

            .profile-header {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5 mr-5">
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
                                <button class="btn btn-light btn-sm rounded-pill">
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
                                        <button type="submit" class="btn btn-edit text-white">
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
                                    <img src="https://via.placeholder.com/300x100?text=Digital+Signature" alt="Signature" class="img-fluid mb-3" style="border: 1px dashed #ccc; max-height: 80px;">
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
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple form submission handler
        document.getElementById('profileForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Profile updated successfully!');
            // In a real application, you would send the form data to the server here
        });

        // For demonstration purposes - would be replaced with actual file upload logic
        document.querySelectorAll('button').forEach(button => {
            if (button.textContent.includes('Upload') || button.textContent.includes('Change')) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('In a real application, this would open a file upload dialog.');
                });
            }
        });
    </script>
</body>

</html>