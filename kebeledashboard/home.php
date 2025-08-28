<div class="kebele-dashboard-container">
    <!-- Dashboard Header -->
    <div class="kebele-dashboard-header">
        <h1 class="kebele-dashboard-title">Kebele ID Management Dashboard</h1>
        <div class="kebele-date-selector">
            <span class="kebele-date-display">June 2023</span>
            <i class="fas fa-calendar-alt"></i>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="kebele-stats-row">
        <div class="kebele-stat-card">
            <div class="kebele-stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="kebele-stat-content">
                <h3>Total Citizens</h3>
                <p class="kebele-stat-number">4,287</p>
                <div class="kebele-stat-trend up">
                    <i class="fas fa-arrow-up"></i> 12% from last month
                </div>
            </div>
        </div>

        <div class="kebele-stat-card">
            <div class="kebele-stat-icon">
                <i class="fas fa-id-card"></i>
            </div>
            <div class="kebele-stat-content">
                <h3>New Applications</h3>
                <p class="kebele-stat-number">143</p>
                <div class="kebele-stat-trend up">
                    <i class="fas fa-arrow-up"></i> 8% from last month
                </div>
            </div>
        </div>

        <div class="kebele-stat-card">
            <div class="kebele-stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="kebele-stat-content">
                <h3>Approved IDs</h3>
                <p class="kebele-stat-number">87</p>
                <div class="kebele-stat-trend down">
                    <i class="fas fa-arrow-down"></i> 5% from last month
                </div>
            </div>
        </div>

        <div class="kebele-stat-card">
            <div class="kebele-stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="kebele-stat-content">
                <h3>Pending Approval</h3>
                <p class="kebele-stat-number">56</p>
                <div class="kebele-stat-trend up">
                    <i class="fas fa-arrow-up"></i> 15% from last month
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="kebele-charts-row">
        <!-- Applications Chart -->
        <div class="kebele-chart-container">
            <div class="kebele-chart-header">
                <h3>Monthly Applications</h3>
                <div class="kebele-chart-actions">
                    <button class="kebele-chart-action-btn active">Monthly</button>
                    <button class="kebele-chart-action-btn">Quarterly</button>
                    <button class="kebele-chart-action-btn">Yearly</button>
                </div>
            </div>
            <div class="kebele-chart-wrapper">
                <canvas id="applicationsChart"></canvas>
            </div>
        </div>

        <!-- Status Distribution Chart -->
        <div class="kebele-chart-container">
            <div class="kebele-chart-header">
                <h3>Application Status</h3>
                <select class="kebele-chart-select">
                    <option>Last 7 Days</option>
                    <option selected>Last 30 Days</option>
                    <option>Last 90 Days</option>
                </select>
            </div>
            <div class="kebele-chart-wrapper">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Row -->
    <div class="kebele-bottom-row">
        <!-- Recent Activity -->
        <div class="kebele-activity-container">
            <div class="kebele-section-header">
                <h3>Recent Activity</h3>
                <a href="#" class="kebele-view-all">View All</a>
            </div>
            <div class="kebele-activity-list">
                <div class="kebele-activity-item">
                    <div class="kebele-activity-icon approved">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="kebele-activity-content">
                        <p>ID approved for <strong>Alemu Kebede</strong></p>
                        <small>Today, 10:45 AM</small>
                    </div>
                </div>
                <div class="kebele-activity-item">
                    <div class="kebele-activity-icon new">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="kebele-activity-content">
                        <p>New application from <strong>Tigist Worku</strong></p>
                        <small>Today, 09:30 AM</small>
                    </div>
                </div>
                <div class="kebele-activity-item">
                    <div class="kebele-activity-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="kebele-activity-content">
                        <p>Document requested from <strong>Dawit Mekonnen</strong></p>
                        <small>Yesterday, 3:15 PM</small>
                    </div>
                </div>
                <div class="kebele-activity-item">
                    <div class="kebele-activity-icon rejected">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="kebele-activity-content">
                        <p>Application rejected for <strong>Selamawit Abebe</strong></p>
                        <small>Yesterday, 11:20 AM</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="kebele-actions-container">
            <div class="kebele-section-header">
                <h3>Quick Actions</h3>
            </div>
            <div class="kebele-actions-grid">
                <button class="kebele-action-card">
                    <div class="kebele-action-icon primary">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <span>New ID Application</span>
                </button>
                <button class="kebele-action-card">
                    <div class="kebele-action-icon secondary">
                        <i class="fas fa-search"></i>
                    </div>
                    <span>Search Citizen</span>
                </button>
                <button class="kebele-action-card">
                    <div class="kebele-action-icon accent">
                        <i class="fas fa-print"></i>
                    </div>
                    <span>Print ID Card</span>
                </button>
                <button class="kebele-action-card">
                    <div class="kebele-action-icon dark">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <span>Generate Report</span>
                </button>
                <button class="kebele-action-card">
                    <div class="kebele-action-icon success">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <span>View Analytics</span>
                </button>
                <button class="kebele-action-card">
                    <div class="kebele-action-icon warning">
                        <i class="fas fa-cog"></i>
                    </div>
                    <span>Settings</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Applications Chart
        const applicationsCtx = document.getElementById('applicationsChart').getContext('2d');
        const applicationsChart = new Chart(applicationsCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Applications',
                    data: [120, 190, 170, 210, 240, 280],
                    backgroundColor: 'rgba(44, 62, 80, 0.7)',
                    borderColor: 'rgba(44, 62, 80, 1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(44, 62, 80, 0.9)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Approved', 'Pending', 'Rejected', 'Needs Review'],
                datasets: [{
                    data: [45, 30, 15, 10],
                    backgroundColor: [
                        'rgba(13, 146, 79, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(231, 76, 60, 0.8)',
                        'rgba(52, 152, 219, 0.8)'
                    ],
                    borderColor: [
                        'rgba(13, 146, 79, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(231, 76, 60, 1)',
                        'rgba(52, 152, 219, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    tooltip: {
                        backgroundColor: 'rgba(44, 62, 80, 0.9)'
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>