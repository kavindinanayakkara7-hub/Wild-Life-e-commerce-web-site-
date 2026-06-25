<?php
include '../db.php';

$id = $_GET['id'];

$conn->query("DELETE FROM student WHERE student_id='$id'");

header("Location: students.php");
exit();
?>