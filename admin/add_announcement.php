<?php
include '../db.php';
session_start();

if(isset($_POST['save'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $sql = "INSERT INTO announcement(title, description, publish_date)
            VALUES('$title', '$description', NOW())";

    if($conn->query($sql)){
        echo "
        <script>
            alert('Announcement Added Successfully');
            window.location='manage_announcements.php';
        </script>";
        exit();
    } else {
        die("DB Error: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Announcement</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fc;
}

/* Card */
.announcement-card{
    max-width:750px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* Header */
.header-box{
    background:linear-gradient(135deg,#f59e0b,#ef4444);
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

/* Inputs */
.form-control{
    border-radius:10px;
    padding:12px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#ef4444;
}

/* Button */
.btn-save{
    background:#ef4444;
    border:none;
    padding:10px 25px;
    border-radius:10px;
}

.btn-save:hover{
    background:#dc2626;
}

/* Info box */
.info-box{
    background:#fff7ed;
    border-left:5px solid #f59e0b;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="announcement-card">

        <!-- Header -->
        <div class="header-box">

            <h2>📢 Add Announcement</h2>
            <p class="mb-0">Publish new system announcement</p>

        </div>

        <!-- Info -->
        <div class="info-box">

            <strong>ℹ Note:</strong><br>
            Announcements will be visible to all users immediately after publishing.

        </div>

        <!-- Form -->
        <form method="post">

            <label class="form-label fw-bold">
                Title
            </label>

            <input type="text"
                   name="title"
                   class="form-control mb-3"
                   placeholder="Enter announcement title"
                   required>

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea name="description"
                      class="form-control mb-4"
                      rows="6"
                      placeholder="Enter announcement details..."
                      required></textarea>

            <div class="d-flex gap-2">

                <button class="btn btn-save text-white"
                        name="save">

                    📢 Publish

                </button>

                <a href="manage_announcements.php"
                   class="btn btn-secondary">

                    ↩ Back

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>