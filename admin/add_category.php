<?php
include '../db.php';

if(isset($_POST['save'])){

    $category_name = mysqli_real_escape_string($conn,$_POST['category_name']);

    $conn->query("
        INSERT INTO category(category_name)
        VALUES('$category_name')
    ");

    echo "
    <script>
        alert('Category Added Successfully');
        window.location='manage_category.php';
    </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Category</title>

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
.category-card{
    max-width:650px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

/* Header */
.header-box{
    background:linear-gradient(135deg,#10b981,#059669);
    color:white;
    padding:20px;
    border-radius:15px;
    text-align:center;
    margin-bottom:25px;
}

/* Input */
.form-control{
    border-radius:10px;
    padding:12px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#10b981;
}

/* Buttons */
.btn-save{
    background:#10b981;
    border:none;
    padding:10px 25px;
    border-radius:10px;
}

.btn-save:hover{
    background:#059669;
}

.btn-back{
    border-radius:10px;
}

.info-box{
    background:#ecfdf5;
    border-left:5px solid #10b981;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
}

</style>

</head>
<body>

<div class="container py-5">

    <div class="category-card">

        <!-- Header -->
        <div class="header-box">

            <h2>📂 Add Category</h2>
            <p class="mb-0">Create new category for gallery & events</p>

        </div>

        <!-- Info -->
        <div class="info-box">

            <strong>ℹ Instructions:</strong><br>
            Enter a unique category name and click save.

        </div>

        <!-- Form -->
        <form method="post">

            <label class="form-label fw-bold">
                Category Name
            </label>

            <input type="text"
                   name="category_name"
                   class="form-control mb-4"
                   placeholder="Enter Category Name"
                   required>

            <div class="d-flex gap-2">

                <button class="btn btn-save text-white"
                        name="save">

                    💾 Save Category

                </button>

                <a href="manage_category.php"
                   class="btn btn-secondary btn-back">

                    ↩ Back

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>