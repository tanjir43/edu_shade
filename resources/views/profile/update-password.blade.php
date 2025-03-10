<h4 class="mb-3">Update Password</h4>

<form action="{{ route('password.update') }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <label for="currentPassword" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="currentPassword" name="current_password" placeholder="Enter current password" required>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="newPassword" class="form-label">New Password</label>
                <input type="password" class="form-control" id="newPassword" name="password" placeholder="Enter new password" required>
            </div>
        </div>
        <div class="col-4">
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm new password" required>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>
