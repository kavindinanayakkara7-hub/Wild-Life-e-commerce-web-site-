<?php
include '../db.php';

$id = $_GET['announcement_id'];

$res = $conn->query("SELECT * FROM announcement WHERE announcement_id='$id'");
$row = $res->fetch_assoc();

if(isset($_POST['update'])){

    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);

    $conn->query("
        UPDATE announcement SET
        title='$title',
        description='$description'
        WHERE announcement_id='$id'
    ");

    echo "
    <script>
        alert('Announcement Updated Successfully');
        window.location='manage_announcements.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Announcement</title>

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
    max-width:850px;
    margin:auto;
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.header-box{
    background:linear-gradient(135deg,#f59e0b,#ef4444);
    color:white;
    padding:20px;
    border-radius:15px;
    margin-bottom:25px;
    text-align:center;
}

.form-control{
    border-radius:12px;
    padding:12px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#ef4444;
}

.btn-update{
    background:#ef4444;
    border:none;
    border-radius:10px;
    padding:10px 20px;
}

.btn-update:hover{
    background:#dc2626;
}

.preview-box{
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

    <div class="edit-card">

        <div class="header-box">

            <h2>📢 Edit Announcement</h2>

            <p class="mb-0">
                Update announcement information
            </p>

        </div>

        <div class="preview-box">

            <strong>Current Announcement:</strong><br>

            <?= htmlspecialchars($row['title']); ?>

        </div>

        <form method="POST">

            <label class="form-label fw-bold">
                Announcement Title
            </label>

            <input
                type="text"
                name="title"
                class="form-control mb-3"
                value="<?= htmlspecialchars($row['title']); ?>"
                required>

            <label class="form-label fw-bold">
                Description
            </label>

            <textarea
                name="description"
                rows="8"
                class="form-control mb-4"
                required><?= htmlspecialchars($row['description']); ?></textarea>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    name="update"
                    class="btn btn-update text-white">

                    💾 Update Announcement

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