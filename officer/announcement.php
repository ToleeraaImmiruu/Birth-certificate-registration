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
        .custom-container {
            max-width: 700px;
            margin: auto;
        }

        .card-header-blue {
            background-color: #0d6efd;
            color: white;
        }

        .searchable-select {
            position: relative;
        }

        .searchable-select select {
            width: 100%;
        }

        /* Hide the dropdown arrow in Firefox */
        .searchable-select select {
            -moz-appearance: none;
            text-indent: 0.01px;
            text-overflow: '';
        }

        /* Hide the dropdown arrow in Chrome/Safari */
        .searchable-select select::-ms-expand {
            display: none;
        }
    </style>
</head>

<body class="bg-light">

    <div class="container custom-container mt-5">
        <h2 class="text-center mb-4 text-primary fw-bold">📢 Admin Announcement & Messaging</h2>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs mb-4" id="announcementTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="announcement" aria-selected="true">Public Announcement</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="message-tab" data-bs-toggle="tab" data-bs-target="#message" type="button" role="tab" aria-controls="message" aria-selected="false">Send Message</button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="announcementTabsContent">
            <!-- Public Announcement Form -->
            <div class="tab-pane fade show active" id="announcement" role="tabpanel" aria-labelledby="announcement-tab">
                <div class="card shadow-sm">
                    <div class="card-header card-header-blue fw-semibold">Post Public Announcement</div>
                    <div class="card-body">
                        <form action="handleAnnouncement.php" method="POST">
                            <input type="hidden" name="type" value="announcement">
                            <div class="mb-3">
                                <label for="ann_title" class="form-label">Title</label>
                                <input type="text" name="title" id="ann_title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="ann_body" class="form-label">Content</label>
                                <textarea name="body" id="ann_body" rows="4" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post Announcement</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Private Message Form -->
            <div class="tab-pane fade" id="message" role="tabpanel" aria-labelledby="message-tab">
                <div class="card shadow-sm">
                    <div class="card-header card-header-blue fw-semibold">Send Message to User</div>
                    <div class="card-body">
                        <form action="handleAnnouncement.php" method="POST">
                            <input type="hidden" name="type" value="message">

                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <div class="searchable-select">
                                    <input type="text" id="userSearch" class="form-control mb-2" placeholder="Search users..." onkeyup="filterUsers()">
                                    <select name="user_id" id="user_id" class="form-select" required size="5" style="height: auto;">
                                        <option value="">-- Select User --</option>
                                        <?php while ($user = $users_result->fetch_assoc()): ?>
                                            <option value="<?= $user['id'] ?>"><?= htmlspecialchars($user['full_name']) ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="msg_title" class="form-label">Title</label>
                                <input type="text" name="title" id="msg_title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="msg_body" class="form-label">Message</label>
                                <textarea name="body" id="msg_body" rows="4" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary text-white">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
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