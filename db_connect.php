<?php
$nl = "<br>";
$showLogs = (count(debug_backtrace()) === 0); // Check if file opened dirrectly or using require_once();

function logMessage($message)
{
  global $showLogs, $nl;
  if ($showLogs) {
    echo $message . $nl;
  }
}

try {
  $mysqli = new mysqli("localhost", "root");
  logMessage("Connection established successfully");

  $dbName = "Marks";
  $mysqli->select_db($dbName);
  logMessage("Database marks has been chosen");
} catch (mysqli_sql_exception $error) {
  logMessage("Error: " . $error->getMessage());
}
