<?php
include '../setup/dbconnection.php';

// Fetch users for dropdown
$users_result = $conn->query("SELECT id, CONCAT(first_name, ' ', last_name) AS full_name FROM users");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Announcement & Messaging</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: var(--light-bg);
        }
        
        .custom-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 15px;
        }

        .card-header-blue {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #1a252f;
            border-color: #1a252f;
        }
        
        .nav-pills .nav-link.active {
            background-color: var(--primary-color);
        }
        
        .nav-pills .nav-link {
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
            margin: 0 5px;
        }
        
        .searchable-select {
            position: relative;
        }
        
        .search-input {
            border: 2px solid #dee2e6;
            border-radius: 5px;
            padding: 8px 12px;
            margin-bottom: 10px;
        }
        
        .search-input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }
        
        .user-select {
            border: 2px solid #dee2e6;
            border-radius: 5px;
            width: 100%;
        }
        
        .user-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }
        
        .page-title {
            color: var(--primary-color);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .form-control, .form-select {
            border: 2px solid #dee2e6;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }
        
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .tab-content {
            padding: 20px 0;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-container {
                margin: 1rem auto;
            }
            
            .nav-pills {
                flex-direction: column;
            }
            
            .nav-pills .nav-link {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="custom-container">
        <!-- Enhanced page title with icon -->
        <div class="page-title text-center">
            <h2 class="mb-0"><i class="bi bi-megaphone-fill me-2"></i>Admin Announcement & Messaging Center</h2>
        </div>

        <!-- Improved navigation tabs with better spacing and active state -->
        <ul class="nav nav-pills mb-4 justify-content-center" id="announcementTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="announcement" aria-selected="true">
                    <i class="bi bi-megaphone me-2"></i>Public Announcement
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="false">
                    <i class="bi bi-envelope me-2"></i>Private Message
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="announcementTabsContent">
            <!-- Public Announcement Form -->
            <div class="tab-pane fade show active" id="announcement" role="tabpanel" aria-labelledby="announcement-tab">
                <div class="card">
                    <div class="card-header card-header-blue">
                        <h5 class="mb-0"><i class="bi bi-megaphone-fill me-2"></i>Create New Announcement</h5>
                    </div>
                    <div class="card-body">
                        <form action="handleAnnouncement.php" method="POST">
                            <input type="hidden" name="type" value="announcement">
                            <div class="mb-4">
                                <label for="ann_title" class="form-label">Announcement Title</label>
                                <input type="text" name="title" id="ann_title" class="form-control" placeholder="Enter announcement title" required>
                            </div>
                            <div class="mb-4">
                                <label for="ann_body" class="form-label">Announcement Content</label>
                                <textarea name="body" id="ann_body" rows="5" class="form-control" placeholder="Write your announcement here..." required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send-fill me-2"></i>Publish Announcement
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Private Message Form -->
            <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                <div class="card">
                    <div class="card-header card-header-blue">
                        <h5 class="mb-0"><i class="bi bi-envelope-fill me-2"></i>Send Private Message</h5>
                    </div>
                    <div class="card-body">
                        <form action="handleAnnouncement.php" method="POST">
                            <input type="hidden" name="type" value="message">

                            <div class="mb-4">
                                <label for="userSearch" class="form-label">Search Recipient</label>
                                <input type="text" id="userSearch" class="form-control search-input" placeholder="Type to search users..." onkeyup="filterUsers()">
                                
                                <label for="user_id" class="form-label mt-2">Select User</label>
                                <select name="user_id" id="user_id" class="form-select user-select" required size="5">
                                    <option value="" disabled selected>-- Select a recipient --</option>
                                    <?php while ($user = $users_result->fetch_assoc()): ?>
                                        <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['full_name']) ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="msg_title" class="form-label">Message Subject</label>
                                <input type="text" name="title" id="msg_title" class="form-control" placeholder="Enter message subject" required>
                            </div>
                            <div class="mb-4">
                                <label for="msg_body" class="form-label">Message Content</label>
                                <textarea name="body" id="msg_body" rows="5" class="form-control" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-send-fill me-2"></i>Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function filterUsers() {
            const input = document.getElementById('userSearch');
            const filter = input.value.toUpperCase();
            const select = document.getElementById('user_id');
            const options = select.getElementsByTagName('option');

            for (let i = 0; i < options.length; i++) {
                const text = options[i].textContent || options[i].innerText;
                if (text.toUpperCase().indexOf(filter) > -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>