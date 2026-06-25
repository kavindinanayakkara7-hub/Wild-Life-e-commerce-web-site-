<?php
include '../db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM event_registration WHERE registration_id='$id'");

header("Location: manage_registrations.php");
exit();
?>