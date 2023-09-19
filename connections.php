<?php 
include_once "constants.php";
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PSW;
$dbname = DB_NAME;

try {
  $conn = new PDO("mysql:host=$servername;dbname=".DB_NAME, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
  print_r(PDO::getAvailableDrivers());
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// // Check connection
// if (!$conn) {
//   die("Connection failed: " . mysqli_connect_error());
// }