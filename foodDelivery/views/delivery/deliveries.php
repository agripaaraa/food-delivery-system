

<?php
session_start();
include '../../includes/db.php';

$deliveryID = $_SESSION['user']['userID'];

$result = $conn->query("SELECT o.orderID, o.totalPrice, o.orderStatus, da.assStatus
                        FROM delivery_assigns da
                        JOIN orders o ON da.orderID = o.orderID
                        WHERE da.deliveryID = $deliveryID
                        ORDER BY da.assigned_at DESC");

echo "<h2>My Deliveries</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>
        Order #{$row['orderID']} - ₱{$row['totalPrice']}<br>
        Status: {$row['orderStatus']}<br>
        Assignment: {$row['assStatus']}<br>
        <form method='post' action='update_status.php'>
            <input type='hidden' name='orderID' value='{$row['orderID']}'>
            <select name='status'>
              <option value='on_the_way'>On the Way</option>
              <option value='delivered'>Delivered</option>
            </select>
            <button type='submit'>Update</button>
        </form>
    </li><br>";
    echo "ETA: " . date("g:i A", strtotime($row['eta'])) . "<br>";

}
echo "</ul>";
?>
