<?php
include '../db.php';

$id = $_GET['event_id'];

$res = $conn->query("SELECT * FROM event WHERE event_id='$id'");
$row = $res->fetch_assoc();

if(isset($_POST['update'])){

    $event_name = mysqli_real_escape_string($conn,$_POST['event_name']);
    $event_date = $_POST['event_date'];
    $location = mysqli_real_escape_string($conn,$_POST['location']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $conn->query("
        UPDATE event SET
        event_name='$event_name',
        event_date='$event_date',
        location='$location',
        description='$description'
        WHERE event_id='$id'
    ");

    echo "
    <script>
        alert('Event Updated Successfully');
        window.location='manage_events.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Event</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fc;
}

.edit-card{
    max-width:800px;
    margin:auto;
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.header-box{
    background:linear-gradient(135deg,#8b5cf6,#6366f1);
    color:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:25px;
    text-align:center;
}

.form-control{
    border-radius:10px;
    padding:12px;
}

.btn-update{
    background:#6366f1;
    border:none;
}

.btn-update:hover{
    background:#4f46e5;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="edit-card">

        <div class="header-box">
            <h2>🎉 Edit Event</h2>
            <p class="mb-0">Update event details</p>
        </div>

        <form method="POST">

            <label class="form-label fw-bold">
                Event Name
            </label>

            <input
                type="text"
                class="form-control mb-3"
                name="event_name"
                value="<?= htmlspecialchars($row['event_name']); ?>"
                required>

            <label class="form-label fw-bold">
                Event Date
            </label>

            <input
                type="date"
                class="form-control mb-3"
                name="event_date"
                value="<?= $row['event_date']; ?>"
                required>

            <label class="form-label fw-bold">
                Location
            </label>

            <input
                type="text"
                class="form-control mb-3"
                name="location"
                value="<?= htmlspecialchars($row['location']); ?>"
                required>

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                class="form-control mb-4"
                rows="6"
                name="description"
                required><?= htmlspecialchars($row['description']); ?></textarea>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    name="update"
                    class="btn btn-update text-white">

                    💾 Update Event

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