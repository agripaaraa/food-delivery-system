

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

include '../includes/db.php';
$id = $_GET['id'];
$item = $conn->query("SELECT * FROM menuitems WHERE menuID=$id")->fetch_assoc();
?>
<h2>Order: <?= $item['menuName'] ?></h2>
<form action="save_order.php" method="post">
  <input type="hidden" name="item_id" value="<?= $item['menuID'] ?>">
  Name: <input type="text" name="customer_name" required><br>
  Quantity: <input type="number" name="quantity" value="1" min="1"><br>
  <button type="submit">Place Order</button>
</form>

