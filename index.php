<!DOCTYPE html>
<html>
<head>
    <title>Wildlife Student System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        overflow:hidden;
        font-family:'Segoe UI',sans-serif;
    }

    /* Carousel */
    .carousel-item img{
        height:100vh;
        object-fit:cover;
        filter:brightness(55%);
    }

    /* Overlay */
    .overlay{
        position:absolute;
        top:0;
        left:0;
        width:100%;
        height:100%;
        display:flex;
        justify-content:center;
        align-items:center;
        z-index:999;
    }

    /* Glass Card */
    .welcome-card{
        width:550px;
        padding:40px;
        text-align:center;

        background:rgba(255,255,255,0.12);
        backdrop-filter:blur(15px);

        border:1px solid rgba(255,255,255,0.2);

        border-radius:25px;

        box-shadow:0 15px 35px rgba(0,0,0,.3);

        color:white;

        animation:fadeUp 1s ease;
    }

    @keyframes fadeUp{

        from{
            transform:translateY(50px);
            opacity:0;
        }

        to{
            transform:translateY(0);
            opacity:1;
        }
    }

    .logo{
        font-size:65px;
        margin-bottom:10px;
    }

    .title{
        font-size:38px;
        font-weight:700;
        margin-bottom:10px;
    }

    .subtitle{
        font-size:17px;
        color:#f1f1f1;
        margin-bottom:25px;
    }

    .btn-login{

        background:#556B2F;
        border:none;

        padding:12px;

        width:100%;

        border-radius:12px;

        font-size:18px;
        font-weight:600;
    }

    .btn-login:hover{
        background:#6B8E23;
    }

    .btn-register{

        width:100%;
        margin-top:12px;

        padding:12px;

        border-radius:12px;

        font-size:18px;
        font-weight:600;

        border:2px solid white;
        color:white;
    }

    .btn-register:hover{
        background:white;
        color:black;
    }

    .features{
        margin-top:25px;
        display:flex;
        justify-content:space-between;
        font-size:14px;
    }

    .feature-box{
        background:rgba(255,255,255,0.1);
        padding:10px;
        border-radius:10px;
        width:31%;
    }

    </style>
</head>
<body>

<!-- Carousel -->

<div id="welcomeCarousel"
     class="carousel slide carousel-fade"
     data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">

<img
src="https://images.unsplash.com/photo-1474511320723-9a56873867b5"
class="d-block w-100">

</div>

<div class="carousel-item">

<img
src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee"
class="d-block w-100">

</div>

<div class="carousel-item">

<img
src="https://images.unsplash.com/photo-1546182990-dffeafbe841d"
class="d-block w-100">

</div>

<div class="carousel-item">

<img
src="https://images.unsplash.com/photo-1516934024742-b461fba47600"
class="d-block w-100">

</div>

</div>

</div>

<!-- Overlay Content -->

<div class="overlay">

<div class="welcome-card">

<div class="logo">
🌿
</div>

<h1 class="title">
Wildlife Student System
</h1>

<p class="subtitle">

Explore wildlife galleries, educational events,
nature awareness programs and student activities.

</p>

<a href="login.php"
class="btn btn-login">
🔐 Login
</a>

<a href="register.php"
class="btn btn-register">
📝 Register
</a>

<div class="features">

<div class="feature-box">
📷 Gallery
</div>

<div class="feature-box">
🎉 Events
</div>

<div class="feature-box">
🌎 Wildlife
</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>