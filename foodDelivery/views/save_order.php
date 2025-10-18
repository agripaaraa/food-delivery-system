

<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user'])) {
    die("You must be logged in to place an order.");
}

$name = $_POST['customer_name'];
$item_id = $_POST['item_id'];
$qty = $_POST['quantity'];
$user_id = $_SESSION['user']['userID'];

$item = $conn->query("SELECT menuPrice FROM menuitems WHERE menuID=$item_id")->fetch_assoc();
$total = $item['menuPrice'] * $qty;

$conn->query("INSERT INTO orders (userID, restaurantID, totalPrice, orderStatus)
              VALUES ($user_id, 1, $total, 'pending')");

echo "Order placed successfully! <a href='menu.php'>Back to menu</a>";
?>

