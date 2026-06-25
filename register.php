<?php include 'db.php'; ?>

<?php
if(isset($_POST['register'])){
    $conn->query("INSERT INTO student(first_name,last_name,email,password,mobile,registered_date)
    VALUES('{$_POST['first_name']}','{$_POST['last_name']}','{$_POST['email']}','{$_POST['password']}','{$_POST['mobile']}',NOW())");
    echo "<script>alert('Registered Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Wildlife Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:0;
            height:100vh;
            font-family: Arial;
            background:#f6f7f2;
            display:flex;
        }

        /* LEFT IMAGE PANEL */
        .left{
            flex:1;
            background:url('https://images.unsplash.com/photo-1546182990-dffeafbe841d?auto=format&fit=crop&w=1200&q=80') no-repeat center center/cover;
            position:relative;
        }

        /* DARK OVERLAY */
        .left::after{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
            background:rgba(0,0,0,0.4);
        }

        .left-text{
            position:absolute;
            z-index:2;
            color:white;
            top:50%;
            left:50%;
            transform:translate(-50%,-50%);
            text-align:center;
        }

        .left-text h1{
            font-weight:bold;
        }

        /* RIGHT FORM */
        .right{
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .card{
            width:380px;
            border:none;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.15);
        }

        .title{
            text-align:center;
            font-weight:bold;
            color:#556b2f;
        }

        .btn-register{
            background:#556b2f;
            color:white;
            width:100%;
            border:none;
        }

        .btn-register:hover{
            background:#6b8e23;
        }

        .btn-login{
            width:100%;
            margin-top:10px;
            border:2px solid #556b2f;
            color:#556b2f;
        }

        .btn-login:hover{
            background:#556b2f;
            color:white;
        }

        @media(max-width:768px){
            .left{
                display:none;
            }
        }

    </style>
</head>

<body>

<!-- LEFT SIDE IMAGE -->
<div class="left">
    <div class="left-text">
        <h1>🐅 Wildlife System</h1>
        <p>Join and explore events, gallery & nature learning platform</p>
    </div>
</div>

<!-- RIGHT SIDE FORM -->
<div class="right">

    <div class="card p-4 bg-white">

        <h3 class="title mb-3">Create Account</h3>

        <form method="post">

            <input class="form-control mb-2" name="first_name" placeholder="First Name" required>

            <input class="form-control mb-2" name="last_name" placeholder="Last Name" required>

            <input class="form-control mb-2" name="email" placeholder="Email" required>

            <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>

            <input class="form-control mb-3" name="mobile" placeholder="Mobile" required>

            <button class="btn btn-register mb-2" name="register">
                Register
            </button>

            <a href="login.php" class="btn btn-login">
                Login
            </a>

        </form>

    </div>

</div>

</body>
</html>