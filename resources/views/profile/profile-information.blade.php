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
            <div class="col-4">
                <div class="mb-3">
                    <label for="photo" class="form-label">Profile Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
