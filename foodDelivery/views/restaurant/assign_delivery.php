

<?php
session_start();
include '../../includes/db.php';

$orderID = $_GET['id'];
$restaurantID = $_SESSION['user']['userID'];

$partners = $conn->query("SELECT * FROM delivery_partners WHERE deliveryStatus = 'available'");

echo "<h2>Assign Delivery Partner for Order #$orderID</h2>";
echo "<form method='post' action='assign_action.php'>";
echo "<input type='hidden' name='orderID' value='$orderID'>";
echo "Select Partner: <select name='deliveryID'>";
while ($row = $partners->fetch_assoc()) {
    echo "<option value='{$row['deliveryID']}'>Partner #{$row['deliveryID']} - {$row['vehicleType']}</option>";
}
echo "</select><br><br>";
echo "<button type='submit'>Assign</button>";
echo "</form>";
?>

