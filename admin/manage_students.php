<?php include '../db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Students</title>

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

    /* Header */
    .header-box{
        background: linear-gradient(90deg,#36d1dc,#5b86e5);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:20px;
        box-shadow:0 10px 20px rgba(0,0,0,0.1);
    }

    /* Table box */
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

    /* search */
    .search-box{
        width:250px;
        float:right;
        margin-bottom:15px;
        border-radius:10px;
    }

    /* delete button */
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
    <a href="view_event_registration.php">👥 Event Registrations</a>
    <a href="students.php">👨‍🎓 Students</a>
    <a href="manage_gallery.php">🖼 Gallery</a>
    <a href="messages.php">💬 Messages</a>
    <a href="logout.php">🚪 Logout</a>
</div>

<!-- Main -->
<div class="main">

    <!-- Header -->
    <div class="header-box">
        <h3>👨‍🎓 Students Management</h3>
        <p class="mb-0">Manage all registered students</p>
    </div>

    <!-- Table -->
    <div class="card-box">

        <h5 class="mb-3">Students List</h5>

        <input type="text" id="search" class="form-control search-box" placeholder="Search students...">

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Registered Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody id="tableData">

        <?php
        $res = $conn->query("SELECT * FROM student ORDER BY student_id DESC");

        while($r = $res->fetch_assoc()){
        ?>

        <tr>
            <td><?= $r['student_id']; ?></td>
            <td><?= $r['first_name'] . " " . $r['last_name']; ?></td>
            <td><?= $r['email']; ?></td>
            <td><?= $r['mobile']; ?></td>
            <td><?= $r['registered_date']; ?></td>

            <td>
                <a href="delete_student.php?id=<?= $r['student_id']; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Delete this student?')">
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