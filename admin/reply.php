<?php
include '../db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM contact_message WHERE message_id='$id'");
$row = $result->fetch_assoc();

if(isset($_POST['send_reply'])){

    $reply = $_POST['reply'];

    $conn->query("
    UPDATE contact_message
    SET admin_reply='$reply',
        reply_date=NOW()
    WHERE message_id='$id'
    ");

    echo "
    <script>
    alert('Reply Saved Successfully');
    window.location='messages.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Reply Message</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
    font-family: 'Poppins', sans-serif;
}

body{
    background:#f4f6f9;
}

/* Layout card */
.main-card{
    background:white;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,0.08);
    overflow:hidden;
}

/* Left info panel */
.info-box{
    background:linear-gradient(180deg,#667eea,#764ba2);
    color:white;
    padding:25px;
    height:100%;
}

/* Right reply panel */
.reply-box{
    padding:25px;
}

.label-title{
    font-weight:600;
    color:#555;
    margin-bottom:5px;
}

.value{
    margin-bottom:15px;
    color:#222;
}

/* textarea */
textarea{
    border-radius:10px !important;
    border:1px solid #ddd !important;
    padding:10px;
}

/* buttons */
.btn-custom{
    border-radius:10px;
    padding:10px 20px;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="main-card">

<div class="row g-0">

    <!-- LEFT SIDE -->
    <div class="col-md-4 info-box">

        <h4>📩 Message Info</h4>
        <hr style="opacity:0.3;">

        <p><b>Name:</b><br> <?= $row['student_name']; ?></p>
        <p><b>Email:</b><br> <?= $row['email']; ?></p>
        <p><b>Subject:</b><br> <?= $row['subject']; ?></p>

        <p><b>Status:</b><br>
        <?php if(!empty($row['admin_reply'])){ ?>
            <span class="badge bg-success">Replied</span>
        <?php } else { ?>
            <span class="badge bg-warning text-dark">Pending</span>
        <?php } ?>
        </p>

    </div>

    <!-- RIGHT SIDE -->
    <div class="col-md-8 reply-box">

        <h4 class="mb-3">✍ Reply Message</h4>

        <form method="POST">

            <label class="label-title">Student Message</label>
            <div class="value border p-3 rounded bg-light mb-3">
                <?= $row['message']; ?>
            </div>

            <label class="label-title">Your Reply</label>

            <textarea name="reply"
                      class="form-control mb-3"
                      rows="6"
                      placeholder="Write your reply here..."
                      required><?= $row['admin_reply']; ?></textarea>

            <button type="submit"
                    name="send_reply"
                    class="btn btn-success btn-custom">
                💾 Save Reply
            </button>

            <a href="messages.php"
               class="btn btn-secondary btn-custom">
               🔙 Back
            </a>

        </form>

    </div>

</div>

</div>

</div>

</body>
</html>