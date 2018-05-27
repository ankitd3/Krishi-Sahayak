<?php

if(isset($_POST['submit_text'])||isset($_POST['submit_img'])||isset($_POST['submit_audio'])){

	if(isset($_POST['submit_audio']) && is_uploaded_file($_FILES['audio_file']['tmp_name'])){

		$file=$_FILES['audio_file']; //audio/image file from the form
		$fileName=$file['name']; //Name of the file
		$fileTempName=$file['tmp_name']; //temp name stored by php
		$fileError=$file['error']; //If value=0 (no error) and value=1 (error)
		$fileType=$file['type']; //type ?? not used

		$fileEx = explode('.', $fileName); //Explode similar split in python
		$fileExt = strtolower(end($fileEx)); //lower case (JPG -> jpg) and from end()

		$allowed = array('mp3','ogg'); //accepted file types

		if(in_array($fileExt, $allowed)){
			$dir='Comment/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				// $var="<audio controls>
				// 	<source src='".$path."' type='audio/mpeg'>
				// </audio>";  //displays the audio file in html
			}
		}else{
			echo "Incompatible File type";
		}

	}
	elseif (isset($_POST['submit_img']) && is_uploaded_file($_FILES['img_file']['tmp_name'])) {
		//upload the file to folder Question
		//Update the q relation with qid
		$file=$_FILES['img_file']; //audio/image file from the form
		$fileName=$file['name']; //Name of the file
		$fileTempName=$file['tmp_name']; //temp name stored by php
		$fileError=$file['error']; //If value=0 (no error) and value=1 (error)
		$fileType=$file['type']; //type ?? not used

		$fileEx = explode('.', $fileName); //Explode similar split in python
		$fileExt = strtolower(end($fileEx)); //lower case (JPG -> jpg) and from end()

		$allowed = array('jpeg','jpg'); //accepted file types

		if(in_array($fileExt, $allowed)){
			$dir='Comment/';
			$fileNewName = uniqid('',true).".".$fileExt;
			$path=$dir.basename($fileNewName);
			if(move_uploaded_file($fileTempName, $path)){
				echo "UPLOAD";
				insertdb(basename($fileNewName)); //Insert into questions table (only qid as of now)
				// $var="<img src=".$path." alt='Smiley face'>"; //displays image in html
			}
		}else{
			echo "Incompatible File type";
		}

		if(!empty($_POST['text_file'])){			
				//INSERT INTO IMG_TEXT TABLE THE imgname and text
				$textFileName = uniqid('',true).".txt";
				$textFileNewName = $dir.$textFileName;
				$var = $_POST['text_file'];
				$myfile = fopen($textFileNewName, "w") or die("Unable to open file!");
				insertImgText($textFileName,basename($fileNewName));
				fwrite($myfile, $var);
				fclose($myfile);
			}
		}
	elseif (!empty($_POST['text'])) {
		$dir='Comment/';
		$fileName = uniqid('',true).".txt";
		$fileNewName = $dir.$fileName;
		$var = $_POST['text'];
		$myfile = fopen($fileNewName, "w") or die("Unable to open file!");
		insertdb($fileName);
		fwrite($myfile, $var);
		fclose($myfile);
	}
}
function insertImgText($text,$img){
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

	$sql = "INSERT INTO cimgtext (img_id,text_id) VALUES ('".$img."','".$text."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}


function insertdb($comment){

	$qid = $_POST['qid'];

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

	$sql = "INSERT INTO comments (qid,cid) VALUES ('".$qid."','".$comment."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}

?>