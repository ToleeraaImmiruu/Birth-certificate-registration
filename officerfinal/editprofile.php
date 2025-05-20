<div class="profile-page-container">
    <div class="profile-header-section text-center">
        <h1>Edit Your Profile</h1>
        <p class="profile-subtitle">Update your personal information</p>
    </div>

    <div class="profile-content-container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="profile-main-card">
                    <div class="profile-card-header">
                        <img src="pp.png" alt="Profile Picture" class="profile-avatar" id="profileAvatar">
                        <div class="profile-edit-icon" id="profileEditPhotoBtn">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3>Personal Information</h3>
                    </div>
                    <div class="profile-card-body">
                        <form id="profileEditForm">
                            <div class="mb-4">
                                <label for="profileFullName" class="profile-field-label">Full Name</label>
                                <div class="profile-input-group">
                                    <span class="profile-input-icon"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control profile-form-input" id="profileFullName" placeholder="Enter your full name">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="profileEmail" class="profile-field-label">Email Address</label>
                                <div class="profile-input-group">
                                    <span class="profile-input-icon"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control profile-form-input" id="profileEmail" placeholder="Enter your email">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="profilePhone" class="profile-field-label">Phone Number</label>
                                <div class="profile-input-group">
                                    <span class="profile-input-icon"><i class="fas fa-phone"></i></span>
                                    <input type="tel" class="form-control profile-form-input" id="profilePhone" placeholder="Enter your phone number">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="profilePassword" class="profile-field-label">Password</label>
                                <div class="profile-input-group">
                                    <span class="profile-input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control profile-form-input" id="profilePassword" placeholder="Enter new password">
                                    <button class="btn profile-password-toggle-btn" type="button" id="profileTogglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <small class="profile-hint-text">Leave blank to keep current password</small>
                            </div>

                            <div class="mb-4">
                                <label for="profileConfirmPassword" class="profile-field-label">Confirm Password</label>
                                <div class="profile-input-group">
                                    <span class="profile-input-icon"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control profile-form-input" id="profileConfirmPassword" placeholder="Confirm new password">
                                    <button class="btn profile-password-toggle-btn" type="button" id="profileToggleConfirmPassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="profile-form-actions">
                                <button type="button" class="btn btn-outline-secondary profile-cancel-btn">Cancel</button>
                                <button type="submit" class="btn profile-save-btn">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Picture Modal -->
    <div class="modal fade" id="profilePictureModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="profile-modal-content">
                        <div class="mb-3">
                            <img src="https://via.placeholder.com/150" id="profileCurrentPicture" class="profile-modal-preview">
                        </div>
                        <input type="file" class="form-control" id="profilePictureUpload" accept="image/*">
                        <small class="profile-modal-hint">Recommended size: 150x150 pixels</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="profileSavePictureBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Only run if we're on the profile page
        if (document.querySelector('.profile-page-container')) {
            // Initialize modal
            const profilePicModal = new bootstrap.Modal(document.getElementById('profilePictureModal'));

            // Open modal when change photo button is clicked
            document.getElementById('profileEditPhotoBtn').addEventListener('click', function() {
                profilePicModal.show();
            });

            // Preview image when file is selected
            document.getElementById('profilePictureUpload').addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        document.getElementById('profileCurrentPicture').src = event.target.result;
                    }

                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            // Save profile picture
            document.getElementById('profileSavePictureBtn').addEventListener('click', function() {
                const newPicSrc = document.getElementById('profileCurrentPicture').src;
                document.getElementById('profileAvatar').src = newPicSrc;
                profilePicModal.hide();

                // Here you would typically upload the image to your server
                alert('Profile picture updated successfully!');
            });

            // Toggle password visibility
            document.getElementById('profileTogglePassword').addEventListener('click', function() {
                const passwordInput = document.getElementById('profilePassword');
                const icon = this.querySelector('i');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            // Toggle confirm password visibility
            document.getElementById('profileToggleConfirmPassword').addEventListener('click', function() {
                const confirmPasswordInput = document.getElementById('profileConfirmPassword');
                const icon = this.querySelector('i');
                if (confirmPasswordInput.type === 'password') {
                    confirmPasswordInput.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    confirmPasswordInput.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            // Handle form submission
            document.getElementById('profileEditForm').addEventListener('submit', function(e) {
                e.preventDefault();

                // Get form values
                const fullName = document.getElementById('profileFullName').value;
                const email = document.getElementById('profileEmail').value;
                const phone = document.getElementById('profilePhone').value;
                const password = document.getElementById('profilePassword').value;
                const confirmPassword = document.getElementById('profileConfirmPassword').value;

                // Validate passwords if they were entered
                if (password || confirmPassword) {
                    if (password !== confirmPassword) {
                        alert('Passwords do not match!');
                        return;
                    }

                    if (password.length < 8) {
                        alert('Password must be at least 8 characters long!');
                        return;
                    }
                }

                // Here you would typically send this data to your server
                console.log('Profile updated:', {
                    fullName,
                    email,
                    phone,
                    password: password ? '*****' : 'unchanged'
                });

                // Show success message
                alert('Profile updated successfully!');
            });
        }
    });
</script> -->