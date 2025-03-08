<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compact Dashboard</title>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .card {
            border: none;
            border-radius: 15px;
            padding: 15px;
            position: relative;
            color: white;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
            height: 165px; /* Reduced height */
        }

        .card.students {
            background: linear-gradient(135deg, #1e90ff, #00bfff);
        }

        .card.teachers {
            background: linear-gradient(135deg, #8e44ad, #9b59b6);
        }

        .card.parents {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
        }

        .card.staff {
            background: linear-gradient(135deg, #e67e22, #f39c12);
        }

        .icon-container {
            width: 40px; /* Reduced size */
            height: 40px; /* Reduced size */
            background-color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px; /* Reduced font size */
            color: black;
            margin-bottom: 10px;
        }

        .title {
            font-size: 14px; /* Reduced font size */
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .stat {
            font-size: 20px; /* Reduced font size */
            font-weight: bold;
            margin-bottom: 5px;
        }

        .progress-bar {
            height: 8px; /* Reduced height */
            border-radius: 4px;
        }

        .chart-container {
            width: 100%;
            height: 100px; /* Reduced chart height */
        }

        .bottom-icons {
            display: flex;
            justify-content: space-between;
        }

        .bottom-icons img {
            width: 30px; /* Reduced size */
            height: 30px; /* Reduced size */
            border-radius: 50%;
            background-color: white;
            padding: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
        }
        .bottom-icons i {
        font-size: 18px; /* Adjust icon size */
        color: inherit; /* Use icon-specific colors */
        background-color: white; /* White background */
        border-radius: 50%; /* Rounded background */
        padding: 4px; /* Space inside the circle */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Optional shadow for better visibility */
        display: inline-block; /* Ensure proper alignment */
    }

    </style>
</head>
<body>
    <div class=" dashboard ">
        <!-- Students Card -->
        <div class="card students">
            <div class="row">
                <div class="col-6">
                    <div class="icon-container">
                        🎓
                    </div>
                    <div class="title">Students</div>
                    <div class="stat">9</div>
                </div>
                <div class="col-6">
                    <div class="chart-container">
                        <canvas id="studentsBarChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="bottom-icons">
                <!-- Active Students Icon -->
                <i class="fas fa-user-graduate" title="Active Students" style="color: green;"></i>

                <!-- Blocked Student Icon -->
                <i class="fas fa-user-slash" title="Blocked Student" style="color: gray;"></i>

                <!-- Deleted Student Icon -->
                <i class="fas fa-user-times" title="Deleted Student" style="color: red; opacity: 0.8;"></i>
            </div>


        </div>


        <!-- Teachers Card -->
        <div class="card teachers">
            <div class="icon-container">
                👩‍🏫
            </div>
            <div class="title">Teachers</div>
            <div class="stat">3</div>
            <div class="bottom-icons">
                <!-- Active Students Icon -->
                <i class="fas fa-user-graduate" title="Active Students" style="color: green;"></i>

                <!-- Blocked Student Icon -->
                <i class="fas fa-user-slash" title="Blocked Student" style="color: gray;"></i>

                <!-- Deleted Student Icon -->
                <i class="fas fa-user-times" title="Deleted Student" style="color: red; opacity: 0.8;"></i>
            </div>
        </div>

        <!-- Parents Card -->
        <div class="card parents">
            <div class="icon-container">
                👨‍👩‍👧
            </div>
            <div class="title">Parents</div>
            <div class="stat">5</div>
            <div class="bottom-icons">
                <!-- Active Students Icon -->
                <i class="fas fa-user-graduate" title="Active Students" style="color: green;"></i>

                <!-- Blocked Student Icon -->
                <i class="fas fa-user-slash" title="Blocked Student" style="color: gray;"></i>

                <!-- Deleted Student Icon -->
                <i class="fas fa-user-times" title="Deleted Student" style="color: red; opacity: 0.8;"></i>
            </div>
        </div>


        <!-- Staff Card -->
        <div class="card staff">
            <div class="icon-container">
                💼
            </div>
            <div class="title">Staff</div>
            <div class="stat">2</div>
            <div class="bottom-icons">
                <!-- Active Students Icon -->
                <i class="fas fa-user-graduate" title="Active Students" style="color: green;"></i>

                <!-- Blocked Student Icon -->
                <i class="fas fa-user-slash" title="Blocked Student" style="color: gray;"></i>

                <!-- Deleted Student Icon -->
                <i class="fas fa-user-times" title="Deleted Student" style="color: red; opacity: 0.8;"></i>
            </div>
        </div>
    </div>

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
                        'rgba(231, 76, 60, 0.8)',   // Soft Red for Female
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
</body>
</html>
