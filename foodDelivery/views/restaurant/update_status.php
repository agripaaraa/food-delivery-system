
<?php
include '../../includes/db.php';
$orderID = $_POST['orderID'];
$status = $_POST['status'];

$conn->query("UPDATE orders SET orderStatus = '$status' WHERE orderID = $orderID");
header("Location: orders.php");
?>

