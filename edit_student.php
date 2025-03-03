<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit student</title>
</head>

<body>
  <h1>Edit student:</h1>

  <?php require_once('./db_connect.php');
  $student_id = $_GET['studentId'];
  $query = "SELECT surname, name, group_name FROM students WHERE id = $student_id";
  try {
    $student = $mysqli->query($query)->fetch_array();
  } catch (mysqli_sql_exception $error) {
    echo "Error: " . $error->getMessage();
  }
  ?>

  <form id="new_student" name="new_student" method="post" action="">
    <input type="text" name="surname" id="surname" size="20" maxlength="20" value="<?php echo $student['surname'] ?>" />
    <input type="text" name="name" id="name" size="20" maxlength="10" value="<?php echo $student['name'] ?>" />
    <input type="text" name="group" id="group" size="20" maxlength="20" value="<?php echo $student['group_name'] ?>" />
    <input type="submit" name="submit" id="submit" value="Edit" />
  </form>
  <a href="./students.php">Back to home page</a>

  <?php
  if (isset($_POST['submit'])) {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $group = $_POST['group'];

    $query = "UPDATE students SET surname = '$surname', name = '$name', group_name = '$group' WHERE id = $student_id";

    try {
      $mysqli->query($query);
      echo '</br>Student has been edited';
    } catch (mysqli_sql_exception $error) {
      echo "</br>Error: " . $error->getMessage();
    }
  }
  ?>
</body>

</html>