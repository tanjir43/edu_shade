<div class="dashboard">
    <!-- Students Card -->
    <div class="dashboard-card students">
        <div class="row">
            <div class="col-6">
                <div class="dashboard-icon-container">
                    🎓
                </div>
                <div class="dashboard-title">Students</div>
                <div class="dashboard-stat">9</div>
            </div>
            <div class="col-6">
                <div class="dashboard-chart-container">
                    <canvas id="studentsBarChart"></canvas>
                </div>
            </div>
        </div>
        <div class="dashboard-bottom-icons">
            <i class="fas fa-user-graduate green" title="Active Students"></i>
            <i class="fas fa-user-slash gray" title="Blocked Student"></i>
        </div>
    </div>

    <!-- Teachers Card -->
    <div class="dashboard-card teachers">
        <div class="dashboard-icon-container">
            👩‍🏫
        </div>
        <div class="dashboard-title">Teachers</div>
        <div class="dashboard-stat">3</div>
        <div class="dashboard-bottom-icons">
            <i class="fas fa-male gray" title="Gents"></i>
            <i class="fas fa-female pink opacity-8" title="Ladies"></i>
        </div>
    </div>

    <!-- Parents Card -->
    <div class="dashboard-card parents">
        <div class="dashboard-icon-container">
            👨‍👩‍👧
        </div>
        <div class="dashboard-title">Parents</div>
        <div class="dashboard-stat">5</div>
        <div class="dashboard-bottom-icons">
            <i class="fas fa-male gray" title="Gents"></i>
            <i class="fas fa-female pink opacity-8" title="Ladies"></i>
        </div>
    </div>

    <!-- Staff Card -->
    <div class="dashboard-card staff">
        <div class="dashboard-icon-container">
            💼
        </div>
        <div class="dashboard-title">Staff</div>
        <div class="dashboard-stat">2</div>
        <div class="dashboard-bottom-icons">
            <i class="fas fa-male gray" title="Gents"></i>
            <i class="fas fa-female pink opacity-8" title="Ladies"></i>
        </div>
    </div>
</div>
<script src="{{ asset('saas/js/chart.js') }}"></script>
<script src="{{asset('custom/js/dashboard.js')}}"></script>
