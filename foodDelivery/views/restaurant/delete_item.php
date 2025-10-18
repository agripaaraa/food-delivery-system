

<?php
session_start();
include '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'restaurant') {
    die("Access denied.");
}

$menuID = $_GET['id'];
$restaurantID = $_SESSION['user']['userID'];

$check = $conn->query("SELECT * FROM menuitems WHERE menuID = $menuID AND restaurantID = $restaurantID");
if ($check->num_rows === 0) {
    die("Item not found or you do not have permission to delete it.");
}

$conn->query("DELETE FROM menuitems WHERE menuID = $menuID AND restaurantID = $restaurantID");

header("Location: menu.php");
exit;
?>
