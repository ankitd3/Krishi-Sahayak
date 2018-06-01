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
	$type = $_POST["optradio"];
	$phone = $_POST["phno"];
	$passInput = $_POST["psw"];

	if ($type=='1') {
		echo "FARM";
		$sql = "SELECT * FROM farmer WHERE phno='".$phone."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $pass = $row['password'];
		    }
		} else {
		    echo "0 results";
		}
	}
	elseif ($type=='2') {
		echo "EXPERT";
		$sql = "SELECT * FROM expert WHERE phno='".$phone."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $pass = $row["password"];
		    }
		} else {
		    echo "0 results";
		}
	}

	if(strcmp($pass, $passInput)==0){
		header('Location: ../question.html');
	}
	else{
		echo "FAIL";
	}
}

$conn->close();
?>