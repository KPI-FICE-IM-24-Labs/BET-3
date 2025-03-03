<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Marks</title>
</head>

<body>
  <?php require_once("./db_connect.php");
  $student_id = $_GET['studentId'];
  $getStudentById = "SELECT surname, name, group_name FROM students WHERE id = $student_id";
  $students = $mysqli->query($getStudentById);
  $student = $students->fetch_array();

  echo "$nl Student:$nl";
  echo $student['surname'] . " ";
  echo $student['name'] . " " . $student['group_name'] . $nl . $nl;

  $getAllMarks = "SELECT * FROM marks WHERE student_id = $student_id";
  $marks = $mysqli->query($getAllMarks);

  if (!$marks->num_rows > 0) {
    echo "No marks found";
  } else {
    echo '<table border="1">';
    echo '<tr>
            <th>Subject</th>
            <th>Teacher</th>
            <th>Ticket</th>
            <th>Mark</th>
          </tr>';

    while ($row = $marks->fetch_array()) {
      echo '<tr>
              <td>' . $row['subject'] . '</td>
              <td>' . $row['teacher'] . '</td>
              <td>' . $row['ticket_number'] . '</td>
              <td>' . $row['mark'] . '</td>
            </tr>';
    }

    echo '</table>';
  }
  ?>
</body>

</html>