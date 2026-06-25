<?php
session_start();
include '../db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registrations</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>

    *{
        font-family: 'Poppins', sans-serif;
    }

    body{
        margin:0;
        background:#f4f6f9;
    }

    /* Sidebar */
    .sidebar{
        width:240px;
        height:100vh;
        position:fixed;
        background:linear-gradient(180deg,#0f2027,#203a43,#2c5364);
        color:white;
        padding-top:20px;
    }

    .sidebar h4{
        text-align:center;
        margin-bottom:30px;
        font-weight:600;
    }

    .sidebar a{
        display:block;
        color:white;
        padding:12px 20px;
        text-decoration:none;
        transition:0.3s;
    }

    .sidebar a:hover{
        background:rgba(255,255,255,0.1);
        padding-left:25px;
    }

    /* Main */
    .main{
        margin-left:240px;
        padding:25px;
    }

    /* Header card */
    .header-card{
        background: linear-gradient(90deg,#4e54c8,#8f94fb);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:20px;
        box-shadow:0 10px 20px rgba(0,0,0,0.1);
    }

    /* Table card */
    .card-box{
        background:white;
        padding:20px;
        border-radius:15px;
        box-shadow:0 10px 20px rgba(0,0,0,0.08);
    }

    .table thead{
        background:#2c5364;
        color:white;
    }

    .table tbody tr:hover{
        background:#f1f5ff;
        transition:0.2s;
    }

    /* Search box */
    .search-box{
        width:250px;
        float:right;
        margin-bottom:15px;
        border-radius:10px;
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
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main -->
<div class="main">

    <!-- Header -->
    <div class="header-card">
        <h3>📋 Event Registration Management</h3>
        <p class="mb-0">View all registered students for events</p>
    </div>

    <!-- Table -->
    <div class="card-box">

        <h5 class="mb-3">Registered Students</h5>

        <input type="text" id="search" class="form-control search-box" placeholder="Search student or event...">

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

        <thead>
        <tr>
            <th>#</th>
            <th>Event Name</th>
            <th>Student Name</th>
            <th>Email</th>
            <th>Registration Date</th>
        </tr>
        </thead>

        <tbody id="tableData">

        <?php

        $sql = "
        SELECT
            er.registration_id,
            e.event_name,
            s.first_name,
            s.last_name,
            s.email,
            er.registration_date
        FROM event_registration er
        INNER JOIN event e
            ON er.event_id = e.event_id
        INNER JOIN student s
            ON er.student_id = s.student_id
        ORDER BY er.registration_id DESC
        ";

        $res = $conn->query($sql);

        $i = 1;

        while($row = $res->fetch_assoc()){
        ?>

        <tr>
            <td><?= $i++; ?></td>
            <td><?= htmlspecialchars($row['event_name']); ?></td>
            <td><?= htmlspecialchars($row['first_name']." ".$row['last_name']); ?></td>
            <td><?= htmlspecialchars($row['email']); ?></td>
            <td><?= $row['registration_date']; ?></td>
        </tr>

        <?php } ?>

        </tbody>

        </table>

        </div>

    </div>

</div>

<!-- SEARCH SCRIPT -->
<script>
document.getElementById("search").addEventListener("keyup", function() {
    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tableData tr");

    rows.forEach(row => {
        row.style.display =
        row.innerText.toLowerCase().includes(value) ? "" : "none";
    });
});
</script>

</body>
</html>