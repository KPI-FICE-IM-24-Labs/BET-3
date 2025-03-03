<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create student</title>
</head>

<body>
  <h1>Add new student:</h1>
  <form id="new_student" name="new_student" method="post">
    <input type="text" name="surname" id="surname" size="20" maxlength="20" placeholder="Surname" />
    <input type="text" name="name" id="name" size="20" maxlength="10"  placeholder="Name" />
    <input type="text" name="group" id="group" size="20" maxlength="20" placeholder="Group" />
    <input type="hidden" name="created" id="created" value="<?php echo date("Y-m-d"); ?>" />
    <input type="submit" name="submit" id="submit" value="Add +" />
  </form></br>
  <a href="./students.php">Back to home page</a>

  <?php
  if (isset($_POST['submit'])) {
    require_once('./db_connect.php');
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $group = $_POST['group'];
    $created = $_POST['created'];

    $query = "INSERT INTO students (surname, name, group_name, created) VALUES ('$surname', '$name', '$group', '$created')";

    try {
      $mysqli->query($query);
      echo '</br>Student has been added';
    } catch (mysqli_sql_exception $error) {
      echo "</br>Error: " . $error->getMessage();
    }
  }
  ?>
</body>

</html>