<div class="support-dashboard">
    <style>
        /* Scoped styles for support dashboard only */
        .support-dashboard {
            --support-primary-color: #2c3e50;
            --support-secondary-color: #0d924f;
            --support-accent-color: #e74c3c;
            --support-light-bg: #f8f9fa;
            --support-unread-bg: #f0f8ff;
        }

        .support-dashboard .support-container {
            max-width: 1200px;
            margin: 0 auto;
            font-family: 'Poppins', sans-serif;
        }

        .support-dashboard .support-header {
            color: var(--support-primary-color);
            position: relative;
            padding-bottom: 1rem;
        }

        .support-dashboard .support-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 4px;
            background: var(--support-secondary-color);
            border-radius: 2px;
        }

        .support-dashboard .support-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
        }

        .support-dashboard .support-card.unread {
            background-color: var(--support-unread-bg);
            border-left: 4px solid var(--support-accent-color);
        }

        .support-dashboard .support-card:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .support-dashboard .support-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--support-secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .support-dashboard .support-subject {
            font-weight: 600;
            color: var(--support-primary-color);
            margin-bottom: 0.2rem;
        }

        .support-dashboard .support-preview {
            color: #6c757d;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .support-dashboard .support-date {
            color: #6c757d;
            font-size: 0.85rem;
        }

        .support-dashboard .support-badge-status {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 4px 8px;
        }

        .support-dashboard .support-history-container {
            max-height: 400px;
            overflow-y: auto;
            padding-right: 10px;
        }

        .support-dashboard .support-message-item {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 8px;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .support-dashboard .support-message-item.user {
            border-left: 3px solid var(--support-secondary-color);
        }

        .support-dashboard .support-message-item.officer {
            border-left: 3px solid var(--support-primary-color);
        }

        .support-dashboard .support-message-meta {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .support-dashboard .support-message-content {
            line-height: 1.5;
        }

        .support-dashboard .support-reply-form {
            margin-top: 20px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .support-dashboard .support-form-control:focus {
            border-color: var(--support-secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 146, 79, 0.25);
        }

        .support-dashboard .support-btn-primary {
            background-color: var(--support-secondary-color);
            border-color: var(--support-secondary-color);
        }

        .support-dashboard .support-btn-primary:hover {
            background-color: #0b7a41;
            border-color: #0b7a41;
        }

        .support-dashboard .support-sidebar {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .support-dashboard .support-nav-pills .nav-link.active {
            background-color: var(--support-secondary-color);
        }

        .support-dashboard .support-nav-pills .nav-link {
            color: var(--support-primary-color);
        }

        .support-dashboard .support-unread-count {
            background-color: var(--support-accent-color);
        }

        .support-dashboard .support-details {
            background-color: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="support-container container-fluid py-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="support-sidebar">
                    <h4 class="mb-4">Support Dashboard</h4>

                    <ul class="nav support-nav-pills flex-column mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-inbox me-2"></i> All Requests
                                <span class="badge support-unread-count float-end">3</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-check-circle me-2"></i> Resolved
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-clock me-2"></i> Pending
                            </a>
                        </li>
                    </ul>

                    <h5 class="mt-4 mb-3">Filters</h5>
                    <div class="mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-select">
                            <option>All</option>
                            <option>High</option>
                            <option>Medium</option>
                            <option>Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Date Range</label>
                        <select class="form-select">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 3 months</option>
                            <option>All time</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="row mb-4">
                    <div class="col">
                        <h2 class="support-header">
                            <i class="fas fa-headset me-2"></i>User Support Requests
                        </h2>
                    </div>
                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search requests...">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Support Requests List -->
                <div class="row">
                    <div class="col-md-5 pe-md-3">
                        <div class="support-list">
                            <!-- Support Request 1 -->
                            <div class="support-card card unread" data-bs-toggle="collapse" href="#request1" role="button">
                                <div class="card-body py-3">
                                    <div class="d-flex gap-3">
                                        <div class="support-user-avatar">EB</div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="support-subject mb-1">Login Issues</h5>
                                                <span class="support-date">Today, 10:30 AM</span>
                                            </div>
                                            <p class="support-preview mb-1">I can't log in to my account despite resetting my password...</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="badge bg-warning text-dark support-badge-status">Pending</span>
                                                <span class="badge bg-danger support-badge-status">High Priority</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Support Request 2 -->
                            <div class="support-card card" data-bs-toggle="collapse" href="#request2" role="button">
                                <div class="card-body py-3">
                                    <div class="d-flex gap-3">
                                        <div class="support-user-avatar">AT</div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="support-subject mb-1">Payment Refund</h5>
                                                <span class="support-date">Yesterday, 2:15 PM</span>
                                            </div>
                                            <p class="support-preview mb-1">I was charged twice for my subscription and need a refund...</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="badge bg-info text-dark support-badge-status">In Progress</span>
                                                <span class="badge bg-warning text-dark support-badge-status">Medium Priority</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Support Request 3 -->
                            <div class="support-card card" data-bs-toggle="collapse" href="#request3" role="button">
                                <div class="card-body py-3">
                                    <div class="d-flex gap-3">
                                        <div class="support-user-avatar">MK</div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <h5 class="support-subject mb-1">Feature Request</h5>
                                                <span class="support-date">May 12, 10:45 AM</span>
                                            </div>
                                            <p class="support-preview mb-1">Would it be possible to add bulk editing to the dashboard...</p>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <span class="badge bg-success support-badge-status">Resolved</span>
                                                <span class="badge bg-secondary support-badge-status">Low Priority</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Request Details -->
                    <div class="col-md-7 ps-md-3">
                        <div class="support-details">
                            <!-- Default empty state -->
                            <div id="emptyState" class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">Select a support request</h4>
                                <p class="text-muted">Choose a request from the list to view details and respond</p>
                            </div>

                            <!-- Request 1 Details (hidden by default) -->
                            <div id="request1" class="collapse">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4>Login Issues</h4>
                                    <div>
                                        <span class="badge bg-warning text-dark me-2">Pending</span>
                                        <span class="badge bg-danger">High Priority</span>
                                    </div>
                                </div>

                                <div class="user-info mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="support-user-avatar me-3">EB</div>
                                        <div>
                                            <h5 class="mb-1">Ebisa Berhanu</h5>
                                            <p class="text-muted mb-1">ebisa@example.com</p>
                                            <p class="text-muted small">Submitted: Today, 10:30 AM</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="support-history-container mb-4">
                                    <!-- Initial request -->
                                    <div class="support-message-item user">
                                        <div class="support-message-meta">
                                            <strong>Ebisa Berhanu</strong> - Today, 10:30 AM
                                        </div>
                                        <div class="support-message-content">
                                            <p>Hello, I'm having trouble logging into my account. I've tried resetting my password multiple times but still can't access my account. The system says my credentials are invalid. Please help!</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="support-reply-form">
                                    <h5 class="mb-3"><i class="fas fa-reply me-2"></i>Reply to Ebisa</h5>
                                    <form>
                                        <div class="mb-3">
                                            <textarea class="form-control support-form-control" rows="4" placeholder="Type your response..." required></textarea>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="markResolved">
                                                <label class="form-check-label" for="markResolved">
                                                    Mark as resolved
                                                </label>
                                            </div>
                                            <button type="submit" class="btn support-btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Send Response
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Request 2 Details (hidden by default) -->
                            <div id="request2" class="collapse">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4>Payment Refund</h4>
                                    <div>
                                        <span class="badge bg-info text-dark me-2">In Progress</span>
                                        <span class="badge bg-warning text-dark">Medium Priority</span>
                                    </div>
                                </div>

                                <div class="user-info mb-4">
                                    <div class="d-flex align-items-center">
                                        <div class="support-user-avatar me-3">AT</div>
                                        <div>
                                            <h5 class="mb-1">Anma Tesfa</h5>
                                            <p class="text-muted mb-1">anma@example.com</p>
                                            <p class="text-muted small">Submitted: Yesterday, 2:15 PM</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="support-history-container mb-4">
                                    <!-- Initial request -->
                                    <div class="support-message-item user">
                                        <div class="support-message-meta">
                                            <strong>Anma Tesfa</strong> - Yesterday, 2:15 PM
                                        </div>
                                        <div class="support-message-content">
                                            <p>I noticed that I was charged twice for my monthly subscription on May 10th. I've attached screenshots of both transactions. Could you please process a refund for the duplicate charge?</p>
                                        </div>
                                    </div>

                                    <!-- Officer response -->
                                    <div class="support-message-item officer mt-3">
                                        <div class="support-message-meta">
                                            <strong>Officer Response</strong> - Yesterday, 3:45 PM
                                        </div>
                                        <div class="support-message-content">
                                            <p>Hello Anma,</p>
                                            <p>Thank you for bringing this to our attention. I've reviewed your account and can confirm the duplicate charge. Our finance team has been notified and will process your refund within 3-5 business days.</p>
                                            <p>Please let me know if you have any other questions.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="support-reply-form">
                                    <h5 class="mb-3"><i class="fas fa-reply me-2"></i>Reply to Anma</h5>
                                    <form>
                                        <div class="mb-3">
                                            <textarea class="form-control support-form-control" rows="4" placeholder="Type your response..." required></textarea>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="markResolved2">
                                                <label class="form-check-label" for="markResolved2">
                                                    Mark as resolved
                                                </label>
                                            </div>
                                            <button type="submit" class="btn support-btn-primary">
                                                <i class="fas fa-paper-plane me-1"></i> Send Response
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple script to handle the empty state and request selection
        document.addEventListener('DOMContentLoaded', function() {
            const supportCards = document.querySelectorAll('.support-card');
            const emptyState = document.getElementById('emptyState');

            supportCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Hide empty state when a request is selected
                    if (emptyState) emptyState.style.display = 'none';

                    // Remove active class from all cards
                    supportCards.forEach(c => {
                        c.classList.remove('active');
                        c.classList.remove('unread');
                    });

                    // Add active class to clicked card
                    this.classList.add('active');
                });
            });
        });
    </script>
</div>