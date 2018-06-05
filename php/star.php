<?php 

session_start();

if(isset($_SESSION['name'])){
  $name = $_SESSION['name'];
  $fid = $_SESSION['id'];
}
else{
  header('Location: ../login.html');
}

$qid = $_POST['starQid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ks";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  $sql = "INSERT INTO star (qid,fid) VALUES ('".$qid."','".$fid."')";
    if ($GLOBALS['conn']->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
    }
header('Location: ../starQuestion.php');
?>