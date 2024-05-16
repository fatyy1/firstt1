<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset']) && $_POST['reset'] == 'true') {
  
    $reset_sql = "UPDATE students SET present=0";
    if ($conn->query($reset_sql) === TRUE) {
        echo "All records have been reset successfully";
    } else {
        echo "Error: " . $reset_sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id, name, present FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<h2>Reset All Students Attendance</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  <input type="hidden" name="reset" value="true">
  <input type="submit" value="Reset Attendance">
</form>

<h2>Student List</h2>
<table border="1">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Present</th>
  </tr>
  <?php
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . ($row["present"] ? 'Yes' : 'No') . "</td></tr>";
      }
  } else {
      echo "<tr><td colspan='3'>No records found</td></tr>";
  }
  $conn->close();
  ?>
</table>

</body>
</html>
