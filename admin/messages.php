<?php
include '../db.php';

$result = $conn->query("SELECT * FROM contact_message ORDER BY message_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Messages</title>

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
        background: linear-gradient(90deg,#667eea,#764ba2);
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

    /* badges */
    .badge{
        padding:6px 10px;
        border-radius:8px;
    }

    /* search */
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
    <div class="header-box">
        <h3>💬 Contact Messages Inbox</h3>
        <p class="mb-0">Manage student inquiries and replies</p>
    </div>

    <!-- Table -->
    <div class="card-box">

        <h5 class="mb-3">Messages List</h5>

        <input type="text" id="search" class="form-control search-box" placeholder="Search messages...">

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody id="tableData">

        <?php while($row = $result->fetch_assoc()){ ?>

        <tr>
            <td><?= $row['message_id']; ?></td>
            <td><?= $row['student_name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['subject']; ?></td>
            <td><?= $row['message']; ?></td>
            <td><?= $row['created_at']; ?></td>

            <td>
            <?php
            if(!empty($row['admin_reply'])){
                echo "<span class='badge bg-success'>Replied</span>";
            }else{
                echo "<span class='badge bg-danger'>Pending</span>";
            }
            ?>
            </td>

            <td>
                <a href="reply.php?id=<?= $row['message_id']; ?>"
                   class="btn btn-primary btn-sm">
                   Reply
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