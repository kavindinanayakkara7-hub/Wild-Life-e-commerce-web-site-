<?php
include '../db.php';

$id = $_GET['event_id'];

$conn->query("DELETE FROM event WHERE event_id='$id'");

header("Location: manage_events.php");
exit();
?>