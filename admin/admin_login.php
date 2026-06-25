<?php
session_start();

if(isset($_POST['login'])){
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        body{
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;

            background: linear-gradient(-45deg, #0f2027, #203a43, #2c5364, #000428);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
        }

        @keyframes gradientBG {
            0%{background-position:0% 50%}
            50%{background-position:100% 50%}
            100%{background-position:0% 50%}
        }

        .login-card{
            width: 380px;
            padding: 30px;
            border-radius: 20px;

            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);

            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);

            color: white;
        }

        .icon{
            font-size: 50px;
            text-align: center;
            margin-bottom: 10px;
        }

        .title{
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-control{
            background: rgba(255,255,255,0.15);
            border: none;
            color: white;
            border-radius: 10px;
        }

        .form-control::placeholder{
            color: rgba(255,255,255,0.7);
        }

        .form-control:focus{
            background: rgba(255,255,255,0.25);
            color: white;
            box-shadow: none;
        }

        .btn-login{
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-login:hover{
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .footer-text{
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            opacity: 0.7;
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="icon">🔐</div>

    <h3 class="title">Admin Login</h3>

    <form method="post">

        <input class="form-control mb-3"
               name="username"
               placeholder="Username"
               required>

        <input type="password"
               class="form-control mb-3"
               name="password"
               placeholder="Password"
               required>

        <button class="btn btn-login" name="login">
            Sign In
        </button>

    </form>

    <div class="footer-text">
        © 2026 Gallery System | Admin Panel
    </div>

</div>

</body>
</html>