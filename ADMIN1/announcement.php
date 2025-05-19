<?php
// PHP code can be added here for form processing
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Admin Announcement Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Animate.css for animations -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #0d924f;
      --accent-color: #e74c3c;
      --light-bg: #f8f9fa;
    }

    body {
      background-color: var(--light-bg);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .main-container {
      max-width: 800px;
      margin: 0 auto;
    }

    .form-card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .form-header {
      background: linear-gradient(135deg, var(--primary-color), #1a252f);
      color: white;
      padding: 20px;
    }

    .form-body {
      padding: 30px;
      background-color: white;
    }

    .btn-submit {
      padding: 12px 30px;
      border-radius: 50px;
      font-weight: 500;
      transition: all 0.3s;
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      background-color: #0b7a43;
      border-color: #0b7a43;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .form-control,
    .form-select {
      border-radius: 8px;
      padding: 12px;
      border: 1px solid #ced4da;
      transition: all 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
      border-color: var(--secondary-color);
      box-shadow: 0 0 0 0.25rem rgba(13, 146, 79, 0.25);
    }

    .title-highlight {
      color: var(--primary-color);
    }

    .priority-high {
      color: #d35400;
    }

    .priority-urgent {
      color: var(--accent-color);
      font-weight: bold;
    }

    .success-alert {
      background-color: var(--secondary-color);
      color: white;
    }
  </style>
</head>

<body>
  <div class="container main-container animate__animated animate__fadeIn">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-5 mb-3 title-highlight">Admin Announcement Panel</h2>
      <p class="text-muted">Create and manage important announcements</p>
    </div>

    <!-- Announcement Form -->
    <div id="announcementForm">
      <div class="form-card">
        <div class="form-header">
          <h4 class="mb-0"><i class="fas fa-bullhorn me-2"></i> Post an Announcement</h4>
        </div>
        <div class="form-body">
          <form action="" method="POST" onsubmit="handleSubmit(event)">
            <div class="mb-4">
              <label for="announcementTitle" class="form-label fw-bold">Title</label>
              <input type="text" name="title" class="form-control" id="announcementTitle" placeholder="Announcement title" required>
            </div>
            <div class="mb-4">
              <label for="announcementPriority" class="form-label fw-bold">Priority</label>
              <select class="form-select" name="priority" id="announcementPriority">
                <option value="normal">Normal</option>
                <option value="high">High</option>
                <option value="urgent">Urgent</option>
              </select>
            </div>
            <div class="mb-4">
              <label for="announcementBody" class="form-label fw-bold">Announcement</label>
              <textarea class="form-control" name="message" id="announcementBody" rows="5" placeholder="Write announcement..." required></textarea>
            </div>
            <div class="text-center">
              <button type="submit" name="announcementsubmit" class="btn btn-submit">
                <i class="fas fa-share-square me-2"></i> Post Announcement
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function handleSubmit(event) {
      event.preventDefault();

      // Get priority value for styling
      const priority = document.getElementById('announcementPriority').value;
      let priorityClass = '';
      if (priority === 'high') priorityClass = 'priority-high';
      if (priority === 'urgent') priorityClass = 'priority-urgent';

      // Show success alert with animation
      const alertDiv = document.createElement('div');
      alertDiv.className = 'alert success-alert animate__animated animate__fadeInUp position-fixed top-0 start-50 translate-middle-x mt-3';
      alertDiv.style.zIndex = '9999';
      alertDiv.innerHTML = `
        <i class="fas fa-check-circle me-2"></i>
        <strong>Success!</strong> Announcement submitted successfully.
        <span class="${priorityClass}">(Priority: ${priority.charAt(0).toUpperCase() + priority.slice(1)})</span>
      `;
      document.body.appendChild(alertDiv);

      // Remove alert after 3 seconds
      setTimeout(() => {
        alertDiv.classList.add('animate__fadeOut');
        setTimeout(() => alertDiv.remove(), 500);
      }, 3000);

      // You can submit the form programmatically here if needed
      // event.target.submit();
    }
  </script>
</body>

</html>