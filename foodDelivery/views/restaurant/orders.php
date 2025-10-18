

<?php
session_start();

$timeout_duration = 900; 

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();    
    session_destroy();  
    header("Location: ../../auth/login.php?timeout=1");
    exit;
}

$_SESSION['LAST_ACTIVITY'] = time();
include '../../includes/db.php';

$restaurant_id = 1; 

$result = $conn->query("SELECT * FROM orders WHERE restaurantID = $restaurant_id ORDER BY created_at DESC");

echo "<h2>Incoming Orders</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>Order #{$row['orderID']} - ₱{$row['totalPrice']} - Status: {$row['orderStatus']}<br>";

    
    echo "<form method='post' action='update_status.php'>
            <input type='hidden' name='orderID' value='{$row['orderID']}'>
            <select name='status'>
              <option value='accepted'>Accept</option>
              <option value='preparing'>Preparing</option>
              <option value='on_the_way'>On the Way</option>
              <option value='delivered'>Delivered</option>
              <option value='cancelled'>Cancel</option>
            </select>
            <button type='submit'>Update</button>
          </form>";

   
    if (in_array($row['orderStatus'], ['accepted', 'preparing'])) {
        echo "<a href='assign_delivery.php?id={$row['orderID']}'>
                <button>Assign Delivery</button>
              </a><br>";
    }

    echo "</li><br>";
}
echo "</ul>";
?>

