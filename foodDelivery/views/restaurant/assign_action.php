

<?php
session_start();
include '../../includes/db.php';

$orderID = $_POST['orderID'];
$deliveryID = $_POST['deliveryID'];

$stmt = $conn->prepare("INSERT INTO delivery_assigns (orderID, deliveryID, assigned_at, assStatus)
                        VALUES (?, ?, NOW(), 'assigned')");
$stmt->bind_param("ii", $orderID, $deliveryID);
$stmt->execute();

$conn->query("UPDATE delivery_partners SET deliveryStatus = 'assigned' WHERE deliveryID = $deliveryID");

$conn->query("UPDATE orders SET orderStatus = 'assigned' WHERE orderID = $orderID");

$eta = date("H:i:s", strtotime("+30 minutes"));
$conn->query("UPDATE orders SET orderStatus = 'assigned', eta = '$eta' WHERE orderID = $orderID");

header("Location: orders.php");
?>

