

<?php
session_start();
include '../../includes/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'restaurant') {
    die("Access denied.");
}

$menuID = $_GET['id'];
$restaurantID = $_SESSION['user']['userID'];

$result = $conn->query("SELECT * FROM menuitems WHERE menuID = $menuID AND restaurantID = $restaurantID");
$item = $result->fetch_assoc();

if (!$item) {
    die("Menu item not found or access denied.");
}
?>

<h2>Edit Menu Item</h2>
<form method="post">
  Name: <input type="text" name="menuName" value="<?= $item['menuName'] ?>" required><br>
  Description: <input type="text" name="menuDescription" value="<?= $item['menuDescription'] ?>"><br>
  Price: <input type="number" name="menuPrice" step="0.01" value="<?= $item['menuPrice'] ?>" required><br>
  Available:
  <select name="available">
    <option value="1" <?= $item['available'] ? 'selected' : '' ?>>Yes</option>
    <option value="0" <?= !$item['available'] ? 'selected' : '' ?>>No</option>
  </select><br>
  <button type="submit">Update Item</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['menuName'];
    $desc = $_POST['menuDescription'];
    $price = $_POST['menuPrice'];
    $available = $_POST['available'];

    $stmt = $conn->prepare("UPDATE menuitems SET menuName=?, menuDescription=?, menuPrice=?, available=? WHERE menuID=? AND restaurantID=?");
    $stmt->bind_param("ssdiii", $name, $desc, $price, $available, $menuID, $restaurantID);
    $stmt->execute();

    header("Location: menu.php");
}
?>

