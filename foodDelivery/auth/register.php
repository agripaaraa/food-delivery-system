

<?php
include '../includes/db.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();

    echo "Registered successfully! <a href='login.php'>Login here</a>";
}
?>

<form method="post">
  Name: <input type="text" name="name" required><br>
  Email: <input type="email" name="email" required><br>
  Password: <input type="password" name="password" required><br>
  Role:
  <select name="role">
    <option value="customer">Customer</option>
    <option value="restaurant">Restaurant</option>
    <option value="delivery">Delivery</option>
    <option value="admin">Admin</option>
  </select><br>
  <button type="submit">Register</button>
</form>

