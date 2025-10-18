<?php
$conn = new mysqli("localhost", "root", "", "delivery food app");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
