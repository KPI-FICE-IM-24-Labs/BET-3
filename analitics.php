<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Statistics</title>
</head>

<body>
  <?php require_once('./db_connect.php');
  try {
    $recordsMadeStudents = $mysqli->query("SELECT COUNT(*) AS student_count FROM students")->fetch_assoc();
    $recordsMadeMarks = $mysqli->query("SELECT COUNT(*) AS marks_count FROM marks")->fetch_assoc();

    $date_array = getdate();
    $begin_date = date("Y-m-d", mktime(0, 0, 0, $date_array['mon'], 1, $date_array['year']));
    $end_date = date("Y-m-d", mktime(0, 0, 0, $date_array['mon'] + 1, 0, $date_array['year']));

    $studentsEnteredLastMonth = $mysqli->query("SELECT COUNT(*) AS students_count FROM students WHERE created >= '$begin_date' AND created <= '$end_date'")->fetch_assoc();
    $marksGotLastMonth = $mysqli->query("SELECT COUNT(*) AS marks_count FROM marks WHERE created>='$begin_date' AND created <='$end_date'")->fetch_assoc();

    $lastEnteredStudent = $mysqli->query("SELECT * FROM students ORDER BY id DESC LIMIT 1")->fetch_array();
    $studentWithMostMarks = $mysqli->query("SELECT * FROM marks, students WHERE marks.student_id=students.id GROUP BY students.id ORDER BY marks.id DESC LIMIT 0,1")->fetch_array();

    echo "Students records made count: " . $recordsMadeStudents['student_count'] . $nl;
    echo "Marks records made count: " . $recordsMadeMarks['marks_count'] . $nl;
    echo "Last month students entered: " . $studentsEnteredLastMonth['students_count'] . $nl;
    echo "Last month grades students got: " . $marksGotLastMonth['marks_count'] . $nl;
    echo "Last entered student: <a href='./last_student.php?full_name=" . $lastEnteredStudent['surname'] . ' ' . $lastEnteredStudent['name'] . "&group_name=" . $lastEnteredStudent['group_name'] . "'>" . $lastEnteredStudent['surname'] . " " . $lastEnteredStudent['name'] . "</a>" . $nl;
    echo "Student with most marks: <a href='./last_student.php?full_name=" . $studentWithMostMarks['surname'] . ' ' . $studentWithMostMarks['name'] . "&group_name=" . $studentWithMostMarks['group_name'] . "'>" . $studentWithMostMarks['surname'] . " " . $studentWithMostMarks['name'] . "</a>" . $nl;
  } catch (mysqli_sql_exception $error) {
    echo "</br>Error: " . $error->getMessage();
  }
  ?>
  <a href="./students.php">Back to home page</a></br>
  <a href="./search.php">Search record in db</a>
</body>

</html>