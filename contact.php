<?php
session_start();
include 'db.php';

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

/* Get student data */
$user = $conn->query("
SELECT first_name, last_name, email
FROM student
WHERE student_id='$student_id'
");

$student = $user->fetch_assoc();

$fullName = $student['first_name']." ".$student['last_name'];
$email = $student['email'];

/* SEND MESSAGE */
if(isset($_POST['send'])){

    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $conn->query("
    INSERT INTO contact_message
    (student_id, student_name, email, subject, message, created_at)
    VALUES
    ('$student_id', '$fullName', '$email', '$subject', '$message', NOW())
    ");

    echo "<script>alert('Message Sent Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Contact Us</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f6f7f2;
    font-family:Arial;
}

.header{
    background:#556b2f;
    color:white;
    padding:15px;
    text-align:center;
    font-size:22px;
    font-weight:bold;
}

.card{
    width:480px;
    margin:40px auto;
    border:none;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.15);
}

.title{
    text-align:center;
    font-weight:bold;
    color:#556b2f;
}

.btn-custom{
    width:100%;
    background:#556b2f;
    border:none;
}

.btn-custom:hover{
    background:#6b8e23;
}

.reply-btn{
    width:100%;
    margin-top:10px;
    border:2px solid #556b2f;
    color:#556b2f;
    font-weight:bold;
}

.reply-btn:hover{
    background:#556b2f;
    color:white;
}

</style>
</head>

<body>

<div class="header">
    Contact Support System
</div>

<div class="card p-4">

<h3 class="title">Contact Us</h3>

<form method="post">

<!-- NAME (READONLY) -->
<input class="form-control mb-2"
value="<?= $fullName; ?>"
readonly>

<!-- EMAIL (AUTO FILL) -->
<input class="form-control mb-2"
value="<?= $email; ?>"
readonly>

<!-- SUBJECT -->
<input class="form-control mb-2"
name="subject"
placeholder="Subject"
required>

<!-- MESSAGE -->
<textarea class="form-control mb-3"
name="message"
placeholder="Message"
rows="4"
required></textarea>

<button class="btn btn-primary btn-custom" name="send">
Send Message
</button>

</form>

<a href="view_reply.php" class="btn reply-btn">
View Reply
</a>

</div>

</body>
</html>