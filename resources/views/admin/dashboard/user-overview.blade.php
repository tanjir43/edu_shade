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
            <i class="fas fa-user-graduate" title="Active Students" style="color: green;"></i>
            <i class="fas fa-user-slash" title="Blocked Student" style="color: gray;"></i>
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
            <i class="fas fa-male" title="Gents" style="color: gray;"></i>
            <i class="fas fa-female" title="Ladies" style="color: pink; opacity: 0.8;"></i>
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
            <i class="fas fa-male" title="Gents" style="color: gray;"></i>
            <i class="fas fa-female" title="Ladies" style="color: pink; opacity: 0.8;"></i>
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
            <i class="fas fa-male" title="Gents" style="color: gray;"></i>
            <i class="fas fa-female" title="Ladies" style="color: rgb(224, 152, 164);"></i>
        </div>
    </div>
</div>
<script src="{{ asset('saas/js/chart.js') }}"></script>

<script>
    const ctx = document.getElementById('studentsBarChart').getContext('2d');
    const studentsBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Male', 'Female', 'Other'], // Categories
            datasets: [{
                label: 'Students',
                data: [5, 3, 1], // Data values
                backgroundColor: [
                    'rgba(41, 128, 185, 0.8)',  // Soft Blue for Male
                    'rgba(231, 76, 60, 0.8)',   // Soft pink for Female
                    'rgba(241, 196, 15, 0.8)'  // Soft Yellow for Other
                ],
                borderColor: [
                    'rgba(41, 128, 185, 1)',
                    'rgba(231, 76, 60, 1)',
                    'rgba(241, 196, 15, 1)'
                ],
                borderWidth: 1,
                borderRadius: 4 // Rounded bars
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#ffffff' // White for better visibility
                    },
                    grid: {
                        color: 'rgba(255, 255, 255, 0.1)' // Soft grid lines
                    }
                },
                x: {
                    ticks: {
                        color: '#ffffff' // White for better visibility
                    },
                    grid: {
                        display: false // Hide x-axis grid for a cleaner look
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.7)', // Darker tooltip for better contrast
                    titleColor: 'white',
                    bodyColor: 'white'
                }
            }
        }
    });
</script>
