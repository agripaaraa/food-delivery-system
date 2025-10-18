

<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: auth/login.php");
    exit;
}

$role = $_SESSION['user']['role'];

switch ($role) {
    case 'customer': header("Location: ../views/customer/index.php"); break;
    case 'restaurant': header("Location: ../views/restaurant/index.php"); break;
    case 'delivery': header("Location: ../views/delivery/index.php"); break;
    case 'admin': header("Location: ../views/admin/index.php"); break;
}
?>