<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Efa Bula  Digital ID Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-container {
            max-width: 1000px;
            margin: 30px auto;
        }
        .id-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
            position: relative;
        }
        .id-card-header {
            background-color: #006233;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: bold;
        }
        .id-card-body {
            padding: 20px;
        }
        .id-photo-placeholder {
            width: 120px;
            height: 120px;
            background-color: #e9ecef;
            border: 1px solid #dee2e6;
            margin-right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            overflow: hidden;
        }
        .id-photo-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .id-detail {
            margin-bottom: 10px;
        }
        .id-label {
            font-weight: bold;
            color: #495057;
            display: inline-block;
            width: 150px;
        }
        .id-value {
            color: #212529;
        }
        .hidden-details {
            display: none;
        }
        .qr-code {
            width: 80px;
            height: 80px;
            background-color: #e9ecef;
            position: absolute;
            right: 20px;
            bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 10px;
            text-align: center;
        }
        .footer-note {
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            margin-top: 15px;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        .id-list-item {
            background-color: white;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            transition: all 0.3s;
        }
        .id-list-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .search-container {
            margin-bottom: 20px;
        }
        .no-results {
            text-align: center;
            padding: 20px;
            color: #6c757d;
        }
        .list-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div class="container card-container">
        <h2 class="text-center mb-4">Ethiopian Digital ID Management</h2>
        
        <div class="search-container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search by ID number (FCN or FIN)">
                        <button class="btn btn-primary" id="searchBtn">Search</button>
                        <button class="btn btn-outline-secondary" id="resetBtn">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <h5>ID Card List</h5>
                    <div id="idList">
                        <!-- ID list will be populated by JavaScript -->
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div id="idCardDisplay">
                    <!-- Selected ID card will be displayed here -->
                    <div class="alert alert-info">
                        Select an ID from the list to view details
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Template for ID list items -->
    <template id="idListItemTemplate">
        <div class="id-list-item" data-id="">
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/40" alt="Profile image" class="list-photo">
                <div class="flex-grow-1">
                    <strong class="full-name d-block"></strong>
                    <span class="id-number text-muted small"></span>
                </div>
                <span class="badge bg-secondary gender-badge"></span>
            </div>
        </div>
    </template>

    <!-- Template for ID card display -->
    <template id="idCardTemplate">
        <div class="id-card">
            <div class="id-card-header">
                ETHIOPIAN DIGITAL ID CARD
            </div>
            <div class="id-card-body">
                <div class="d-flex mb-4">
                    <div class="id-photo-placeholder">
                        <img src="https://via.placeholder.com/120" alt="ID photo">
                    </div>
                    <div>
                        <div class="id-detail">
                            <span class="id-label">FIRST NAME:</span>
                            <span class="id-value" id="firstName"></span>
                        </div>
                        <div class="id-detail">
                            <span class="id-label">MIDDLE NAME:</span>
                            <span class="id-value" id="middleName"></span>
                        </div>
                        <div class="id-detail">
                            <span class="id-label">LAST NAME:</span>
                            <span class="id-value" id="lastName"></span>
                        </div>
                        <div class="id-detail">
                            <span class="id-label">GENDER:</span>
                            <span class="id-value" id="gender"></span>
                        </div>
                    </div>
                </div>
                
                <div id="fullDetails" class="hidden-details">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="id-detail">
                                <span class="id-label">DATE OF BIRTH:</span>
                                <span class="id-value" id="dob"></span>
                            </div>
                            <div class="id-detail">
                                <span class="id-label">AGE:</span>
                                <span class="id-value" id="age"></span>
                            </div>
                            <div class="id-detail">
                                <span class="id-label">NATIONALITY:</span>
                                <span class="id-value" id="nationality"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="id-detail">
                                <span class="id-label">REGION:</span>
                                <span class="id-value" id="region"></span>
                            </div>
                            <div class="id-detail">
                                <span class="id-label">ZONE:</span>
                                <span class="id-value" id="zone"></span>
                            </div>
                            <div class="id-detail">
                                <span class="id-label">WOREDA:</span>
                                <span class="id-value" id="woreda"></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="id-detail mt-3">
                        <span class="id-label">PHONE NUMBER:</span>
                        <span class="id-value" id="phone"></span>
                    </div>
                    <div class="id-detail">
                        <span class="id-label">ID NUMBER:</span>
                        <span class="id-value" id="fcn"></span>
                    </div>
                    <div class="id-detail">
                        <span class="id-label">FIN NUMBER:</span>
                        <span class="id-value" id="fin"></span>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button id="viewDetailsBtn" class="btn btn-primary">View Full Details</button>
                    <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=IDCard" alt="QR Code">
                    </div>
                </div>
                
                <div class="footer-note">
                    If you find this card, please return to the issuing organization (id.et) or to the nearest police station.
                </div>
            </div>
        </div>
    </template>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sample data for ID cards
            const idCards = [
                {
                    id: 1,
                    firstName: "Ebisa",
                    middleName: "Berhanu",
                    lastName: "Woyuma",
                    gender: "Male",
                    dob: "28/11/1996",
                    nationality: "Ethiopian",
                    region: "Oromia",
                    zone: "Jimmo City Administration",
                    woreda: "M1.f",
                    phone: "0953935589",
                    fcn: "FCN 5264192548312970",
                    fin: "FIN 3289 6851 4257",
                    photo: "image/office-bulding.jpg"
                },
                {
                    id: 2,
                    firstName: "Anam ",
                    middleName: "tesfa",
                    lastName: "Mosisa",
                    gender: "Male",
                    dob: "27/10/2016",
                    nationality: "Ethiopian",
                    region: "Promia",
                    zone: "West Wellega",
                    woreda: "Wed-11 MAJ",
                    phone: "0945744342",
                    fcn: "FCN 3481429501562753",
                    fin: "FIN 527085071269",
                    photo: "https://randomuser.me/api/portraits/women/44.jpg"
                }
            ];

            // DOM elements
            const idList = document.getElementById('idList');
            const idCardDisplay = document.getElementById('idCardDisplay');
            const searchInput = document.getElementById('searchInput');
            const searchBtn = document.getElementById('searchBtn');
            const resetBtn = document.getElementById('resetBtn');
            const idListItemTemplate = document.getElementById('idListItemTemplate').content;
            const idCardTemplate = document.getElementById('idCardTemplate').content;

            // Initialize the application
            function init() {
                renderIdList(idCards);
            }

            // Render the ID list
            function renderIdList(cards) {
                idList.innerHTML = '';
                
                if (cards.length === 0) {
                    idList.innerHTML = '<div class="no-results">No ID cards found</div>';
                    return;
                }
                
                cards.forEach(card => {
                    const listItem = idListItemTemplate.cloneNode(true);
                    const listItemElement = listItem.querySelector('.id-list-item');
                    listItemElement.dataset.id = card.id;
                    
                    const fullName = `${card.firstName} ${card.middleName} ${card.lastName}`.trim();
                    listItem.querySelector('.full-name').textContent = fullName;
                    listItem.querySelector('.id-number').textContent = card.fcn;
                    listItem.querySelector('.gender-badge').textContent = card.gender;
                    listItem.querySelector('.list-photo').src = card.photo;
                    listItem.querySelector('.list-photo').alt = `${fullName} photo`;
                    
                    listItemElement.addEventListener('click', () => displayIdCard(card));
                    
                    idList.appendChild(listItem);
                });
            }

            // Display the selected ID card
            function displayIdCard(card) {
                const cardElement = idCardTemplate.cloneNode(true);
                
                // Basic info
                cardElement.getElementById('firstName').textContent = card.firstName;
                cardElement.getElementById('middleName').textContent = card.middleName;
                cardElement.getElementById('lastName').textContent = card.lastName;
                cardElement.getElementById('gender').textContent = card.gender;
                
                // Full details
                cardElement.getElementById('dob').textContent = card.dob;
                cardElement.getElementById('age').textContent = calculateAge(card.dob);
                cardElement.getElementById('nationality').textContent = card.nationality;
                cardElement.getElementById('region').textContent = card.region;
                cardElement.getElementById('zone').textContent = card.zone;
                cardElement.getElementById('woreda').textContent = card.woreda;
                cardElement.getElementById('phone').textContent = card.phone;
                cardElement.getElementById('fcn').textContent = card.fcn;
                cardElement.getElementById('fin').textContent = card.fin;
                
                // Set photo
                const fullName = `${card.firstName} ${card.middleName} ${card.lastName}`.trim();
                cardElement.querySelector('.id-photo-placeholder img').src = card.photo;
                cardElement.querySelector('.id-photo-placeholder img').alt = `${fullName} ID photo`;
                
                // Generate QR code with ID info
                const qrData = `Name: ${fullName}\nID: ${card.fcn}\nDOB: ${card.dob}`;
                cardElement.querySelector('.qr-code img').src = `https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=${encodeURIComponent(qrData)}`;
                cardElement.querySelector('.qr-code img').alt = "ID Card QR Code";
                
                // Add event listener for view details button
                const viewDetailsBtn = cardElement.getElementById('viewDetailsBtn');
                const fullDetails = cardElement.getElementById('fullDetails');
                
                viewDetailsBtn.addEventListener('click', function() {
                    if (fullDetails.classList.contains('hidden-details')) {
                        fullDetails.classList.remove('hidden-details');
                        viewDetailsBtn.textContent = 'Hide Details';
                    } else {
                        fullDetails.classList.add('hidden-details');
                        viewDetailsBtn.textContent = 'View Full Details';
                    }
                });
                
                idCardDisplay.innerHTML = '';
                idCardDisplay.appendChild(cardElement);
            }

            // Calculate age from date of birth
            function calculateAge(dobString) {
                const parts = dobString.split('/');
                const dob = new Date(parts[2], parts[1] - 1, parts[0]);
                const today = new Date();
                let age = today.getFullYear() - dob.getFullYear();
                const monthDiff = today.getMonth() - dob.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                }
                return age;
            }

            // Search functionality
            searchBtn.addEventListener('click', function() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                
                if (!searchTerm) {
                    renderIdList(idCards);
                    return;
                }
                
                const filteredCards = idCards.filter(card => {
                    return card.fcn.toLowerCase().includes(searchTerm) || 
                           card.fin.toLowerCase().includes(searchTerm);
                });
                
                renderIdList(filteredCards);
            });

            // Reset search
            resetBtn.addEventListener('click', function() {
                searchInput.value = '';
                renderIdList(idCards);
                idCardDisplay.innerHTML = '<div class="alert alert-info">Select an ID from the list to view details</div>';
            });

            // Initialize the app
            init();
        });
    </script>
</body>
</html>