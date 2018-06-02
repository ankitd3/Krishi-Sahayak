<?php 

session_start();

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
	$passInput = md5($_POST["psw"]);

	if ($type=='1') {
		$sql = "SELECT * FROM farmer WHERE phno='".$phone."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $pass = $row['password'];
		        $name = $row['name'];
		        $id = $row['fid'];
		    }
		} else {
		    echo "0 results";
		}
		if(strcmp($pass, $passInput)==0){
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $id;
			$_SESSION['type'] = "farmer";
			header('Location: ../uploadques.html');
		}
		else{
			echo "FAIL";
		}
	}
	elseif ($type=='2') {
		$sql = "SELECT * FROM expert WHERE phno='".$phone."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		    	$name = $row["name"];
		        $pass = $row["password"];
		        $id=$row["eid"];
		    }
		} else {
		    echo "0 results";
		}
		if(strcmp($pass, $passInput)==0){
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $id;
			$_SESSION['type'] = "expert";
			header('Location: ../indexForExpert.php');
		}
		else{
			echo "FAIL EXP";
		}
	}
}

$conn->close();
?>