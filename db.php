<?php
$host = "localhost";
$user = "root";
$pass = "Kavi@1234?kavi*";
$db   = "CampusHub_Student_Event_Management_System";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>