<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Last entered</title>
</head>
<body>
  <?php  
  $surname = $_GET['full_name'];
  $group_name = $_GET['group_name'];

  echo '<table border="1">';
  echo '<tr>
          <th>Fullname</th>
          <th>Group</th>          
        </tr>';
    
  echo '<tr>
        <td>' . $surname . '</td>
        <td>' . $group_name . '</td> 
      </tr>';    
  echo '</table>';
  ?>
  </br><a href="./students.php">Back to home page</a>
</body>
</html>