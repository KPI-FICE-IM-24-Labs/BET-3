<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete student</title>
</head>

<body>
  <?php require_once('./db_connect.php');    
  try {    
    $student_id = $_GET['studentId'];
    $query = "DELETE FROM students WHERE id = $student_id";
    $mysqli->query($query);
    echo "</br>Student has been deleted";
    echo '</br><a href="./students.php">Back to home page</a>';
  } catch (mysqli_sql_exception $error) {
    echo "</br>Error: " . $error->getMessage();
  }
  ?>  
</body>

</html>