<div class="mb-4">
    <h4 class="mb-3">Profile Information</h4>

    <form action="{{ route('user-profile-information.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ @$user->name }}" placeholder="Enter your name">
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ @$user->email }}" placeholder="Enter your email" readonly>
                </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="phone" class="form-control" id="phone" name="phone_number" value="{{ @$user->phone_number }}" placeholder="Enter your phone">
                </div>
            </div>

            <div class="col-md-4 text-center">
                <label for="photo" class="form-label fw-bold">Profile Photo</label>

                <div class="profile-image-container">
                    <img id="profilePreview"
                        src="{{ @$user->profile_photo_path ? asset('storage/' . $user->profile_photo_path) : asset('images/min-none-default.png') }}"
                        alt="Profile Photo" onclick="openFullImage()">

                    <label class="upload-button">
                        <i class="fas fa-camera"></i>
                        <input type="file" class="d-none" id="photo" name="photo" accept="image/*" onchange="previewProfileImage(event)">
                    </label>
                </div>

                <p class="small text-muted mt-2">Allowed formats: JPG, PNG (Max: 1MB)</p>
            </div>

            <div id="fullImageModal" class="full-image-modal" onclick="closeFullImage()">
                <span class="close-button">&times;</span>
                <img id="fullImage">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
