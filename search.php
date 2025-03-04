<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h2>Пошук інформації</h2>
  <form method="GET" action="">
    <label for="usersearch">Surname:</label>
    <input type="text" id="usersearch" name="usersearch">
    <br>
    <label for="startDate">After:</label>
    <input type="date" id="startDate" name="startDate">
    <label for="endDate">Before:</label>
    <input type="date" id="endDate" name="endDate">
    <br>
    <button type="submit">Search</button>
  </form>
  <hr>

  <?php require_once('./db_connect.php');
  try {
    $search = isset($_GET['usersearch']) ? $_GET['usersearch'] : '';
    $startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
    $endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';

    if (!empty($search) && strpos($search, '*') !== false) {
      $pattern = str_replace('*', '.*', $search);
      $sql = "SELECT * FROM students WHERE surname REGEXP ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s", $pattern);
    } elseif (!empty($startDate) && !empty($endDate)) {
      $sql = "SELECT * FROM students WHERE DATE(created) BETWEEN ? AND ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("ss", $startDate, $endDate);
    } elseif (!empty($search)) {
      $keyword = "%$search%";
      $sql = "SELECT * FROM students WHERE surname LIKE ?";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("s", $keyword);
    } else {
      $stmt = null;
    }

    if ($stmt) {
      $stmt->execute();
      $result = $stmt->get_result();

      echo "<h3>Search results:</h3><ul>";
      while ($row = $result->fetch_assoc()) {
        echo "<li>" . $row['surname'] . " " . $row['name'] . " (" . $row['created'] . ")</li>";
      }
      echo "</ul>";

      $stmt->close();
    }
  } catch (mysqli_sql_exception $error) {
    echo "</br>Error: " . $error->getMessage();
  }
  ?>

  <a href="./students.php">Back to home page</a></br>
</body>

</html>