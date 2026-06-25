<?php
include '../db.php';

$id = $_GET['gallery_id'];

$res = $conn->query("SELECT * FROM gallery WHERE gallery_id='$id'");
$row = $res->fetch_assoc();

if(isset($_POST['update'])){

    $caption = mysqli_real_escape_string($conn,$_POST['caption']);

    if(!empty($_FILES['image']['name'])){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $newPath = "images/" . time() . "_" . $image;

        move_uploaded_file($tmp, "../".$newPath);

        if(file_exists("../".$row['image_path'])){
            unlink("../".$row['image_path']);
        }

        $conn->query("
            UPDATE gallery
            SET image_path='$newPath',
                caption='$caption'
            WHERE gallery_id='$id'
        ");

    } else {

        $conn->query("
            UPDATE gallery
            SET caption='$caption'
            WHERE gallery_id='$id'
        ");
    }

    echo "
    <script>
        alert('Gallery Updated Successfully');
        window.location='manage_gallery.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Gallery</title>

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
    max-width:700px;
    margin:auto;
    background:white;
    border-radius:20px;
    padding:30px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.page-title{
    text-align:center;
    margin-bottom:25px;
    font-weight:600;
    color:#1e293b;
}

.image-preview{
    width:100%;
    max-height:350px;
    object-fit:cover;
    border-radius:15px;
    border:3px solid #e5e7eb;
}

.custom-file{
    border:2px dashed #3b82f6;
    padding:25px;
    border-radius:15px;
    background:#eff6ff;
}

.btn-update{
    background:#3b82f6;
    border:none;
}

.btn-update:hover{
    background:#2563eb;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="edit-card">

        <h2 class="page-title">
            🖼️ Edit Gallery Image
        </h2>

        <div class="text-center mb-4">

            <img src="../<?= $row['image_path']; ?>"
                 class="image-preview">

        </div>

        <form method="POST" enctype="multipart/form-data">

            <label class="form-label fw-bold">
                Upload New Image
            </label>

            <div class="custom-file mb-3">

                <input type="file"
                       name="image"
                       class="form-control">

                <small class="text-muted">
                    Leave empty if you don't want to change the image.
                </small>

            </div>

            <label class="form-label fw-bold">
                Caption
            </label>

            <textarea
                name="caption"
                class="form-control mb-4"
                rows="5"
                required><?= htmlspecialchars($row['caption']); ?></textarea>

            <div class="d-flex gap-2">

                <button
                    type="submit"
                    name="update"
                    class="btn btn-update text-white">

                    💾 Update Gallery

                </button>

                <a href="manage_gallery.php"
                   class="btn btn-secondary">

                    ↩ Back

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>