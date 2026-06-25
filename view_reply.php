<?php
session_start();
include 'db.php';

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$result = $conn->query("
SELECT *
FROM contact_message
WHERE student_id='$student_id'
ORDER BY message_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Messages & Replies</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

:root{
    --olive:#556B2F;
    --olive-light:#6B8E23;
}

body{
    background:#f5f7f2;
    font-family:'Segoe UI',sans-serif;
}

/* HEADER */
.header{
    background:linear-gradient(135deg,var(--olive),#2f3d16);
    color:white;
    padding:25px;
    text-align:center;
    box-shadow:0 4px 15px rgba(0,0,0,.15);
}

.header h2{
    margin:0;
    font-weight:700;
}

/* CARD */
.message-card{
    background:white;
    border:none;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    transition:.3s;
}

.message-card:hover{
    transform:translateY(-4px);
}

.card-top{
    background:linear-gradient(135deg,var(--olive),var(--olive-light));
    color:white;
    padding:15px 20px;
}

.card-top h5{
    margin:0;
}

.info{
    margin-bottom:10px;
}

.info strong{
    color:var(--olive);
}

.reply-box{
    background:#e8f5e9;
    border-left:5px solid #28a745;
    padding:15px;
    border-radius:10px;
}

.pending-box{
    background:#fff3cd;
    border-left:5px solid #ffc107;
    padding:15px;
    border-radius:10px;
    color:#856404;
}

.badge-status{
    font-size:12px;
    padding:8px 12px;
    border-radius:20px;
}

.footer{
    margin-top:50px;
    background:linear-gradient(135deg,var(--olive),#2f3d16);
    color:white;
    text-align:center;
    padding:15px;
}

.empty-box{
    background:white;
    padding:50px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<!-- HEADER -->
<div class="header">
    <h2>📩 My Messages & Admin Replies</h2>
</div>

<div class="container mt-4">

<?php if($result->num_rows > 0){ ?>

<?php while($row = $result->fetch_assoc()){ ?>

<div class="message-card mb-4">

    <div class="card-top d-flex justify-content-between align-items-center">

        <h5>
            👤 <?= htmlspecialchars($row['student_name']); ?>
        </h5>

        <?php if(!empty($row['admin_reply'])){ ?>

            <span class="badge bg-success badge-status">
                Replied
            </span>

        <?php } else { ?>

            <span class="badge bg-warning text-dark badge-status">
                Pending
            </span>

        <?php } ?>

    </div>

    <div class="p-4">

        <div class="info">
            <strong>📧 Email :</strong>
            <?= htmlspecialchars($row['email']); ?>
        </div>

        <div class="info">
            <strong>📌 Subject :</strong>
            <?= htmlspecialchars($row['subject']); ?>
        </div>

        <div class="info">
            <strong>📅 Sent Date :</strong>
            <?= $row['created_at']; ?>
        </div>

        <hr>

        <h6 class="mb-2">💬 Your Message</h6>

        <p>
            <?= nl2br(htmlspecialchars($row['message'])); ?>
        </p>

        <hr>

        <h6 class="mb-2">🧑‍💼 Admin Reply</h6>

        <?php if(!empty($row['admin_reply'])){ ?>

            <div class="reply-box">

                <?= nl2br(htmlspecialchars($row['admin_reply'])); ?>

                <?php if(!empty($row['reply_date'])){ ?>
                    <div class="mt-2 text-muted small">
                        Reply Date : <?= $row['reply_date']; ?>
                    </div>
                <?php } ?>

            </div>

        <?php } else { ?>

            <div class="pending-box">
                ⏳ No reply yet. Please wait for the administrator's response.
            </div>

        <?php } ?>

    </div>

</div>

<?php } ?>

<?php } else { ?>

<div class="empty-box">

    <h3>📭 No Messages Found</h3>

    <p class="text-muted">
        You haven't sent any messages to the administrator yet.
    </p>

    <a href="contact.php" class="btn btn-success">
        Send New Message
    </a>

</div>

<?php } ?>

</div>

<!-- FOOTER -->
<div class="footer">
    © 2026 Wildlife Student System | Messages & Support Center
</div>

</body>
</html>