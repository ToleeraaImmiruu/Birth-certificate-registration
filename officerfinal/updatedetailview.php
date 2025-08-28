<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Details - Birth Certificate System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #0d924f;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }

        /* Scoped styles to prevent conflicts */
        .appdetail-content {
            margin-left: 280px;
            padding: 25px;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: var(--light-bg);
            min-height: 100vh;
        }

        .appdetail-main-sidebar.hidden~.appdetail-content {
            margin-left: 0;
        }

        .appdetail-header {
            background: var(--primary-color);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: 5px solid var(--primary-color);
        }

        .appdetail-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-top: 3px solid var(--primary-color);
        }

        .appdetail-photo-container {
            height: 300px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            margin-bottom: 20px;
            overflow: hidden;
            background-color: var(--light-bg);
        }

        .appdetail-thumbnail {
            cursor: pointer;
            transition: all 0.3s;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        .appdetail-thumbnail:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-color);
        }

        .appdetail-badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
        }

        .appdetail-badge-pending {
            background-color: rgba(13, 146, 79, 0.1);
            color: var(--secondary-color);
            border: 1px solid rgba(13, 146, 79, 0.3);
        }

        .appdetail-btn {
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
        }

        .appdetail-btn-approve {
            background-color: var(--secondary-color);
            color: white;
        }

        .appdetail-btn-approve:hover {
            background-color: #0b7a40;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(13, 146, 79, 0.2);
        }

        .appdetail-btn-reject {
            background-color: var(--accent-color);
            color: white;
        }

        .appdetail-btn-reject:hover {
            background-color: #d62b2b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(231, 76, 60, 0.2);
        }

        .appdetail-btn-back {
            background-color: var(--primary-color);
            color: white;
        }

        .appdetail-btn-back:hover {
            background-color: #1a2a3a;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(44, 62, 80, 0.2);
        }

        .appdetail-tabs .nav-link {
            font-weight: 500;
            color: #495057;
            border: none;
            padding: 12px 20px;
            transition: all 0.2s;
        }

        .appdetail-tabs .nav-link.active {
            color: var(--primary-color);
            background-color: transparent;
            border-bottom: 3px solid var(--primary-color);
            font-weight: 600;
        }

        .appdetail-tabs .nav-link:hover {
            color: var(--primary-color);
        }

        .appdetail-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .appdetail-table th {
            background-color: var(--primary-color);
            color: white;
            padding: 14px 16px;
            text-align: left;
            font-weight: 500;
        }

        .appdetail-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: top;
        }

        .appdetail-table tr:last-child td {
            border-bottom: none;
        }

        .appdetail-table tr:hover td {
            background-color: rgba(13, 146, 79, 0.05);
        }

        .appdetail-summary-row {
            cursor: pointer;
            background-color: rgba(44, 62, 80, 0.03);
        }

        .appdetail-summary-row:hover {
            background-color: rgba(44, 62, 80, 0.07);
        }

        .appdetail-detail-row {
            display: none;
        }

        .appdetail-detail-row.show {
            display: table-row;
            animation: fadeIn 0.3s ease-out;
        }

        .appdetail-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1050;
            align-items: center;
            justify-content: center;
        }

        .appdetail-modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            border-top: 4px solid var(--accent-color);
        }

        .appdetail-form-group {
            margin-bottom: 20px;
        }

        .appdetail-form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--primary-color);
        }

        .appdetail-form-group textarea {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            resize: vertical;
            min-height: 120px;
            transition: border 0.2s;
        }

        .appdetail-form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(44, 62, 80, 0.1);
        }

        .appdetail-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .appdetail-animate-show {
            animation: fadeIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom button styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #1a2a3a;
            border-color: #1a2a3a;
        }

        .btn-success {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-success:hover {
            background-color: #0b7a40;
            border-color: #0b7a40;
        }

        /* Alert customization */
        .alert-success {
            background-color: rgba(13, 146, 79, 0.1);
            border-color: rgba(13, 146, 79, 0.2);
            color: var(--secondary-color);
        }

        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border-color: rgba(231, 76, 60, 0.2);
            color: var(--accent-color);
        }
    </style>
</head>

<body>
    <main class="appdetail-content">
        <div class="appdetail-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="mb-1" style="color: var(--primary-color);">Application #<?= $application["id"] ?></h2>
                    <p class="text-muted mb-0">Submitted on <?= date('M d, Y', strtotime($application["submission_date"])) ?></p>
                </div>
                <span class="appdetail-badge appdetail-badge-pending">
                    <i class="fas fa-clock me-1"></i> Pending Review
                </span>
            </div>
        </div>

        <div class="row">
            <!-- Left Column - Application Details -->
            <div class="col-lg-8">
                <div class="appdetail-card">
                    <h4 class="mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-user-circle me-2"></i>Applicant Information
                    </h4>

                    <table class="appdetail-table">
                        <thead>
                            <tr>
                                <th colspan="2">Basic Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="appdetail-summary-row" onclick="toggleDetailRow(this)">
                                <td colspan="2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong style="color: var(--primary-color);"><?= $application["first_name"] . " " . $application["middle_name"] . " " . $application["last_name"] ?></strong>
                                            <div class="text-muted small">Click to view full details</div>
                                        </div>
                                        <i class="fas fa-chevron-down" style="color: var(--primary-color);"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Full Name:</strong></td>
                                <td><?= $application["first_name"] . " " . $application["middle_name"] . " " . $application["last_name"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Date of Birth:</strong></td>
                                <td><?= $application["dob"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Gender:</strong></td>
                                <td><?= $application["gender"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Place of Birth:</strong></td>
                                <td><?= $application["place_of_birth"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Current Address:</strong></td>
                                <td><?= $application["current_address"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Contact Email:</strong></td>
                                <td><?= $application["email"] ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="appdetail-table mt-4">
                        <thead>
                            <tr>
                                <th colspan="2">Parent Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="appdetail-summary-row" onclick="toggleDetailRow(this)">
                                <td colspan="2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong style="color: var(--primary-color);">Parents Details</strong>
                                            <div class="text-muted small">Click to view full details</div>
                                        </div>
                                        <i class="fas fa-chevron-down" style="color: var(--primary-color);"></i>
                                    </div>
                                </td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Father's Name:</strong></td>
                                <td><?= $application["father_name"] ?></td>
                            </tr>
                            <tr class="appdetail-detail-row">
                                <td><strong>Mother's Name:</strong></td>
                                <td><?= $application["mother_name"] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="appdetail-card">
                    <h4 class="mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-file-alt me-2"></i>Supporting Documents
                    </h4>
                    <div class="appdetail-photo-container" id="appdetailMainPhoto">
                        <p class="text-muted">Click a thumbnail below to view document</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3 col-6">
                            <div class="appdetail-thumbnail" onclick="showDocument('<?= htmlspecialchars($application['applicant_id']) ?>', 'Applicant ID')">
                                <img src="<?= htmlspecialchars($application['applicant_id']) ?>" class="img-fluid w-100" alt="Applicant ID">
                                <div class="p-2 text-center small">Applicant ID</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="appdetail-thumbnail" onclick="showDocument('<?= htmlspecialchars($application['mother_id']) ?>', 'Mother ID')">
                                <img src="<?= htmlspecialchars($application['mother_id']) ?>" class="img-fluid w-100" alt="Mother ID">
                                <div class="p-2 text-center small">Mother ID</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="appdetail-thumbnail" onclick="showDocument('<?= htmlspecialchars($application['father_id']) ?>', 'Father ID')">
                                <img src="<?= htmlspecialchars($application['father_id']) ?>" class="img-fluid w-100" alt="Father ID">
                                <div class="p-2 text-center small">Father ID</div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="appdetail-thumbnail" onclick="showDocument('<?= htmlspecialchars($application['birth_record']) ?>', 'Birth Record')">
                                <img src="<?= htmlspecialchars($application['birth_record']) ?>" class="img-fluid w-100" alt="Birth Record">
                                <div class="p-2 text-center small">Birth Record</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Actions and Verification -->
            <div class="col-lg-4">
                <div class="appdetail-card">
                    <h4 class="mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-tasks me-2"></i>Application Actions
                    </h4>
                    <div class="d-grid gap-3">
                        <button class="appdetail-btn appdetail-btn-approve" onclick="approveApplication(<?= $application['id'] ?>)">
                            <i class="fas fa-check-circle"></i> Approve Application
                        </button>
                        <button class="appdetail-btn appdetail-btn-reject" onclick="showRejectModal()">
                            <i class="fas fa-times-circle"></i> Reject Application
                        </button>
                        <a href="sidebar.php?page=application" class="appdetail-btn appdetail-btn-back">
                            <i class="fas fa-arrow-left"></i> Back to Applications
                        </a>
                    </div>
                </div>

                <div class="appdetail-card">
                    <h4 class="mb-4" style="color: var(--primary-color);">
                        <i class="fas fa-search me-2"></i>Record Verification
                    </h4>
                    <ul class="nav nav-tabs appdetail-tabs" id="verificationTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="id-tab" data-bs-toggle="tab" data-bs-target="#id-verification" type="button" role="tab">ID Search</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="certificate-tab" data-bs-toggle="tab" data-bs-target="#certificate-verification" type="button" role="tab">Certificate</button>
                        </li>
                    </ul>

                    <div class="tab-content mt-3" id="verificationTabContent">
                        <div class="tab-pane fade show active" id="id-verification" role="tabpanel">
                            <form id="idSearchForm">
                                <div class="mb-3">
                                    <label for="idNumber" class="form-label">ID Number</label>
                                    <input type="text" class="form-control" id="idNumber" name="kebele_id" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-2"></i> Search ID
                                </button>
                            </form>
                            <div id="idSearchResult" class="mt-3 appdetail-animate-show"></div>
                        </div>

                        <div class="tab-pane fade" id="certificate-verification" role="tabpanel">
                            <form id="certificateSearchForm">
                                <div class="mb-3">
                                    <label for="certificateNumber" class="form-label">Certificate Number</label>
                                    <input type="text" class="form-control" id="certificateNumber" name="certificate_id" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-search me-2"></i> Search Certificate
                                </button>
                            </form>
                            <div id="certificateSearchResult" class="mt-3 appdetail-animate-show"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Reject Modal -->
    <div class="appdetail-modal" id="rejectModal">
        <div class="appdetail-modal-content">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0" style="color: var(--accent-color);">
                    <i class="fas fa-exclamation-triangle me-2"></i>Reject Application
                </h4>
                <button type="button" class="btn-close" onclick="hideRejectModal()"></button>
            </div>
            <form id="rejectForm" method="POST" action="updatdetailview.php">
                <input type="hidden" name="app_id" value="<?= $application['id'] ?>">
                <div class="appdetail-form-group">
                    <label for="rejectReason">Reason for Rejection</label>
                    <textarea id="rejectReason" name="message_of_rejection" required placeholder="Please provide a detailed reason for rejecting this application..."></textarea>
                </div>
                <div class="appdetail-form-actions">
                    <button type="button" class="btn btn-outline-secondary" onclick="hideRejectModal()">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle me-1"></i> Submit Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle detail rows
        function toggleDetailRow(row) {
            const detailRows = row.parentNode.querySelectorAll('.appdetail-detail-row');
            const icon = row.querySelector('i');

            detailRows.forEach(r => {
                r.classList.toggle('show');
            });

            if (icon.classList.contains('fa-chevron-down')) {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        }

        // Show document in main viewer
        function showDocument(src, title) {
            const mainPhoto = document.getElementById('appdetailMainPhoto');
            if (src && src !== 'photo is not uploaded') {
                mainPhoto.innerHTML = `
                    <div class="text-center w-100">
                        <img src="${src}" alt="${title}" class="img-fluid" style="max-height: 280px;">
                        <div class="mt-2 small text-muted">${title}</div>
                    </div>
                `;
            } else {
                mainPhoto.innerHTML = '<p class="text-muted">Document not available</p>';
            }
        }

        // Show reject modal
        function showRejectModal() {
            document.getElementById('rejectModal').style.display = 'flex';
        }

        // Hide reject modal
        function hideRejectModal() {
            document.getElementById('rejectModal').style.display = 'none';
            document.getElementById('rejectForm').reset();
        }

        // Approve application
        function approveApplication(appId) {
            if (confirm('Are you sure you want to approve this application?')) {
                fetch('approved.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'app_id=' + encodeURIComponent(appId)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Application approved successfully!');
                            window.location.href = 'sidebar.php?page=application';
                        } else {
                            alert('Error: ' + (data.message || 'Failed to approve application'));
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('An error occurred while approving the application');
                    });
            }
        }

        // Initialize photo display
        showDocument('<?= htmlspecialchars($application['applicant_id']) ?>', 'Applicant ID');

        // ID Search
        document.getElementById('idSearchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const resultDiv = document.getElementById('idSearchResult');
            resultDiv.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2">Searching...</p>
                </div>
            `;

            const idValue = document.getElementById('idNumber').value;

            fetch('search_ID.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'kebele_id=' + encodeURIComponent(idValue)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resultDiv.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> ID record found
                        </div>
                        <div class="p-3 bg-light rounded">
                            <p><strong>Name:</strong> ${data.kebele_id.first_name} ${data.kebele_id.middle_name || ''} ${data.kebele_id.last_name}</p>
                            <p><strong>ID Number:</strong> ${data.kebele_id.kebele_id_number}</p>
                            <p><strong>Date of Birth:</strong> ${data.kebele_id.date_of_birth || 'N/A'}</p>
                            <p><strong>Gender:</strong> ${data.kebele_id.gender || 'N/A'}</p>
                        </div>
                    `;
                    } else {
                        resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> ${data.message || 'ID not found'}
                        </div>
                    `;
                    }
                })
                .catch(err => {
                    resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> Error fetching data
                    </div>
                `;
                    console.error(err);
                });
        });

        // Certificate Search
        document.getElementById('certificateSearchForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const resultDiv = document.getElementById('certificateSearchResult');
            resultDiv.innerHTML = `
                <div class="text-center py-4">
                    <div class="spinner-border text-success" role="status"></div>
                    <p class="mt-2">Searching...</p>
                </div>
            `;

            const certId = document.getElementById('certificateNumber').value;

            fetch('search_certificate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'certificate_id=' + encodeURIComponent(certId)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        resultDiv.innerHTML = `
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> Certificate record found
                        </div>
                        <div class="p-3 bg-light rounded">
                            <p><strong>Certificate ID:</strong> ${data.birth_record.record_id}</p>
                            <p><strong>Child Name:</strong> ${data.birth_record.child_name}</p>
                            <p><strong>Father's Name:</strong> ${data.birth_record.father_name}</p>
                            <p><strong>Mother's Name:</strong> ${data.birth_record.mother_name}</p>
                            <p><strong>Date of Birth:</strong> ${data.birth_record.dob}</p>
                            <p><strong>Hospital:</strong> ${data.hospital.name || 'N/A'}</p>
                        </div>
                    `;
                    } else {
                        resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> ${data.message || 'Certificate not found'}
                        </div>
                    `;
                    }
                })
                .catch(err => {
                    resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i> Error fetching data
                    </div>
                `;
                    console.error(err);
                });
        });
    </script>
</body>

</html>