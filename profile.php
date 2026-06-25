<?php
session_start();
include 'db.php';

// 🔒 protect page
if(!isset($_SESSION['student_id'])){
    header("Location: index.php");
    exit();
}

// get student data
$id = $_SESSION['student_id'];
$result = $conn->query("SELECT * FROM student WHERE student_id='$id'");
$student = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            font-family: Arial;
            background: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80') no-repeat center center/cover;
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        /* DARK OVERLAY */
        .overlay{
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.5);
        }

        .card{
            width:420px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.3);
            border:none;
            position:relative;
            z-index:2;
        }

        .title{
            text-align:center;
            font-weight:bold;
            color:#556b2f;
        }

        .info-box{
            background:#f6f7f2;
            padding:8px;
            border-radius:8px;
            margin-bottom:8px;
        }

        .label{
            font-weight:bold;
            color:#556b2f;
        }

        .btn-logout{
            width:100%;
            background:#556b2f;
            border:none;
            color:white;
        }

        .btn-logout:hover{
            background:#6b8e23;
        }

    </style>
</head>

<body>

<!-- OVERLAY -->
<div class="overlay"></div>

<!-- PROFILE CARD -->
<div class="card p-4 bg-white">

    <h3 class="title mb-3">🐘 Student Wildlife Profile</h3>

    <div class="info-box">
        <span class="label">First Name:</span>
        <?= $student['first_name']; ?>
    </div>

    <div class="info-box">
        <span class="label">Last Name:</span>
        <?= $student['last_name']; ?>
    </div>

    <div class="info-box">
        <span class="label">Email:</span>
        <?= $student['email']; ?>
    </div>

    <div class="info-box">
        <span class="label">Mobile:</span>
        <?= $student['mobile']; ?>
    </div>

    <hr>

    <a href="logout.php" class="btn btn-logout">
        Logout
    </a>

</div>

</body>
</html>