<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM gallery WHERE gallery_id='$id'";
$res = $conn->query($sql);
$row = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Modern Gallery View</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg,#0f172a,#1e293b);
    color:white;
}

/* TOP BAR */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:15px 25px;
    background:rgba(255,255,255,0.05);
    backdrop-filter: blur(12px);
    border-bottom:1px solid rgba(255,255,255,0.1);
}

.logo{
    font-weight:700;
    color:#7CFC98;
    letter-spacing:1px;
}

.back-btn{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    color:white;
    padding:8px 14px;
    border-radius:10px;
    text-decoration:none;
    transition:0.3s;
}

.back-btn:hover{
    background:#7CFC98;
    color:black;
}

/* MAIN CARD */
.viewer{
    max-width:950px;
    margin:40px auto;
    background:rgba(255,255,255,0.05);
    border-radius:20px;
    padding:25px;
    backdrop-filter: blur(18px);
    box-shadow:0 15px 40px rgba(0,0,0,0.6);
}

/* IMAGE */
.image-box{
    text-align:center;
}

.image-box img{
    width:100%;
    max-height:550px;
    object-fit:cover;
    border-radius:15px;
    transition:0.4s;
}

.image-box img:hover{
    transform:scale(1.02);
}

/* INFO SECTION */
.info{
    margin-top:20px;
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    flex-wrap:wrap;
    gap:15px;
}

.caption{
    font-size:16px;
    color:#e5e7eb;
    max-width:60%;
}

/* ACTION PANEL */
.actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn-action{
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.15);
    color:white;
    padding:10px 14px;
    border-radius:12px;
    cursor:pointer;
    transition:0.3s;
    font-size:14px;
}

.btn-action:hover{
    background:#7CFC98;
    color:black;
    transform:translateY(-2px);
}

/* LIKE COUNTER */
.like-box{
    display:flex;
    align-items:center;
    gap:8px;
    font-weight:600;
    color:#fbbf24;
}

/* FOOTER */
.footer-note{
    text-align:center;
    margin-top:25px;
    font-size:12px;
    color:#94a3b8;
}

@media(max-width:768px){
    .caption{
        max-width:100%;
    }

    .info{
        flex-direction:column;
    }
}

</style>
</head>

<body>

<!-- TOP BAR -->
<div class="topbar">
    <div class="logo">🌿 Modern Gallery View</div>
    <a href="index.php" class="back-btn">⬅ Back</a>
</div>

<!-- MAIN VIEW -->
<div class="viewer">

    <div class="image-box">
        <img src="<?= $row['image_path'] ?>" alt="image">
    </div>

    <div class="info">

        <div class="caption">
            <?= $row['caption'] ?>
        </div>

        <div class="actions">

            <div class="like-box">
                ❤️ <span id="likeCount"><?= $row['likes'] ?></span>
            </div>

            <button class="btn-action" onclick="likeImage(<?= $row['gallery_id'] ?>)">
                👍 Like
            </button>

            <button class="btn-action" onclick="downloadImg('<?= $row['image_path'] ?>')">
                ⬇ Download
            </button>

            <button class="btn-action" onclick="shareImage()">
                🔗 Share
            </button>

        </div>

    </div>

    <div class="footer-note">
        Premium Gallery UI • Modern Glass Design
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

function downloadImg(path){
    let a = document.createElement('a');
    a.href = path;
    a.download = path.split('/').pop();
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

function shareImage(){
    let url = window.location.href;

    if(navigator.share){
        navigator.share({
            title: "Modern Gallery Image",
            url: url
        });
    } else {
        navigator.clipboard.writeText(url);
        alert("Link copied!");
    }
}

function likeImage(id){
    $.post("like.php",{id:id},function(){
        location.reload();
    });
}

</script>

</body>
</html>