<?php
include '../db.php';

$id = $_GET['announcement_id'];

$conn->query("DELETE FROM announcement WHERE announcement_id='$id'");

header("Location: manage_announcements.php");
exit();
?>