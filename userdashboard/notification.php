<?php
// session_start();
include '../setup/dbconnection.php';

// Assume user is logged in and session holds their ID
$user_id = $_SESSION['id'];

// Fetch user-specific messages
$msg_sql = "SELECT * FROM messages WHERE user_id = ? ORDER BY sent_at DESC";
$msg_stmt = $conn->prepare($msg_sql);
$msg_stmt->bind_param("i", $user_id);
$msg_stmt->execute();
$user_msgs = $msg_stmt->get_result();

// Fetch announcements
$ann_sql = "SELECT * FROM announcements ORDER BY posted_at DESC";
$ann_stmt = $conn->prepare($ann_sql);
$ann_stmt->execute();
$announcements = $ann_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* Show 3 lines max */
            -webkit-box-orient: vertical;
        }

        .see-more {
            color: blue;
            cursor: pointer;
            font-size: 14px;
        }

        .narrow-container {
            max-width: 700px;
            margin: auto;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container narrow-container mt-5 mt-5">

        <?php if ($user_msgs->num_rows > 0) {
            while ($message = $user_msgs->fetch_assoc()) { ?>
                <h3 class="text-center text-primary mb-4">📬 User Messages & Announcements</h3>

                <!-- User-specific Messages -->
                <h5 class="text-muted">Messages for You</h5>
                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <?= htmlspecialchars($message["title"]) . "   " . htmlspecialchars($message["sent_at"]) ?>
                        <span class="badge bg-secondary float-end">Admin</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text" id="msg1">
                            <?= nl2br(htmlspecialchars($message["body"])) ?>
                        </p>
                        <span class="see-more" onclick="toggleText('msg1', this)">See more</span>
                    </div>
                </div>

        <?php   }
        } ?>

        <?php
        if ($announcements->num_rows > 0) {
            while ($announcement = $announcements->fetch_assoc()) { ?>


                <h5 class="text-muted mt-4">Public Announcements</h5>
                <div class="card mb-3 shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <?= htmlspecialchars($announcement["title"]) . "    "  . htmlspecialchars($announcement["posted_at"]) ?>
                        <span class="badge bg-secondary float-end">Announcement</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text" id="announcement1">
                            <?= nl2br(htmlspecialchars($announcement["body"])) ?>
                        </p>
                        <span class="see-more" onclick="toggleText('announcement1', this)">See more</span>
                    </div>
                </div>

        <?php }
        }
        ?>
        <?php
        if ($announcements->num_rows == 0 && $user_msgs->num_rows == 0) {
            echo "
               <div class='container d-flex justify-content-center'>
                   <div class='card shadow-sm mt-5' style='max-width: 500px; width: 100%;'>
                       <div class='card-body text-center text-muted'>
                           <h5 class='card-title text-primary fw-bold mb-3' style='font-size: 1.5rem;'>📭 No Messages</h5>
                           <p class='card-text'>You have no messages or announcements yet.</p>
                       </div>
                   </div>
               </div>";
        }
        ?>

    </div>






    <!-- More cards can be added here dynamically -->


    <script>
        function toggleText(id, btn) {
            const content = document.getElementById(id);
            const isCollapsed = content.style.webkitLineClamp === "3" || !content.style.webkitLineClamp;

            if (isCollapsed) {
                content.style.webkitLineClamp = "unset";
                btn.textContent = "See less";
            } else {
                content.style.webkitLineClamp = "3";
                btn.textContent = "See more";
            }
        }
    </script>

</body>

</html>