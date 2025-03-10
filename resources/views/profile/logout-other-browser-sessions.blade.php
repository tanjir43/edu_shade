<h4 class="mb-3">Browser Sessions</h4>

<p>If necessary, you may log out of your browser sessions on other devices. Some of your recent sessions are listed below; however, this list may not be exhaustive.</p>

<form method="POST" action="{{ route('logout.other.sessions') }}">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <input type="password" name="password" class="form-control mb-2" placeholder="Enter Password" required>
            <button type="submit" class="btn btn-danger">Log Out Other Sessions</button>
        </div>
    </div>
</form>
