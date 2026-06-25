<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Announcements</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

:root{
    --olive:#556B2F;
    --olive-light:#6B8E23;
    --bg:#f8f9f5;
    --white:#ffffff;
}

body{
    background: var(--bg);
    font-family: 'Segoe UI', sans-serif;
}

/* Header */

.header{
    background: linear-gradient(135deg,var(--olive),var(--olive-light));
    color:white;
    padding:60px 20px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

.header h1{
    font-weight:700;
    margin-bottom:10px;
}

.header p{
    opacity:0.9;
    font-size:18px;
}

/* Title */

.section-title{
    text-align:center;
    margin:50px 0 30px;
    color:var(--olive);
    font-weight:bold;
}

/* Cards */

.announcement-card{
    background:white;
    border-radius:15px;
    padding:25px;
    margin-bottom:25px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    transition:0.3s;
    border-left:6px solid var(--olive);
}

.announcement-card:hover{
    transform:translateY(-6px);
}

.announcement-card h4{
    color:var(--olive);
    font-weight:700;
}

.date{
    color:#888;
    font-size:13px;
    margin-top:15px;
}

/* Footer */

.footer{
    background:var(--olive);
    color:white;
    text-align:center;
    padding:20px;
    margin-top:60px;
}

.footer p{
    margin:0;
}

</style>
</head>

<body>

<!-- Header -->

<div class="header">
    <h1>Student Event Management System</h1>
    <p>Latest Announcements & Important Updates</p>
</div>

<!-- Main Content -->

<div class="container">

    <h2 class="section-title">
        📢 Announcements
    </h2>

    <?php

    $res = $conn->query("
    SELECT *
    FROM announcement
    ORDER BY announcement_id DESC
    ");

    while($r = $res->fetch_assoc()){
    ?>

    <div class="announcement-card">

        <h4>
            <?= htmlspecialchars($r['title']); ?>
        </h4>

        <hr>

        <p>
            <?= nl2br(htmlspecialchars($r['description'])); ?>
        </p>

        <?php if(isset($r['created_at'])){ ?>

        <div class="date">
            Posted on :
            <?= $r['created_at']; ?>
        </div>

        <?php } ?>

    </div>

    <?php } ?>

</div>

<!-- Footer -->

<div class="footer">
    <p>
        © <?php echo date("Y"); ?>
        Student Event Management System | All Rights Reserved
    </p>
</div>

</body>
</html>