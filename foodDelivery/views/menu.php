

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

include '../includes/db.php'; ?>
<h2>Menu</h2>
<ul>
<?php
$result = $conn->query("SELECT * FROM menuitems WHERE available = 1");
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['menuName']} - ₱{$row['menuPrice']} 
          <a href='order.php?id={$row['menuID']}'>Order</a></li>";
}
} else {
    echo "<li>No menu items available.</li>";
}
?>
</ul>

