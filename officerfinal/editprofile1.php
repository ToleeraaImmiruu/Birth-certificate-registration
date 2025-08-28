<?php
// Your PHP code here if needed
?>

<div class="edit-profile-container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="edit-profile-card">
                <div class="edit-profile-header">
                    <img src="pp.png" alt="Profile Picture" class="edit-profile-pic" id="editProfilePicture">
                    <div class="edit-profile-icon" id="editChangePhotoBtn">
                        <i class="fas fa-camera"></i>
                    </div>
                    <h3>Edit Profile</h3>
                </div>
                <div class="edit-profile-body">
                    <form id="editProfileForm">
                        <div class="mb-4">
                            <label for="editFullName" class="edit-profile-label">Full Name</label>
                            <div class="edit-profile-input-group">
                                <span class="edit-profile-input-icon"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="editFullName" placeholder="Enter your full name" value="John Doe">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="editEmail" class="edit-profile-label">Email Address</label>
                            <div class="edit-profile-input-group">
                                <span class="edit-profile-input-icon"><i class="fas fa-envelope"></i></span>
                                <input type="email" class="form-control" id="editEmail" placeholder="Enter your email" value="john.doe@example.com">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="editPhone" class="edit-profile-label">Phone Number</label>
                            <div class="edit-profile-input-group">
                                <span class="edit-profile-input-icon"><i class="fas fa-phone"></i></span>
                                <input type="tel" class="form-control" id="editPhone" placeholder="Enter your phone number" value="+1 (555) 123-4567">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="editPassword" class="edit-profile-label">Password</label>
                            <div class="edit-profile-input-group">
                                <span class="edit-profile-input-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="editPassword" placeholder="Enter new password">
                                <button class="btn edit-profile-password-toggle" type="button" id="editTogglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="edit-profile-hint">Leave blank to keep current password</small>
                        </div>

                        <div class="mb-4">
                            <label for="editConfirmPassword" class="edit-profile-label">Confirm Password</label>
                            <div class="edit-profile-input-group">
                                <span class="edit-profile-input-icon"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="editConfirmPassword" placeholder="Confirm new password">
                                <button class="btn edit-profile-password-toggle" type="button" id="editToggleConfirmPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="button" class="btn btn-outline-secondary me-md-2">Cancel</button>
                            <button type="submit" class="btn edit-profile-save-btn text-white">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for changing profile picture -->
<div class="modal fade" id="editProfilePicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Profile Picture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column align-items-center">
                    <div class="mb-3">
                        <img src="https://via.placeholder.com/150" id="editCurrentProfilePic" class="rounded-circle" width="150" height="150">
                    </div>
                    <input type="file" class="form-control" id="editProfilePicUpload" accept="image/*">
                    <small class="text-muted mt-2">Recommended size: 150x150 pixels</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="editSaveProfilePicBtn">Save Changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize modal
        const editProfilePicModal = new bootstrap.Modal(document.getElementById('editProfilePicModal'));

        // Open modal when change photo button is clicked
        document.getElementById('editChangePhotoBtn').addEventListener('click', function() {
            editProfilePicModal.show();
        });

        // Preview image when file is selected
        document.getElementById('editProfilePicUpload').addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    document.getElementById('editCurrentProfilePic').src = event.target.result;
                }

                reader.readAsDataURL(e.target.files[0]);
            }
        });

        // Save profile picture
        document.getElementById('editSaveProfilePicBtn').addEventListener('click', function() {
            const newPicSrc = document.getElementById('editCurrentProfilePic').src;
            document.getElementById('editProfilePicture').src = newPicSrc;
            editProfilePicModal.hide();

            // Here you would typically upload the image to your server
            alert('Profile picture updated successfully!');
        });

        // Toggle password visibility
        document.getElementById('editTogglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('editPassword');
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
        document.getElementById('editToggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('editConfirmPassword');
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
        document.getElementById('editProfileForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Get form values
            const fullName = document.getElementById('editFullName').value;
            const email = document.getElementById('editEmail').value;
            const phone = document.getElementById('editPhone').value;
            const password = document.getElementById('editPassword').value;
            const confirmPassword = document.getElementById('editConfirmPassword').value;

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
    });
</script>