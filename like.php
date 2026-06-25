<?php
include 'db.php';

$id = $_POST['id'];

$conn->query("UPDATE gallery SET likes = likes + 1 WHERE gallery_id='$id'");

echo "success";
?>