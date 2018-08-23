 <?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "testproject";

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection refused: " . $conn->connect_error);
}

?>