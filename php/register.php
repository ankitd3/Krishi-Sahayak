<?php 

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

if(isset($_POST['submit_form'])){

	$name = $_POST["name"];
	$phone = $_POST["regphno"];
	$type = $_POST["optradio"];
	$pass = $_POST["regpsw1"];

	if ($type=='1') {
		echo "FAMR";
		$sql = "INSERT INTO farmer (phno,name,password) VALUES ('".$phone."','".$name."','".$pass."')";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
		}
	}
	elseif ($type=='2') {
		echo "EXP";
		
		$code = $_POST["code"];

		if($code == '020618'){
			$sql = "INSERT INTO expert (phno,name,password) VALUES ('".$phone."','".$name."','".$pass."')";

			if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
			}
		}
	}

}

?>