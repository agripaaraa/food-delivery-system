

<?php
session_start();
include '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
    die("Access denied.");
}

$userID = $_SESSION['user']['userID'];

$result = $conn->query("SELECT * FROM orders WHERE userID = $userID ORDER BY created_at DESC");

echo "<h2>My Orders</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>
        Order #{$row['orderID']} - ₱{$row['totalPrice']}<br>
        Status: <strong>{$row['orderStatus']}</strong><br>";

    if ($row['eta']) {
        echo "ETA: " . date("g:i A", strtotime($row['eta'])) . "<br>";
    }

   
    $orderID = $row['orderID'];
    $partner = $conn->query("SELECT d.userID FROM delivery_assigns da
                             JOIN delivery_partners d ON da.deliveryID = d.deliveryID
                             WHERE da.orderID = $orderID")->fetch_assoc();

    if ($partner) {
        echo "Delivery Partner ID: {$partner['userID']}<br>";
    }

    echo "</li><br>";
}
echo "</ul>";
?>

