<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Support Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
            min-height: 100vh;
        }

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
    <div class="header">
        <div class="container">
            <h1 class="display-5"><i class="fas fa-headset me-2"></i> User Support Management</h1>
            <p class="lead">Manage and respond to user complaints</p>
        </div>
    </div>

    <div class="container">
        <div class="alert success-alert alert-dismissible fade show" style="display: none;">
            <i class="fas fa-check-circle me-2"></i>
            <span class="alert-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="alert error-alert alert-dismissible fade show" style="display: none;">
            <i class="fas fa-exclamation-circle me-2"></i>
            <span class="alert-message"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i> User Complaints</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="complaints-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="complaints-body">
                                    <!-- Complaints will be loaded here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" id="complaint-details-section" style="display: none;">
            <div class="col-md-12">
                <div class="complaint-details">
                    <h4><i class="fas fa-file-alt me-2"></i> Complaint Details</h4>
                    <div class="mb-3">
                        <button class="btn btn-secondary" id="back-to-list">
                            <i class="fas fa-arrow-left me-1"></i> Back to User Support
                        </button>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Email:</strong> <span id="complaint-email"></span></p>
                            <p><strong>Subject:</strong> <span id="complaint-subject"></span></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Submitted:</strong> <span id="complaint-date"></span></p>
                            <p><strong>Replied:</strong> <span id="complaint-reply-date"></span></p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5>Complaint Message:</h5>
                        <div class="p-3 bg-light rounded" id="complaint-message">
                        </div>
                    </div>

                    <div class="mt-4" id="admin-reply-section" style="display: none;">
                        <h5>Your Reply:</h5>
                        <div class="p-3 bg-light rounded" id="admin-reply">
                        </div>
                    </div>
                </div>

                <div class="reply-form mt-4" id="reply-form-section">
                    <h4><i class="fas fa-reply me-2"></i> Reply to Complaint</h4>
                    <hr>
                    <form id="reply-form">
                        <input type="hidden" id="complaint-id" name="complaint_id" value="">
                        <div class="mb-3">
                            <label for="reply_message" class="form-label">Your Response</label>
                            <textarea class="form-control" id="reply_message" name="reply_message" rows="5" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane me-2"></i> Send Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sample data - in a real app, this would come from an API
        const complaints = [
            {
                id: 1,
                email: "user1@example.com",
                subject: "Login issues",
                message: "I'm unable to login to my account. I keep getting an error message.",
                created_at: "2023-06-15T10:30:00",
                status: "unreplied",
                admin_reply: "",
                reply_at: null
            },
            {
                id: 2,
                email: "user2@example.com",
                subject: "Payment problem",
                message: "I was charged twice for my subscription. Please refund the extra charge.",
                created_at: "2023-06-14T15:45:00",
                status: "resolved",
                admin_reply: "We've processed your refund. It should appear in your account within 3-5 business days.",
                reply_at: "2023-06-14T16:30:00"
            },
            {
                id: 3,
                email: "user3@example.com",
                subject: "Feature request",
                message: "Can you add dark mode to the application? It would be really helpful.",
                created_at: "2023-06-13T09:15:00",
                status: "unreplied",
                admin_reply: "",
                reply_at: null
            }
        ];

        // DOM elements
        const complaintsBody = document.getElementById('complaints-body');
        const complaintDetailsSection = document.getElementById('complaint-details-section');
        const backToListBtn = document.getElementById('back-to-list');
        const replyForm = document.getElementById('reply-form');
        const successAlert = document.querySelector('.success-alert');
        const errorAlert = document.querySelector('.error-alert');

        // Format date for display
        function formatDate(dateString) {
            if (!dateString) return "Not replied yet";
            const date = new Date(dateString);
            return date.toLocaleString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });
        }

        // Load complaints into the table
        function loadComplaints() {
            complaintsBody.innerHTML = '';
            
            if (complaints.length === 0) {
                complaintsBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4">No complaints found.</td>
                    </tr>
                `;
                return;
            }

            complaints.forEach(complaint => {
                const row = document.createElement('tr');
                row.className = 'highlight-row';
                row.innerHTML = `
                    <td>${complaint.id}</td>
                    <td>${complaint.email}</td>
                    <td>${complaint.subject}</td>
                    <td>${formatDate(complaint.created_at)}</td>
                    <td>
                        ${complaint.status === 'unreplied' ? 
                            '<span class="status-pending">Pending</span>' : 
                            '<span class="status-resolved">Resolved</span>'}
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary view-complaint" data-id="${complaint.id}">
                            <i class="fas fa-eye me-1"></i> View
                        </button>
                    </td>
                `;
                complaintsBody.appendChild(row);
            });

            // Add event listeners to view buttons
            document.querySelectorAll('.view-complaint').forEach(button => {
                button.addEventListener('click', (e) => {
                    const complaintId = parseInt(e.target.closest('.view-complaint').dataset.id);
                    showComplaintDetails(complaintId);
                });
            });
        }

        // Show complaint details
        function showComplaintDetails(complaintId) {
            const complaint = complaints.find(c => c.id === complaintId);
            if (!complaint) return;

            // Fill in the details
            document.getElementById('complaint-id').value = complaint.id;
            document.getElementById('complaint-email').textContent = complaint.email;
            document.getElementById('complaint-subject').textContent = complaint.subject;
            document.getElementById('complaint-date').textContent = formatDate(complaint.created_at);
            document.getElementById('complaint-reply-date').textContent = formatDate(complaint.reply_at);
            document.getElementById('complaint-message').textContent = complaint.message;

            // Show/hide admin reply section
            const adminReplySection = document.getElementById('admin-reply-section');
            if (complaint.admin_reply) {
                adminReplySection.style.display = 'block';
                document.getElementById('admin-reply').textContent = complaint.admin_reply;
            } else {
                adminReplySection.style.display = 'none';
            }

            // Show/hide reply form based on status
            const replyFormSection = document.getElementById('reply-form-section');
            if (complaint.status === 'unreplied') {
                replyFormSection.style.display = 'block';
            } else {
                replyFormSection.style.display = 'none';
            }

            // Show the details section
            document.getElementById('complaint-details-section').style.display = 'block';
            document.getElementById('complaints-table').closest('.row').style.display = 'none';
        }

        // Handle reply submission
        function handleReplySubmit(e) {
            e.preventDefault();
            
            const complaintId = parseInt(document.getElementById('complaint-id').value);
            const replyMessage = document.getElementById('reply_message').value.trim();
            
            if (!replyMessage) {
                showAlert('Please enter a reply message', 'error');
                return;
            }

            // Find the complaint and update it
            const complaintIndex = complaints.findIndex(c => c.id === complaintId);
            if (complaintIndex === -1) {
                showAlert('Complaint not found', 'error');
                return;
            }

            // Update the complaint
            complaints[complaintIndex].admin_reply = replyMessage;
            complaints[complaintIndex].status = 'resolved';
            complaints[complaintIndex].reply_at = new Date().toISOString();

            // Show success message
            showAlert('Reply sent successfully', 'success');

            // Clear the form
            document.getElementById('reply_message').value = '';

            // Update the UI
            showComplaintDetails(complaintId);
            loadComplaints();
        }

        // Show alert message
        function showAlert(message, type) {
            const alert = type === 'success' ? successAlert : errorAlert;
            const alertMessage = alert.querySelector('.alert-message');
            
            alertMessage.textContent = message;
            alert.style.display = 'block';
            
            // Auto-hide after 5 seconds
            setTimeout(() => {
                alert.style.display = 'none';
            }, 5000);
        }

        // Back to list button
        backToListBtn.addEventListener('click', () => {
            document.getElementById('complaint-details-section').style.display = 'none';
            document.getElementById('complaints-table').closest('.row').style.display = 'block';
        });

        // Form submission
        replyForm.addEventListener('submit', handleReplySubmit);

        // Initialize the page
        document.addEventListener('DOMContentLoaded', () => {
            loadComplaints();
            
            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>

</html>