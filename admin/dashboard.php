<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            margin: 0;
            background: #f4f6f9;
        }

        /* Sidebar */
        .sidebar{
            width: 240px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #0f2027, #203a43, #2c5364);
            color: white;
            padding-top: 20px;
        }

        .sidebar h4{
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .sidebar a{
            display: block;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover{
            background: rgba(255,255,255,0.1);
            padding-left: 25px;
        }

        /* Main */
        .main{
            margin-left: 240px;
            padding: 25px;
        }

        /* Cards */
        .card-box{
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card-box:hover{
            transform: translateY(-5px);
        }

        .stat{
            font-size: 22px;
            font-weight: bold;
        }

        .title{
            font-weight: 600;
        }

        /* Chart box */
        .chart-box{
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4>ADMIN PANEL</h4>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="manage_events.php">🎉 Events</a>
    <a href="view_event_registration.php">👥 Event Registrations</a>
    <a href="manage_gallery.php">🖼 Gallery</a>
    <a href="manage_announcements.php">📢 Announcements</a>
    <a href="messages.php">💬 Messages</a>
    <a href="manage_students.php">👨‍🎓 Manage Students</a>
    <a href="manage_category.php">➕ Add Category</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main -->
<div class="main">

    <h3 class="mb-4">Welcome Admin 👋</h3>

    <!-- STATS CARDS -->
    <div class="row mb-4">

        <div class="col-md-3 mb-3">
            <div class="card-box text-center">
                <h6>Total Students</h6>
                <div class="stat text-primary">120</div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-box text-center">
                <h6>Events</h6>
                <div class="stat text-success">8</div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-box text-center">
                <h6>Gallery Images</h6>
                <div class="stat text-warning">45</div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card-box text-center">
                <h6>Messages</h6>
                <div class="stat text-danger">12</div>
            </div>
        </div>

    </div>

    <!-- CHARTS -->
    <div class="row">

        <!-- Bar Chart -->
        <div class="col-md-6 mb-3">
            <div class="chart-box">
                <h6>System Overview</h6>
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-md-6 mb-3">
            <div class="chart-box">
                <h6>Activity Distribution</h6>
                <canvas id="pieChart"></canvas>
            </div>
        </div>

    </div>

</div>

<script>
/* BAR CHART */
new Chart(document.getElementById("barChart"), {
    type: 'bar',
    data: {
        labels: ["Students", "Events", "Gallery", "Messages"],
        datasets: [{
            label: "Count",
            data: [120, 8, 45, 12],
            backgroundColor: [
                "#4e73df",
                "#1cc88a",
                "#f6c23e",
                "#e74a3b"
            ]
        }]
    }
});

/* PIE CHART */
new Chart(document.getElementById("pieChart"), {
    type: 'pie',
    data: {
        labels: ["Students", "Events", "Gallery", "Messages"],
        datasets: [{
            data: [120, 8, 45, 12],
            backgroundColor: [
                "#4e73df",
                "#1cc88a",
                "#f6c23e",
                "#e74a3b"
            ]
        }]
    }
});
</script>

</body>
</html>