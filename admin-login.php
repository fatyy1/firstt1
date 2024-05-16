<?php
session_start();
include 'db_connect.php';


$admin_hashed_password = '$2y$10$bjyRmEUta8.yO6v6SApUt.eVJ0lytuGFORaXHRG3kZClgZTCLmMK6';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin_username = 'Faty';

    if ($username === $admin_username && password_verify($password, $admin_hashed_password)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid login credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<h2>Admin Login</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <input type="submit" value="Login">
</form>
<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

</body>
</html>
