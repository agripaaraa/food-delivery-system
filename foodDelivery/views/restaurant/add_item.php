

<?php
session_start();
include '../../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $restaurantID = $_SESSION['user']['userID'];
    $name = $_POST['menuName'];
    $desc = $_POST['menuDescription'];
    $price = $_POST['menuPrice'];
    $available = $_POST['available'];

    $stmt = $conn->prepare("INSERT INTO menuitems (restaurantID, menuName, menuDescription, menuPrice, available)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issdi", $restaurantID, $name, $desc, $price, $available);
    $stmt->execute();

    header("Location: menu.php");
}
?>

<form method="post">
  Name: <input type="text" name="menuName" required><br>
  Description: <input type="text" name="menuDescription"><br>
  Price: <input type="number" name="menuPrice" step="0.01" required><br>
  Available: 
  <select name="available">
    <option value="1">Yes</option>
    <option value="0">No</option>
  </select><br>
  <button type="submit">Add Item</button>
</form>


