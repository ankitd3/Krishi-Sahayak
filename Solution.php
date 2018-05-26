<?php

if(isset($_POST['save_audio'])){

	$file=$_FILES['audio_img_file']; //audio/image file from the form
	$fileName=$file['name']; //Name of the file
	$fileTempName=$file['tmp_name']; //temp name stored by php
	$fileError=$file['error']; //If value=0 (no error) and value=1 (error)
	$fileType=$file['type']; //type ?? not used

	$fileEx = explode('.', $fileName); //Explode similar split in python
	$fileExt = strtolower(end($fileEx)); //lower case (JPG -> jpg) and from end()

	$allowed = array('jpeg','jpg','mp3','ogg'); //accepted file types

	if(in_array($fileExt, $allowed)){
		$dir='Solution/';
		$fileNewName = uniqid('',true).".".$fileExt;
		$path=$dir.basename($fileNewName);
		if(move_uploaded_file($fileTempName, $path)){
			echo "UPLOAD";

			$qid=$_POST['qid']; //From the form which takes input for audio/image
			insertdb(basename($fileNewName),$qid);//insert into the question-solution relation

		}
		if(strcmp($fileExt,'mp3')==0){
			$var="<audio controls>
				<source src='".$path."' type='audio/mpeg'>
			</audio>";
		}
		elseif (strcmp($fileExt,'jpg')==0) {
			$var="<img src=".$path." alt='Smiley face'>";
		}

	}else{
		$var="Incompatible File type";
	}

	//echo $fileExt;

}
if(isset($_POST['text_submit'])){
	$dir='Solution/';
	$fileName = uniqid('',true).".txt";
	$fileNewName = $dir.$fileName;
	$var = $_POST['text_submit']; //The solution text
	$qid = $_POST['qid']; //Qid for which the solution is provided
	$myfile = fopen($fileNewName, "w") or die("Unable to open file!"); //creates file if not exists
	insertdb($fileName,$qid); //insert into the question-solution relation
	fwrite($myfile, $var); //save the solution(.txt) to the solution folder
	fclose($myfile);
}
function insertdb($solution,$question){
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

	$sql = "INSERT INTO qs (qid,sid) VALUES ('".$question."','".$solution."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

 <?php echo $var;?>

</body>
</html>