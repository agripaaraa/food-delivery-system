

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

$user_id = $_SESSION['user']['userID'];
$result = $conn->query("SELECT * FROM orders WHERE userID = $user_id");

echo "<h2>My Orders</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>Order #{$row['orderID']} - ₱{$row['totalPrice']} - Status: {$row['orderStatus']}</li>";
}
echo "</ul>";
?>
