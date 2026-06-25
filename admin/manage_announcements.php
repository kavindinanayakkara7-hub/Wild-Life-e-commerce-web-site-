<?php
include '../db.php';

$count = $conn->query("SELECT COUNT(*) AS total FROM announcement");
$total = $count->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Announcements</title>

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
        background:linear-gradient(135deg,#f59e0b,#ef4444);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:20px;
        box-shadow:0 10px 25px rgba(0,0,0,.15);
    }

    /* Stat Card */
    .stat-card{
        background:white;
        padding:20px;
        border-radius:15px;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
        margin-bottom:20px;
    }

    .stat-number{
        font-size:30px;
        font-weight:700;
        color:#ef4444;
    }

    /* Search */
    .search-box{
        max-width:300px;
    }

    /* Announcement Card */
    .announcement-card{
        background:white;
        border-radius:15px;
        padding:20px;
        height:100%;
        box-shadow:0 5px 15px rgba(0,0,0,.08);
        transition:.3s;
        border-top:5px solid #ef4444;
    }

    .announcement-card:hover{
        transform:translateY(-8px);
        box-shadow:0 10px 25px rgba(0,0,0,.15);
    }

    .announcement-title{
        font-weight:600;
        color:#1e293b;
    }

    .announcement-desc{
        color:#64748b;
        min-height:90px;
    }

    </style>

</head>
<body>

<!-- Sidebar -->
<div class="sidebar">

    <h4>ADMIN PANEL</h4>

    <a href="dashboard.php">📊 Dashboard</a>
    <a href="manage_events.php">🎉 Events</a>
    <a href="manage_category.php">📂 Categories</a>
    <a href="manage_gallery.php">🖼 Gallery</a>
    <a href="manage_announcements.php">📢 Announcements</a>
    <a href="messages.php">💬 Messages</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<div class="main">

    <!-- Header -->
    <div class="header-box">
        <h2>📢 Announcement Management</h2>
        <p class="mb-0">Manage system announcements and notices</p>
    </div>

    <!-- Stat -->
    <div class="stat-card">
        <h6>Total Announcements</h6>
        <div class="stat-number"><?= $total; ?></div>
    </div>

    <!-- Top Controls -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href="add_announcement.php" class="btn btn-primary">
            ➕ Add New Announcement
        </a>

        <input type="text"
               id="search"
               class="form-control search-box"
               placeholder="Search announcements...">

    </div>

    <!-- Cards -->
    <div class="row" id="announcementContainer">

    <?php
    $res = $conn->query("SELECT * FROM announcement ORDER BY announcement_id DESC");

    while($r = $res->fetch_assoc()){
    ?>

        <div class="col-md-6 mb-4 announcement-item">

            <div class="announcement-card">

                <h5 class="announcement-title">
                    <?= $r['title']; ?>
                </h5>

                <hr>

                <p class="announcement-desc">
                    <?= $r['description']; ?>
                </p>

                <div class="mt-3">

                    <a href="edit_announcement.php?announcement_id=<?= $r['announcement_id']; ?>"
                       class="btn btn-warning btn-sm">
                        ✏ Edit
                    </a>

                    <a href="delete_announcement.php?announcement_id=<?= $r['announcement_id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this announcement?')">
                        🗑 Delete
                    </a>

                </div>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<script>

document.getElementById("search").addEventListener("keyup", function(){

    let value = this.value.toLowerCase();

    let cards = document.querySelectorAll(".announcement-item");

    cards.forEach(card => {

        card.style.display =
            card.innerText.toLowerCase().includes(value)
            ? ""
            : "none";

    });

});

</script>

</body>
</html>