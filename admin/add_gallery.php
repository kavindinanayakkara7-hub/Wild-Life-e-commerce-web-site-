<?php
include '../db.php';

if(isset($_POST['save'])){

    $caption = mysqli_real_escape_string($conn,$_POST['caption']);
    $category_id = $_POST['category_id'];

    $admin_id = 1;

    if(isset($_FILES['image']) && $_FILES['image']['error']==0){

        $imageName = $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];

        $newName = time().'_'.basename($imageName);

        $uploadFolder = "../images/";

        if(!is_dir($uploadFolder)){
            mkdir($uploadFolder,0777,true);
        }

        $filePath = $uploadFolder.$newName;

        if(move_uploaded_file($tmpName,$filePath)){

            $dbPath = "images/".$newName;

            $sql = "INSERT INTO gallery
                    (image_path,caption,upload_date,admin_id,category_id)
                    VALUES
                    ('$dbPath','$caption',NOW(),'$admin_id','$category_id')";

            if($conn->query($sql)){

                echo "
                <script>
                    alert('Image Uploaded Successfully');
                    window.location='manage_gallery.php';
                </script>";
                exit();

            }else{
                echo $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Gallery Image</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fc;
}

.upload-card{
    max-width:850px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.header-box{
    background:linear-gradient(135deg,#10b981,#059669);
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

.preview-box{
    width:100%;
    height:300px;
    border:2px dashed #10b981;
    border-radius:15px;
    overflow:hidden;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f0fdf4;
    margin-bottom:20px;
}

.preview-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:none;
}

.preview-text{
    color:#64748b;
    font-size:18px;
}

.form-control,
.form-select{
    border-radius:10px;
    padding:12px;
}

.btn-upload{
    background:#10b981;
    border:none;
    padding:10px 25px;
}

.btn-upload:hover{
    background:#059669;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="upload-card">

        <div class="header-box">

            <h2>🖼️ Add Gallery Image</h2>

            <p class="mb-0">
                Upload new images to the gallery
            </p>

        </div>

        <form method="POST" enctype="multipart/form-data">

            <!-- Preview -->
            <div class="preview-box">

                <span class="preview-text" id="previewText">
                    📷 Image Preview
                </span>

                <img id="previewImage">

            </div>

            <!-- Category -->
            <label class="form-label fw-bold">
                Category
            </label>

            <select name="category_id"
                    class="form-select mb-3"
                    required>

                <option value="">
                    Select Category
                </option>

                <?php
                $cat = $conn->query("SELECT * FROM category");

                while($row = $cat->fetch_assoc()){
                ?>

                <option value="<?= $row['category_id']; ?>">
                    <?= $row['category_name']; ?>
                </option>

                <?php } ?>

            </select>

            <!-- Image -->
            <label class="form-label fw-bold">
                Select Image
            </label>

            <input type="file"
                   name="image"
                   id="imageInput"
                   class="form-control mb-3"
                   accept="image/*"
                   required>

            <!-- Caption -->
            <label class="form-label fw-bold">
                Caption
            </label>

            <textarea
                name="caption"
                class="form-control mb-4"
                rows="5"
                placeholder="Enter image description..."
                required></textarea>

            <button
                type="submit"
                name="save"
                class="btn btn-upload text-white">

                ⬆ Upload Image

            </button>

            <a href="manage_gallery.php"
               class="btn btn-secondary">

                ↩ Back

            </a>

        </form>

    </div>

</div>

<script>

document.getElementById("imageInput").addEventListener("change", function(e){

    let file = e.target.files[0];

    if(file){

        let reader = new FileReader();

        reader.onload = function(event){

            document.getElementById("previewImage").src =
            event.target.result;

            document.getElementById("previewImage").style.display =
            "block";

            document.getElementById("previewText").style.display =
            "none";
        };

        reader.readAsDataURL(file);
    }

});

</script>

</body>
</html>