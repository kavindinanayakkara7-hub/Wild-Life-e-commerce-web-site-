<?php
session_start();
include 'db.php';

// Login student id
$student_id = $_SESSION['student_id'];

$sql = "
SELECT
    e.event_id,
    e.event_name,
    e.description,
    e.event_date,
    er.registration_date
FROM event_registration er
INNER JOIN event e
    ON er.event_id = e.event_id
WHERE er.student_id = '$student_id'
ORDER BY er.registration_date DESC
";

$res = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Registered Events</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    body{
        background:#f5f7f2;
        font-family:Segoe UI;
    }

    .header{
        background:#556B2F;
        color:white;
        padding:40px;
        text-align:center;
    }

    .event-card{
        background:white;
        padding:20px;
        margin-bottom:20px;
        border-radius:12px;
        box-shadow:0 3px 10px rgba(0,0,0,0.1);
        border-left:5px solid #556B2F;
    }

    .event-card h4{
        color:#556B2F;
    }

    </style>

</head>
<body>

<div class="header">
    <h1>📅 My Registered Events</h1>
</div>

<div class="container mt-4">

<?php

if($res->num_rows > 0){

    while($row = $res->fetch_assoc()){
?>

    <div class="event-card">

        <h4>
            <?= htmlspecialchars($row['event_name']); ?>
        </h4>

        <hr>

        <p>
            <?= nl2br(htmlspecialchars($row['description'])); ?>
        </p>

        <p>
            <strong>Event Date :</strong>
            <?= $row['event_date']; ?>
        </p>

        <p>
            <strong>Registered On :</strong>
            <?= $row['registration_date']; ?>
        </p>

    </div>

<?php
    }

}else{
?>

<div class="alert alert-warning text-center">
    No registered events found.
</div>

<?php
}
?>

</div>

</body>
</html>