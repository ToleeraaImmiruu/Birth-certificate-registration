<?php
include "../setup/dbconnection.php";

$sql = "SELECT * FROM payments";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="payment-header text-center">
    <h1>Payment Management System</h1>
    <p class="mb-0">Review and process birth certificate applications</p>
</div>

<div class="payment-container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card payment-card">
                <div class="card-header">
                    <h5 class="mb-0">Pending Payments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Certificate ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="paymentList">
                                <?php if ($result && $result->num_rows > 0): ?>
                                    <?php while ($payment = $result->fetch_assoc()): ?>
                                        <tr id="row-<?= $payment['id'] ?>">
                                            <td><?= htmlspecialchars($payment['full_name']) ?></td>
                                            <td><?= htmlspecialchars($payment['certificate_id']) ?></td>
                                            <td><button class="btn btn-view btn-sm" data-id="<?= $payment['id'] ?>">View</button></td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">NO PAYMENTS FOUND</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="paymentDetails" class="details-container">
                <h4>Payment Details</h4>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Full Name:</strong> <span id="detailName"></span></p>
                        <p><strong>Certificate ID:</strong> <span id="detailAppId"></span></p>
                        <p><strong>Phone Number:</strong> <span id="detailPhone"></span></p>
                        <p><strong>Amount (ETB):</strong> <span id="detailAmount"></span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Payment Screenshot:</strong></p>
                        <img id="detailScreenshot" src="" alt="Payment Screenshot" class="screenshot-preview">
                    </div>
                </div>
                <div class="mt-4 text-end">
                    <button id="rejectBtn" class="btn btn-reject me-2">Reject</button>
                    <button id="approveBtn" class="btn btn-approve">Approve</button>
                    <button id="closeBtn" class="btn btn-secondary">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Make sure this script only runs when included in the main layout
    document.addEventListener('DOMContentLoaded', function() {
        // Close button functionality
        document.getElementById('closeBtn').onclick = function() {
            document.getElementById('paymentDetails').style.display = 'none';
        };

        // View button functionality
        document.querySelectorAll('.btn-view').forEach(button => {
            button.addEventListener('click', function() {
                const paymentId = this.getAttribute('data-id');
                fetchPaymentDetails(paymentId);
            });
        });

        // Fetch payment details via AJAX
        function fetchPaymentDetails(paymentId) {
            fetch('get_payment_detail.php?id=' + paymentId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showPaymentDetails(data.payment);
                    } else {
                        alert('Error loading payment details');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading payment details');
                });
        }

        // Display payment details
        function showPaymentDetails(payment) {
            document.getElementById('detailName').textContent = payment.full_name;
            document.getElementById('detailAppId').textContent = payment.certificate_id;
            document.getElementById('detailPhone').textContent = payment.phone;
            document.getElementById('detailAmount').textContent = payment.amount;
            document.getElementById('detailScreenshot').src = window.location.origin + '/birth_certificate_project/userdashboard/' + payment.payment_IMG;

            const paymentDetails = document.getElementById('paymentDetails');
            paymentDetails.style.display = 'block';

            // Scroll to details
            paymentDetails.scrollIntoView({
                behavior: 'smooth'
            });

            // Set up approve/reject buttons
            document.getElementById('approveBtn').onclick = function() {
                updatePaymentStatus(payment.id, 'paid', payment.certificate_id);
            };

            document.getElementById('rejectBtn').onclick = function() {
                updatePaymentStatus(payment.id, 'rejected', payment.certificate_id);
            };
        }

        // Update payment status
        function updatePaymentStatus(paymentId, status, certificate_id) {
            fetch('update_payment_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: paymentId,
                        status: status,
                        certificate_id: certificate_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(`Payment ${status} successfully!`);
                        document.getElementById('paymentDetails').style.display = 'none';
                        document.getElementById("row-" + paymentId).remove();
                    } else {
                        alert('Error updating payment status');
                    }
                });
        }
    });
</script>