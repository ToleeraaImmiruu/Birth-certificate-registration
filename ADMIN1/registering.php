<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Hospital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #0d924f;
      --accent-color: #e74c3c;
      --light-bg: #f8f9fa;
    }

    body {
      background: var(--light-bg);
    }

    .form-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease-in-out;
      border-top: 5px solid var(--secondary-color);
    }

    .form-container:hover {
      transform: scale(1.02);
    }

    .form-label i {
      margin-right: 6px;
      color: var(--primary-color);
    }

    .btn-primary {
      width: 100%;
      background-color: var(--secondary-color);
      border-color: var(--secondary-color);
    }

    .btn-primary:hover {
      background-color: #0b7a41;
      border-color: #0b7a41;
    }

    h2 {
      color: var(--primary-color);
    }

    #toastContainer {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .text-success {
      color: var(--secondary-color) !important;
    }

    .text-danger {
      color: var(--accent-color) !important;
    }

    .border-primary {
      border-color: var(--primary-color) !important;
    }
  </style>
</head>

<body>
  <div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="form-container w-100" style="max-width: 500px;">
      <h2 class="text-center mb-4"><i class="bi bi-hospital"></i> Register Hospital</h2>
      <form id="hospitalForm">
        <div class="mb-3">
          <label for="hospitalName" class="form-label"><i class="bi bi-building"></i> Name of Hospital</label>
          <input type="text" class="form-control" id="hospitalName" name="hospitalName" required>
        </div>
        <div class="mb-3">
          <label for="address" class="form-label"><i class="bi bi-geo-alt"></i> Address</label>
          <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label"><i class="bi bi-envelope"></i> Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label"><i class="bi bi-telephone"></i> Phone number</label>
          <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label"><i class="bi bi-person-circle"></i> Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle-fill"></i> Register</button>
      </form>
    </div>
  </div>

  <!-- Toast Notification -->
  <div id="toastContainer"></div>

  <script>
    document.getElementById('hospitalForm').addEventListener('submit', function(event) {
      event.preventDefault();
      const hospitalName = document.getElementById('hospitalName').value;
      const address = document.getElementById('address').value;
      const email = document.getElementById('email').value;
      const username = document.getElementById('username').value;
      const phone = document.getElementById('phone').value;
      const password = Math.floor(Math.random() * (999999 - 100000 + 1)) + 100000;

      const xhr = new XMLHttpRequest();
      xhr.open("post", "regesterhospital.php", true);
      xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
      if (hospitalName && address && email && username && password && phone) {
        xhr.send("hospitalName=" + hospitalName + "&address=" + address + "&email=" + email + "&username=" + username + "&password=" + password + "&phone=" + phone);
        xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
            const response = xhr.responseText;
            if (response == "success") {
              showToast('✅ Hospital registered successfully!', 'success');
              // Clear form after successful submission
              document.getElementById('hospitalForm').reset();
            } else {
              showToast('⚠️ ' + response, 'danger');
            }
          }
        }
      } else {
        showToast('⚠️ Please fill out all fields.', 'danger');
      }
    });

    function showToast(message, type) {
      const toastId = 'toast' + Date.now();
      const toast = document.createElement('div');
      toast.className = `toast align-items-center text-bg-${type} border-0 show`;
      toast.id = toastId;
      toast.setAttribute('role', 'alert');
      toast.setAttribute('aria-live', 'assertive');
      toast.setAttribute('aria-atomic', 'true');
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">${message}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>`;
      document.getElementById('toastContainer').appendChild(toast);
      
      // Auto-hide after 3 seconds
      setTimeout(() => {
        const toastElement = document.getElementById(toastId);
        if (toastElement) {
          const toastInstance = bootstrap.Toast.getOrCreateInstance(toastElement);
          toastInstance.hide();
          // Remove from DOM after hide animation completes
          toastElement.addEventListener('hidden.bs.toast', function() {
            toastElement.remove();
          });
        }
      }, 3000);
    }
  </script>
</body>

</html>