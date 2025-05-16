<?php
// require "../userdashboard/init.php";
include "../setup/dbconnection.php";

$sql = "SELECT * FROM payments ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management System</title>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            margin-bottom: 30px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .payment-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }

        .payment-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }

        .btn-view {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-view:hover {
            background-color: #1a252f;
            color: white;
        }

        .btn-approve {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-reject {
            background-color: var(--accent-color);
            color: white;
        }

        .details-container {
            display: none;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .screenshot-preview {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 10px;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .pending {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>

<body>
    <div class="header text-center">
        <h1>Payment Management System</h1>
        <p class="mb-0">Review and process birth certificate applications</p>
    </div>

    <div class="container">
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
                                    <?php
                                  if($result && $result->num_rows > 0){
                                    while ($payment = $result->fetch_assoc()) {
                                        echo "<tr id='row-" . $payment['id']. "'>";
                                        echo "<td>" . htmlspecialchars($payment['full_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($payment['certificate_id']) . "</td>";
                                        echo '<td><button class="btn btn-view btn-sm" data-id="' . $payment['id'] . '">View</button></td>';
                                        echo "</tr>";
                                    }
                                 } else{
                                        echo "<tr?>
                                        <td colspan='3' class='text-center'>NO PAYMENTS FOUND</td>
                                        </tr>";
                                    }

                                    ?>
                                    <!-- Payment list will be populated here -->
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
                            <p><strong>Full Name:</strong> <span id="detailName"><?php echo $payment["full_name"] ?></span></p>
                            <p><strong>Certificate ID:</strong> <span id="detailAppId"><?php echo $payment["certificate_id"] ?></< /span>
                            </p>
                            <p><strong>Phone Number:</strong> <span id="detailPhone"><?php echo $payment["phone"] ?></< /span>
                            </p>
                            <p><strong>Amount (ETB):</strong> <span id="detailAmount"><?php echo $payment["amount"] ?></< /span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Payment Screenshot:</strong></p>
                            <img id="detailScreenshot" src="../userdashboard/<?php echo $payment['payment_IMG'] ?>" alt="Payment Screenshot" class="screenshot-preview">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add event listeners to view buttons after page loads
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
            // In showPaymentDetails()
            document.getElementById('detailScreenshot').src = window.location.origin + '/    birth_certificate_project/userdashboard/' + payment.payment_IMG;

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
                        // Optionally refresh the payment list
                        window.location.reload();
                    } else {
                        alert('Error updating payment status');
                    }
                });
        }
    </script>
</body>

</html>