<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Wildlife Gallery System</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    font-family:'Poppins',sans-serif;
}

:root{
    --olive:#556B2F;
    --darkolive:#2f3d16;
}

body{
    background:#f8fafc;
}

/* NAVBAR */
.navbar{
    background:linear-gradient(135deg,var(--olive),var(--darkolive));
    padding:15px 25px;
    box-shadow:0 5px 20px rgba(0,0,0,.15);
}

.navbar a{
    color:white;
    text-decoration:none;
    font-weight:500;
}

.navbar a:hover{
    color:#d9f99d;
}

.user-badge{
    background:white;
    color:var(--olive);
    padding:8px 15px;
    border-radius:25px;
    font-weight:600;
}

/* HERO */
.hero{
    height:300px;
    background:
    linear-gradient(rgba(0,0,0,.5),rgba(0,0,0,.5)),
    url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e');

    background-size:cover;
    background-position:center;

    display:flex;
    align-items:center;
    justify-content:center;
    flex-direction:column;

    color:white;
    text-align:center;
}

.hero h1{
    font-size:50px;
    font-weight:700;
}

.hero p{
    max-width:700px;
}

/* STATS */
.stat-card{
    background:white;
    padding:25px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
}

/* CAROUSEL */
.carousel{
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.1);
}

.carousel-item img{
    height:500px;
    object-fit:cover;
}

/* SIDEBAR */
.sidebar{
    background:white;
    padding:20px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    position:sticky;
    top:20px;
}

.sidebar button{
    width:100%;
    margin-bottom:10px;
    border-radius:10px;
}

/* GALLERY */
.card-box{
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,.08);
    transition:.4s;
}

.card-box:hover{
    transform:translateY(-8px);
}

.card-box img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.card-content{
    padding:15px;
}

.card-content p{
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.lightbox{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,.9);
    display:none;
    justify-content:center;
    align-items:center;
    z-index:9999;
}

.lightbox img{
    max-width:90%;
    max-height:90%;
    border-radius:15px;
}

</style>
</head>

<body>

<?php
$fullName = "Guest";

if(isset($_SESSION['student_id'])){

    $id = $_SESSION['student_id'];

    $res = $conn->query("
    SELECT first_name,last_name
    FROM student
    WHERE student_id='$id'
    ");

    if($row = $res->fetch_assoc()){
        $fullName =
        $row['first_name']." ".$row['last_name'];
    }
}
?>

<nav class="navbar d-flex justify-content-between">

<div class="text-white fw-bold fs-4">
🌿 Wildlife Gallery
</div>

<div class="d-flex align-items-center gap-3">

<a href="profile.php">Profile</a>
<a href="events.php">Events</a>
<a href="announcements.php">Announcements</a>
<a href="contact.php">Contact</a>
<a href="view_events.php">My Events</a>

<span class="user-badge">
👤 <?= $fullName ?>
</span>

</div>

</nav>

<!-- HERO -->
<div class="hero">

<h1>Wildlife Gallery System</h1>

<p>
Discover wildlife events, educational activities,
photography and conservation programs.
</p>

</div>

<!-- STATS -->
<div class="container mt-4">

<div class="row">

<div class="col-md-4 mb-3">
<div class="stat-card">
<h2>🖼️</h2>
<h3>500+</h3>
<p>Gallery Photos</p>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="stat-card">
<h2>🎉</h2>
<h3>50+</h3>
<p>Events</p>
</div>
</div>

<div class="col-md-4 mb-3">
<div class="stat-card">
<h2>👨‍🎓</h2>
<h3>1000+</h3>
<p>Students</p>
</div>
</div>

</div>

</div>

<!-- CAROUSEL -->

<div class="container mt-4">

<div id="mainCarousel"
class="carousel slide"
data-bs-ride="carousel">

<div class="carousel-inner">

<div class="carousel-item active">
<img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee" class="w-100">
</div>

<div class="carousel-item">
<img src="https://images.unsplash.com/photo-1546182990-dffeafbe841d" class="w-100">
</div>

<div class="carousel-item">
<img src="https://images.unsplash.com/photo-1501706362039-c06b2d715385" class="w-100">
</div>

</div>

</div>

</div>

<div class="container mt-4">

<div class="row">

<div class="col-md-3">

<div class="sidebar">

<h5>📂 Categories</h5>

<button class="btn btn-dark"
onclick="loadGallery('')">
All Categories
</button>

<?php
$cat = $conn->query("SELECT * FROM category");

while($c = $cat->fetch_assoc()){
?>

<button
class="btn btn-outline-success"
onclick="loadGallery(<?= $c['category_id']; ?>)">
<?= $c['category_name']; ?>
</button>

<?php } ?>

</div>

</div>

<div class="col-md-9">
<div class="row" id="galleryBox"></div>
</div>

</div>

</div>

<div class="lightbox" id="lightbox"
onclick="closeLightbox()">

<img id="lightboxImg">

</div>

<!-- FOOTER -->

<footer style="
background:linear-gradient(135deg,#556B2F,#2f3d16);
color:white;
padding:60px 0 20px 0;
margin-top:60px;
">

<div class="container">

<div class="row">

<!-- ABOUT -->
<div class="col-md-4 mb-4">

<h4>🌿 Wildlife Gallery</h4>

<p>
A modern wildlife and educational gallery system
designed to promote conservation awareness,
student participation, photography and events.
</p>

<p>📍 Galle, Southern Province, Sri Lanka</p>
<p>📧 support@wildgallery.lk</p>
<p>📞 +94 71 234 5678</p>
<p>🕒 Monday - Friday : 8.00 AM - 5.00 PM</p>

</div>

<!-- QUICK LINKS -->
<div class="col-md-4 mb-4">

<h4>🔗 Quick Links</h4>

<p>
<a href="profile.php"
style="color:white;text-decoration:none;">
👤 Profile
</a>
</p>

<p>
<a href="events.php"
style="color:white;text-decoration:none;">
🎉 Events
</a>
</p>

<p>
<a href="announcements.php"
style="color:white;text-decoration:none;">
📢 Announcements
</a>
</p>

<p>
<a href="contact.php"
style="color:white;text-decoration:none;">
📩 Contact Us
</a>
</p>

<p>
<a href="view_events.php"
style="color:white;text-decoration:none;">
📋 My Events
</a>
</p>

</div>

<!-- MAP -->
<div class="col-md-4 mb-4">

<h4>📍 Our Location</h4>

<iframe
src="https://maps.google.com/maps?q=Galle%20Sri%20Lanka&t=&z=11&ie=UTF8&iwloc=&output=embed"
width="100%"
height="220"
style="
border:0;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.3);
"
loading="lazy">
</iframe>

</div>

</div>

<hr style="border-color:rgba(255,255,255,.3);">

<!-- SOCIAL -->

<div class="text-center mb-3">

<a href="#"
style="
color:white;
margin-right:15px;
text-decoration:none;
font-size:18px;
">
📘 Facebook
</a>

<a href="#"
style="
color:white;
margin-right:15px;
text-decoration:none;
font-size:18px;
">
📸 Instagram
</a>

<a href="#"
style="
color:white;
margin-right:15px;
text-decoration:none;
font-size:18px;
">
▶ YouTube
</a>

<a href="#"
style="
color:white;
text-decoration:none;
font-size:18px;
">
🐦 Twitter
</a>

</div>

<div class="text-center">

<small>
© 2026 Wildlife Gallery System |
All Rights Reserved |
Developed for Wildlife Education & Conservation
</small>

</div>

</div>

</footer>

<!-- JS -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function loadGallery(cat=''){

    $.get(
        "load_gallery.php",
        {category:cat},
        function(data){

            $("#galleryBox").html(data);

        }
    );

}

loadGallery();

/* DARK MODE */

function toggleDark(){

    document.body.classList.toggle("dark");

}

/* LIGHTBOX */

function openLightbox(src){

    $("#lightboxImg").attr("src",src);

    $("#lightbox").css("display","flex");

}

function closeLightbox(){

    $("#lightbox").hide();

}

/* LIKE IMAGE */

function likeImage(id){

    $.post(
        "like.php",
        {id:id},
        function(){

            loadGallery();

        }
    );

}

/* DOWNLOAD */

function downloadImg(path){

    let a = document.createElement("a");

    a.href = path;

    a.download =
    path.split('/').pop();

    document.body.appendChild(a);

    a.click();

    document.body.removeChild(a);

}

/* SINGLE IMAGE */

function viewImage(id){

    window.location =
    "single_image_view.php?id=" + id;

}

</script>

</body>
</html>