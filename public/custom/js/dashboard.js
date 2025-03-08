const ctx = document.getElementById('studentsBarChart').getContext('2d');
const studentsBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['👨', '👩', '⚧'],
        datasets: [{
            label: 'Students',
            data: [5, 3, 1], // Data values
            backgroundColor: [
                'rgba(59, 130, 246, 0.8)',  // Soft Royal Blue for Male
                'rgba(244, 114, 182, 0.8)', // Elegant Soft Pink for Female
                'rgba(250, 204, 21, 0.8)'  // Warm Golden Yellow for Other
            ],
            borderColor: [
                'rgba(59, 130, 246, 1)',
                'rgba(244, 114, 182, 1)',
                'rgba(250, 204, 21, 1)'
            ],
            borderWidth: 1,
            borderRadius: 5, // Rounded bars for a modern look
            barThickness: 30 // Adjust bar width for better visibility
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#FFFFFF', // White text for better visibility
                    font: {
                        size: 14
                    }
                },
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)' // Subtle grid lines
                }
            },
            x: {
                ticks: {
                    color: '#FFFFFF', // White text for labels
                    font: {
                        size: 14
                    }
                },
                grid: {
                    display: false // Hide x-axis grid for a cleaner look
                }
            }
        },
        plugins: {
            legend: {
                display: false // Hide legend for a cleaner UI
            },
            tooltip: {
                backgroundColor: 'rgba(0,0,0,0.8)', // Dark tooltip for contrast
                titleColor: 'white',
                bodyColor: 'white',
                borderColor: 'rgba(255,255,255,0.2)',
                borderWidth: 1
            }
        }
    }
});
