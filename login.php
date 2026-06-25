<?php include 'db.php'; session_start(); ?>

<?php
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM student WHERE email='$email' AND password='$password'");
    $row = $res->fetch_assoc();

    if($row){
        $_SESSION['student_id'] = $row['student_id'];
        header("Location: gallery.php");
        exit();
    } else {
        echo "<script>alert('Invalid Login');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wildlife Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            font-family: Arial;
            background: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1400&q=80') no-repeat center center/cover;
        }

        /* DARK OVERLAY */
        .overlay{
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.4);
        }

        .card{
            width:380px;
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

        .btn-login{
            background:#556b2f;
            color:white;
            width:100%;
            border:none;
        }

        .btn-login:hover{
            background:#6b8e23;
        }

        .btn-profile{
            width:100%;
            margin-top:10px;
            border:2px solid #556b2f;
            color:#556b2f;
        }

        .btn-profile:hover{
            background:#556b2f;
            color:white;
        }

        .form-control{
            border-radius:8px;
        }

    </style>
</head>

<body>

<!-- DARK OVERLAY -->
<div class="overlay"></div>

<!-- LOGIN CARD -->
<div class="card p-4 bg-white">

    <h3 class="title mb-3">🐘 Wildlife Student Login</h3>

    <form method="post">

        <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>

        <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>

        <button class="btn btn-login mb-2" name="login">
            Login
        </button>

        <a href="profile.php" class="btn btn-profile">
            View Profile
        </a>

        <a href="register.php" class="btn btn-outline-secondary w-100 mt-2">
            Create Account
        </a>

    </form>

</div>

</body>
</html>