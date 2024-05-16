<?php
session_start();
include 'db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$secret_number = "12345";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $entered_secret = $_POST['secret_number'];
    $present = ($entered_secret === $secret_number) ? 1 : 0;

    $id = $conn->real_escape_string($id);
    $name = $conn->real_escape_string($name);
    $entered_secret = $conn->real_escape_string($entered_secret);

    $check_sql = "SELECT id FROM students WHERE id='$id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {

        $sql = "UPDATE students SET name='$name', present='$present' WHERE id='$id'";
    } else {
  
        $sql = "INSERT INTO students (id, name, present) VALUES ('$id', '$name', '$present')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Attendance</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<h2>Student Attendance Form</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
  ID: <input type="text" name="id" required><br><br>
  Name: <input type="text" name="name" required><br><br>
  Secret Number: <input type="text" name="secret_number" required><br><br>
  <input type="submit" value="Submit">
</form>

</body>
</html>
