<?php
include '../db.php';

$id = $_GET['gallery_id'];

$res = $conn->query("SELECT * FROM gallery WHERE gallery_id='$id'");
$row = $res->fetch_assoc();

if($row){
    unlink("../".$row['image_path']);
}

$conn->query("DELETE FROM gallery WHERE gallery_id='$id'");

header("Location: manage_gallery.php");
exit();
?>