

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

if ($_SESSION['user']['role'] !== 'delivery') {
    header("Location: ../../auth/login.php");
    exit;
}
?>

<h2>Welcome, <?= $_SESSION['user']['name'] ?>!</h2>
<ul>
  <li><a href="deliveries.php">My Deliveries</a></li>
  <li><a href="../../auth/logout.php">Logout</a></li>
</ul>

