<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students</title>
</head>

<body>
  <?php require_once("./db_connect.php");
  $getAllStudents = "SELECT * FROM students";
  $records = $mysqli->query($getAllStudents);

  if (!$records->num_rows > 0) {
    echo "No records found$nl";
  } else {
    echo '<table border="1">';
    echo '<tr>
            <th>Fullname</th>
            <th>Group</th>
            <th>Date added</th>
          </tr>';

    while ($row = $records->fetch_array()) {
      echo '<tr>
            <td>' . $row['surname'] . ' ' . $row['name'] . '</td>
            <td>' . $row['group_name'] . '</td>
            <td>' . $row['created'] . '</td>
            <td><a href="./edit_student.php?studentId=' . $row['id'] . '" >Edit</a></td>
            <td><a href="./delete_student.php?studentId=' . $row['id'] . '" >Delete</a></td>
            <td><a href="./marks.php?studentId=' . $row['id'] . '" >Get marks</a></td>
          </tr>';
    }
    echo '</table>';
  }

  echo '<a href="./create_record.php">Add new student</a></br>';
  echo '<a href="./sort_students.php">Get sorted list</a>';
  ?>
</body>

</html>