<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Registrations</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

    *{
        font-family:'Poppins',sans-serif;
    }

    body{
        background:#f4f7fc;
        margin:0;
    }

    /* Sidebar */
    .sidebar{
        width:240px;
        height:100vh;
        position:fixed;
        background:linear-gradient(180deg,#0f172a,#1e293b);
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
        text-decoration:none;
        padding:12px 20px;
        transition:.3s;
    }

    .sidebar a:hover{
        background:rgba(255,255,255,.1);
        padding-left:28px;
    }

    /* Main */
    .main{
        margin-left:240px;
        padding:25px;
    }

    /* Header */
    .header-box{
        background:linear-gradient(135deg,#4f46e5,#7c3aed);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:20px;
        box-shadow:0 10px 25px rgba(0,0,0,.15);
    }

    /* Stats */
    .stat-card{
        background:white;
        border-radius:15px;
        padding:20px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
        margin-bottom:20px;
    }

    .stat-number{
        font-size:30px;
        font-weight:700;
        color:#4f46e5;
    }

    /* Table Card */
    .table-card{
        background:white;
        padding:20px;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
    }

    .table thead{
        background:#1e293b;
        color:white;
    }

    .table tbody tr:hover{
        background:#eef2ff;
    }

    .search-box{
        max-width:300px;
        float:right;
        margin-bottom:15px;
    }

    .btn-danger{
        border-radius:8px;
    }

    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">

    <h4>ADMIN PANEL</h4>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="manage_events.php">🎉 Events</a>
    <a href="manage_registration.php">📋 Registrations</a>
    <a href="manage_gallery.php">🖼 Gallery</a>
    <a href="messages.php">💬 Messages</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

<?php
$count = $conn->query("SELECT COUNT(*) AS total FROM event_registration");
$total = $count->fetch_assoc()['total'];
?>

    <!-- Header -->
    <div class="header-box">
        <h2>📋 Event Registrations</h2>
        <p class="mb-0">Manage all student event registrations</p>
    </div>

    <!-- Stat Card -->
    <div class="stat-card">
        <h6>Total Registrations</h6>
        <div class="stat-number"><?= $total; ?></div>
    </div>

    <!-- Table -->
    <div class="table-card">

        <h5 class="mb-3">Registration List</h5>

        <input type="text"
               id="search"
               class="form-control search-box"
               placeholder="Search registrations...">

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Email</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Location</th>
                    <th width="100">Action</th>
                </tr>
            </thead>

            <tbody id="tableData">

            <?php

            $sql = "
            SELECT
                er.registration_id,
                s.first_name,
                s.last_name,
                s.email,
                e.event_name,
                e.event_date,
                e.location
            FROM event_registration er
            JOIN student s ON er.student_id = s.student_id
            JOIN event e ON er.event_id = e.event_id
            ORDER BY er.registration_id DESC
            ";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()){
            ?>

            <tr>

                <td><?= $row['registration_id']; ?></td>

                <td>
                    <?= $row['first_name']." ".$row['last_name']; ?>
                </td>

                <td><?= $row['email']; ?></td>

                <td>
                    <span class="badge bg-primary">
                        <?= $row['event_name']; ?>
                    </span>
                </td>

                <td><?= $row['event_date']; ?></td>

                <td><?= $row['location']; ?></td>

                <td>

                    <a href="delete_register.php?id=<?= $row['registration_id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this registration?')">
                        Delete
                    </a>

                </td>

            </tr>

            <?php } ?>

            </tbody>

        </table>

        </div>

    </div>

</div>

<script>

document.getElementById("search").addEventListener("keyup", function(){

    let value = this.value.toLowerCase();

    let rows = document.querySelectorAll("#tableData tr");

    rows.forEach(row => {

        row.style.display =
            row.innerText.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

</body>
</html>