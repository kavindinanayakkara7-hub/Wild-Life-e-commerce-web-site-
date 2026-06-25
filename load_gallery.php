<?php
include 'db.php';

$category = $_GET['category'] ?? '';

$sql = "SELECT * FROM gallery WHERE status='approved'";

if($category != ''){
    $sql .= " AND category_id='$category'";
}

$res = $conn->query($sql);

while($r = $res->fetch_assoc()){
?>

<div class="col-md-4 mb-3">

<div class="card-box">

    <!-- LIKE -->
    <button class="like-btn" onclick="likeImage(<?= $r['gallery_id'] ?>)">
        ❤️ <?= $r['likes'] ?>
    </button>

    <!-- IMAGE CLICK -> SINGLE PAGE -->
    <img src="<?= $r['image_path'] ?>"
         onclick="viewImage(<?= $r['gallery_id'] ?>)">

    <div class="actions">
        <small><?= $r['caption'] ?></small>

        <button class="btn btn-sm btn-success"
                onclick="downloadImg('<?= $r['image_path'] ?>')">
            ⬇
        </button>
    </div>

</div>

</div>

<?php } ?>