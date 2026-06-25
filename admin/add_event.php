<?php
include '../db.php';
session_start();

if(isset($_POST['save'])){

    $event_name = mysqli_real_escape_string($conn,$_POST['event_name']);
    $event_date = $_POST['event_date'];
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $sql = "INSERT INTO event
            (event_name,event_date,location,description)
            VALUES
            ('$event_name','$event_date','$location','$description')";

    if($conn->query($sql)){

        echo "
        <script>
            alert('Event Added Successfully');
            window.location='manage_events.php';
        </script>";
        exit();

    }else{
        die("DB Error : ".$conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fc;
}

.event-card{
    max-width:850px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.header-box{
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

.form-control{
    border-radius:10px;
    padding:12px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#6366f1;
}

.btn-save{
    background:#6366f1;
    border:none;
    padding:10px 25px;
}

.btn-save:hover{
    background:#4f46e5;
}

.info-box{
    background:#eef2ff;
    border-left:5px solid #6366f1;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="event-card">

        <div class="header-box">

            <h2>🎉 Add New Event</h2>

            <p class="mb-0">
                Create and manage wildlife events
            </p>

        </div>

        <div class="info-box">

            <strong>ℹ Event Information</strong><br>
            Fill all required fields to create a new event.

        </div>

        <form method="POST">

            <label class="form-label fw-bold">
                Event Name
            </label>

            <input
                type="text"
                name="event_name"
                class="form-control mb-3"
                placeholder="Enter Event Name"
                required>

            <label class="form-label fw-bold">
                Event Date
            </label>

            <input
                type="date"
                name="event_date"
                class="form-control mb-3"
                required>

            <label class="form-label fw-bold">
                Location
            </label>

            <input
                type="text"
                name="location"
                class="form-control mb-3"
                placeholder="Enter Event Location"
                required>

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                name="description"
                rows="6"
                class="form-control mb-4"
                placeholder="Enter Event Description"
                required></textarea>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    name="save"
                    class="btn btn-save text-white">

                    💾 Save Event

                </button>

                <a href="manage_events.php"
                   class="btn btn-secondary">

                    ↩ Back

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>