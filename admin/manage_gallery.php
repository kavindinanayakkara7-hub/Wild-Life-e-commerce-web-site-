<?php
include '../db.php';

$count = $conn->query("SELECT COUNT(*) AS total FROM gallery");
$total = $count->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Gallery</title>

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
        background:linear-gradient(135deg,#06b6d4,#3b82f6);
        color:white;
        padding:25px;
        border-radius:15px;
        margin-bottom:20px;
        box-shadow:0 10px 25px rgba(0,0,0,.15);
    }

    /* Cards */
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
        color:#2563eb;
    }

    /* Table */
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
        background:#eff6ff;
    }

    .img-box{
        width:120px;
        height:90px;
        object-fit:cover;
        border-radius:10px;
        transition:.3s;
    }

    .img-box:hover{
        transform:scale(1.1);
    }

    .search-box{
        max-width:300px;
        float:right;
        margin-bottom:15px;
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

    <!-- Header -->
    <div class="header-box">
        <h2>🖼 Gallery Management</h2>
        <p class="mb-0">Manage uploaded gallery images and categories</p>
    </div>

    <!-- Stats -->
    <div class="stat-card">
        <h6>Total Gallery Images</h6>
        <div class="stat-number"><?= $total; ?></div>
    </div>

    <!-- Table -->
    <div class="table-card">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h5>Gallery Images</h5>

            <a href="add_gallery.php" class="btn btn-success">
                ➕ Add New Image
            </a>

        </div>

        <input type="text"
               id="search"
               class="form-control search-box"
               placeholder="Search gallery...">

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Category</th>
                    <th>Upload Date</th>
                    <th width="180">Actions</th>
                </tr>
            </thead>

            <tbody id="tableData">

            <?php

            $sql = "SELECT g.*, c.category_name
                    FROM gallery g
                    LEFT JOIN category c
                    ON g.category_id = c.category_id
                    ORDER BY g.gallery_id DESC";

            $res = $conn->query($sql);

            while($row = $res->fetch_assoc()){
            ?>

            <tr>

                <td><?= $row['gallery_id']; ?></td>

                <td>
                    <img src="../<?= $row['image_path']; ?>"
                         class="img-box">
                </td>

                <td><?= $row['caption']; ?></td>

                <td>
                    <span class="badge bg-primary">
                        <?= $row['category_name']; ?>
                    </span>
                </td>

                <td><?= $row['upload_date']; ?></td>

                <td>

                    <a href="edit_gallery.php?gallery_id=<?= $row['gallery_id']; ?>"
                       class="btn btn-warning btn-sm">
                       ✏ Edit
                    </a>

                    <a href="delete_gallery.php?gallery_id=<?= $row['gallery_id']; ?>"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete this image?')">
                       🗑 Delete
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