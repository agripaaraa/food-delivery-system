
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

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'restaurant') {
    die("Access denied.");
}

$restaurant_id = $_SESSION['user']['userID'];

$query = "SELECT * FROM menuitems WHERE restaurantID = $restaurant_id";
$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "<h2>My Menu</h2><p>No menu items found for your restaurant.</p>";
    exit;
}

echo "<h2>My Menu</h2><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['menuName']} - ₱{$row['menuPrice']} 
          <br>Description: {$row['menuDescription']} 
          <br>Status: " . ($row['available'] ? 'Available' : 'Unavailable') . "<br>

        <a href='edit_item.php?id={$row['menuID']}'>Edit</a> |
        <a href='delete_item.php?id={$row['menuID']}' onclick=\"return confirm('Delete this item?')\">Delete</a>
        </li><br>";
}
echo "</ul>";
?>

