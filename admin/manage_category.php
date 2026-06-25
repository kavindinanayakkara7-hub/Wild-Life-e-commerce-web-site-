<?php
include '../db.php';

$count = $conn->query("SELECT COUNT(*) AS total FROM category");
$total = $count->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Categories</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    margin:0;
    background:#f4f7fc;
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
    background:linear-gradient(135deg,#10b981,#059669);
    color:white;
    padding:25px;
    border-radius:15px;
    margin-bottom:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

/* Stats */
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
    color:#059669;
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
    background:#ecfdf5;
}

.search-box{
    max-width:300px;
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
    <a href="messages.php">💬 Messages</a>
    <a href="logout.php">🚪 Logout</a>

</div>

<!-- Main -->
<div class="main">

    <!-- Header -->
    <div class="header-box">
        <h2>📂 Category Management</h2>
        <p class="mb-0">Manage gallery and event categories</p>
    </div>

    <!-- Stats -->
    <div class="stat-card">
        <h6>Total Categories</h6>
        <div class="stat-number"><?= $total; ?></div>
    </div>

    <!-- Table -->
    <div class="table-card">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <a href="add_category.php" class="btn btn-success">
                ➕ Add Category
            </a>

            <input type="text"
                   id="search"
                   class="form-control search-box"
                   placeholder="Search category...">

        </div>

        <div class="table-responsive">

        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>Category Name</th>
                </tr>
            </thead>

            <tbody id="tableData">

            <?php

            $res = $conn->query("SELECT * FROM category ORDER BY category_id DESC");

            while($row = $res->fetch_assoc()){

            ?>

            <tr>
                <td><?= $row['category_id']; ?></td>

                <td>
                    <span class="badge bg-success">
                        <?= $row['category_name']; ?>
                    </span>
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