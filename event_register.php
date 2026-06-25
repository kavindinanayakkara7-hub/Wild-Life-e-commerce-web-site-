<?php
include 'db.php';
session_start();

// check login
if(!isset($_SESSION['student_id'])){
    echo "<script>alert('Please login first'); window.location='login.php';</script>";
    exit();
}

$student_id = $_SESSION['student_id'];
$event_id = $_GET['event_id'];

// check already registered
$check = $conn->query("
    SELECT * FROM event_registration 
    WHERE student_id='$student_id' AND event_id='$event_id'
");

if($check->num_rows > 0){
    echo "<script>
        alert('You already registered for this event');
        window.location='events.php';
    </script>";
    exit();
}

// insert registration
$conn->query("
    INSERT INTO event_registration(student_id,event_id,registration_date)
    VALUES('$student_id','$event_id',NOW())
");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f6f7f2;
            font-family: Arial;
        }

        .header{
            background:#556b2f;
            color:white;
            padding:15px;
            text-align:center;
            font-size:22px;
            font-weight:bold;
        }

        .box{
            max-width:500px;
            margin:80px auto;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 8px 20px rgba(0,0,0,0.1);
            text-align:center;
        }

        .btn-home{
            background:#556b2f;
            color:white;
            border:none;
            width:100%;
        }

        .btn-home:hover{
            background:#6b8e23;
        }

        .success{
            color:#556b2f;
            font-weight:bold;
            font-size:18px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    Event Registration
</div>

<div class="box">

    <p class="success">🎉 You have successfully registered for the event!</p>

    <p>Thank you for joining. We will notify you with updates.</p>

    <a href="events.php" class="btn btn-primary btn-home mt-3">
        Back to Events
    </a>

</div>

</body>
</html>