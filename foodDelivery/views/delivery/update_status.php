

<?php
session_start();
include '../../includes/db.php';

$orderID = $_POST['orderID'];
$status = $_POST['status'];

$conn->query("UPDATE orders SET orderStatus = '$status' WHERE orderID = $orderID");

$conn->query("UPDATE delivery_assigns SET assStatus = '$status' WHERE orderID = $orderID");

header("Location: deliveries.php");
?>

